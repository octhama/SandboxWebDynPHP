<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Poney;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RendezVousController extends Controller
{
    // Afficher la liste des rendez-vous
    public function index()
    {
        // Charger les rendez-vous avec les clients et les poneys associés
        $rendezVous = RendezVous::with(['client', 'poneys'])->get();
        $poneys = Poney::all();
        $clients = Client::all();

        return view('rendez-vous.index', compact('rendezVous', 'poneys', 'clients'));
    }

    // Confirmer un rendez-vous
    public function confirm($id)
    {
        DB::transaction(function () use ($id) {
            $rendezVous = RendezVous::findOrFail($id);

            // Marquer les poneys comme non disponibles
            $rendezVous->poneys()->update(['disponible' => false]);

            // Ajouter un champ confirmed si nécessaire
            $rendezVous->update(['confirmed' => true]);
        });

        return redirect()->route('rendez-vous.index')->with('success', 'Rendez-vous confirmé avec succès.');
    }

    // Réinitialiser un rendez-vous
    public function reset($id)
    {
        DB::transaction(function () use ($id) {
            $rendezVous = RendezVous::findOrFail($id);

            // Libérer les poneys assignés
            $rendezVous->poneys()->update(['disponible' => true]);

            // Dissocier les poneys
            $rendezVous->poneys()->detach();

            // Supprimer le rendez-vous (optionnel)
            $rendezVous->delete();
        });

        return redirect()->route('rendez-vous.index')->with('success', 'Rendez-vous réinitialisé avec succès.');
    }

    // Supprimer un rendez-vous
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $rendezVous = RendezVous::findOrFail($id);

            // Réinitialiser la disponibilité des poneys avant de supprimer le rendez-vous
            $rendezVous->poneys()->update(['disponible' => true]);

            // Supprimer le rendez-vous
            $rendezVous->delete();
        });

        return redirect()->route('rendez-vous.index')->with('success', 'Rendez-vous supprimé avec succès.');
    }

    private function genererCreneauxDisponibles($plages, $reservations)
    {
        $creneauxDisponibles = [];

        foreach ($plages as $plage) {
            $start = $plage['start']->copy();
            $end = $plage['end']->copy();

            while ($start->lessThan($end)) {
                $creneauDebut = $start->copy();
                $creneauFin = $start->copy()->addMinutes(20);

                // Vérifier si le créneau dépasse la plage horaire
                if ($creneauFin->greaterThan($end)) {
                    break;
                }

                // Vérifier si le créneau est en conflit avec une réservation existante
                $enConflit = $reservations->some(function ($reservation) use ($creneauDebut, $creneauFin) {
                    return !(
                        $creneauFin->lessThanOrEqualTo($reservation['start']) ||
                        $creneauDebut->greaterThanOrEqualTo($reservation['end'])
                    );
                });

                if (!$enConflit) {
                    $creneauxDisponibles[] = (object) [
                        'start' => $creneauDebut,
                        'end' => $creneauFin,
                    ];
                }

                $start->addMinutes(20); // Avancer au prochain créneau
            }
        }

        //dd($creneauxDisponibles);

        return $creneauxDisponibles;
    }

    public function create()
    {
        $clients = Client::all();
        $poneys = Poney::where('disponible', true)->get();

        // Plages horaires ouvertes
        $plagesHoraires = [
            ['start' => Carbon::createFromTime(10, 0), 'end' => Carbon::createFromTime(12, 0)],
            ['start' => Carbon::createFromTime(13, 30), 'end' => Carbon::createFromTime(16, 0)],
        ];

        // Obtenir les réservations existantes
        $rendezVous = RendezVous::all();
        $reservations = $rendezVous->map(function ($rdv) {
            return [
                'start' => Carbon::parse($rdv->horaire_debut),
                'end' => Carbon::parse($rdv->horaire_fin),
            ];
        });

        // Générer les créneaux disponibles
        $disponibilites = $this->genererCreneauxDisponibles($plagesHoraires, $reservations);

        //dd($disponibilites);

        return view('rendez-vous.create', compact('clients', 'poneys', 'disponibilites'));
    }

    // Enregistrer un nouveau rendez-vous
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'nombre_personnes' => 'required|integer|min:1',
            'creneaux' => 'required|string', // Validation du créneau sélectionné
            'poneys' => 'array',
            'poneys.*' => 'nullable|exists:poneys,id',
        ]);

        // Découper le créneau en début et fin
        [$horaireDebut, $horaireFin] = explode('-', $validated['creneaux']);
        $horaireDebut = Carbon::createFromFormat('H:i', $horaireDebut);
        $horaireFin = Carbon::createFromFormat('H:i', $horaireFin);

        DB::transaction(function () use ($validated, $horaireDebut, $horaireFin) {
            // Créer le rendez-vous
            $rendezVous = RendezVous::create([
                'client_id' => $validated['client_id'],
                'horaire_debut' => $horaireDebut,
                'horaire_fin' => $horaireFin,
                'nombre_personnes' => $validated['nombre_personnes'],
            ]);

            // Associer les poneys uniquement si sélectionnés
            $selectedPoneys = array_filter($validated['poneys'], fn($poneyId) => $poneyId !== null);
            if (!empty($selectedPoneys)) {
                $rendezVous->poneys()->attach($selectedPoneys);

                // Marquer les poneys comme indisponibles
                Poney::whereIn('id', $selectedPoneys)->update(['disponible' => false]);
            }
        });

        return redirect()->route('rendez-vous.index')->with('success', 'Rendez-vous créé avec succès.');
    }
}
