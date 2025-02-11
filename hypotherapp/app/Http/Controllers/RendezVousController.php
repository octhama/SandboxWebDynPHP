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
    public function index()
    {
        $rendezVous = RendezVous::with(['client', 'poneys'])->get();
        $poneys = Poney::all();
        $clients = Client::all();

        return view('rendez-vous.index', compact('rendezVous', 'poneys', 'clients'));
    }

    public function getCreneauxDisponibles()
    {
        $plages = [
            ['start' => Carbon::createFromTime(9, 0), 'end' => Carbon::createFromTime(12, 0)],
            ['start' => Carbon::createFromTime(14, 0), 'end' => Carbon::createFromTime(18, 0)],
        ];

        $reservations = RendezVous::pluck('horaire_debut', 'horaire_fin')->toArray();

        $creneauxDisponibles = [];
        foreach ($plages as $plage) {
            $start = $plage['start']->copy();
            while ($start->lessThan($plage['end'])) {
                $creneauDebut = $start->copy();
                $creneauFin = $start->copy()->addMinutes(20);

                $estReserve = collect($reservations)->contains(function ($fin, $debut) use ($creneauDebut, $creneauFin) {
                    return ($creneauDebut->eq($debut) && $creneauFin->eq($fin));
                });

                if (!$estReserve) {
                    $creneauxDisponibles[] = ['start' => $creneauDebut, 'end' => $creneauFin];
                }

                $start->addMinutes(20);
            }
        }
        return $creneauxDisponibles;
    }

    public function create()
    {
        $clients = Client::all();
        $poneys = Poney::where('disponible', true)->get();
        $disponibilites = $this->getDisponibilites();

        // Récupérer les créneaux déjà réservés
        $reservations = RendezVous::select('horaire_debut', 'horaire_fin')->get()->map(function ($rdv) {
            return (object) [
                'horaire_debut' => $rdv->horaire_debut ? Carbon::parse($rdv->horaire_debut) : null,
                'horaire_fin' => $rdv->horaire_fin ? Carbon::parse($rdv->horaire_fin) : null,
            ];
        });

        return view('rendez-vous.create', compact('clients', 'poneys', 'disponibilites', 'reservations'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'nombre_personnes' => 'required|integer|min:1',
            'creneaux' => 'required|string',
            'poneys' => 'array',
            'poneys.*' => 'nullable|exists:poneys,id',
        ]);

        [$horaireDebut, $horaireFin] = explode('-', $validated['creneaux']);
        $horaireDebut = Carbon::createFromFormat('H:i', $horaireDebut);
        $horaireFin = Carbon::createFromFormat('H:i', $horaireFin);

        DB::transaction(function () use ($id, $validated, $horaireDebut, $horaireFin) {
            $rendezVous = RendezVous::findOrFail($id);

            // Mise à jour du rendez-vous
            $rendezVous->update([
                'client_id' => $validated['client_id'],
                'horaire_debut' => $horaireDebut,
                'horaire_fin' => $horaireFin,
                'nombre_personnes' => $validated['nombre_personnes'],
            ]);

            // Réinitialiser les poneys existants avant de mettre à jour
            $rendezVous->poneys()->detach();

            if (!empty($validated['poneys'])) {
                $rendezVous->poneys()->attach($validated['poneys']);

                // Mettre les poneys comme indisponibles
                Poney::whereIn('id', $validated['poneys'])->update(['disponible' => false]);
            }
        });

        return redirect()->route('rendez-vous.index')->with('success', 'Rendez-vous mis à jour avec succès.');
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

    public function getDisponibilites()
    {
        $disponibilites = [];
        $horaires = [
            ['start' => '10:00', 'end' => '12:00'],
            ['start' => '14:00', 'end' => '16:30'],
        ];

        foreach ($horaires as $plage) {
            $start = Carbon::createFromFormat('H:i', $plage['start']);
            $end = Carbon::createFromFormat('H:i', $plage['end']);

            while ($start->lt($end)) {
                $intervalEnd = (clone $start)->addMinutes(20);
                if ($intervalEnd->gt($end)) {
                    break;
                }

                $disponibilites[] = (object)[
                    'start' => clone $start,  // ✅ Assure que ce sont des objets Carbon
                    'end' => clone $intervalEnd
                ];

                $start->addMinutes(20);
            }
        }

        return $disponibilites;
    }

    public function edit($id)
    {
        $rendezVous = RendezVous::findOrFail($id);

        if ($rendezVous->horaire_debut) {
            $rendezVous->horaire_debut = Carbon::parse($rendezVous->horaire_debut);
        }
        if ($rendezVous->horaire_fin) {
            $rendezVous->horaire_fin = Carbon::parse($rendezVous->horaire_fin);
        }

        $clients = Client::all();
        $poneys = Poney::all();
        $disponibilites = $this->getDisponibilites();

        // ✅ Vérifier que les réservations ne contiennent pas de valeurs null
        $reservations = RendezVous::select('horaire_debut', 'horaire_fin')->get()->map(function ($rdv) {
            return (object) [
                'start' => $rdv->horaire_debut ? Carbon::parse($rdv->horaire_debut) : null,
                'end' => $rdv->horaire_fin ? Carbon::parse($rdv->horaire_fin) : null,
            ];
        });

        return view('rendez-vous.edit', compact('rendezVous', 'clients', 'poneys', 'disponibilites', 'reservations'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'nombre_personnes' => 'required|integer|min:1',
            'creneaux' => 'required|string',
            'poneys' => 'array',
            'poneys.*' => 'nullable|exists:poneys,id',
        ]);

        [$horaireDebut, $horaireFin] = explode('-', $validated['creneaux']);
        $horaireDebut = Carbon::createFromFormat('H:i', $horaireDebut);
        $horaireFin = Carbon::createFromFormat('H:i', $horaireFin);

        DB::transaction(function () use ($validated, $horaireDebut, $horaireFin) {
            $rendezVous = RendezVous::create([
                'client_id' => $validated['client_id'],
                'horaire_debut' => $horaireDebut,
                'horaire_fin' => $horaireFin,
                'nombre_personnes' => $validated['nombre_personnes'],
            ]);

            if (!empty($validated['poneys'])) {
                $rendezVous->poneys()->attach($validated['poneys']);
                Poney::whereIn('id', $validated['poneys'])->update(['disponible' => false]);
            }
        });

        return redirect()->route('rendez-vous.index')->with('success', 'Rendez-vous créé avec succès.');
    }
}
