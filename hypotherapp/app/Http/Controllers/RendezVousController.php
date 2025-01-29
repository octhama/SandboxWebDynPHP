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

    // Afficher le formulaire de création d'un rendez-vous
    public function create()
    {
        $clients = Client::all();

        $poneys = Poney::where('disponible', true)->get(); // Récupérer uniquement les poneys disponibles

        return view('rendez-vous.create', compact('clients', 'poneys'));
    }

    // Enregistrer un nouveau rendez-vous
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'nombre_personnes' => 'required|integer|min:1',
            'horaire_debut' => 'required|date_format:H:i',
            'horaire_fin' => 'required|date_format:H:i|after:horaire_debut',
            'poneys' => 'array',
            'poneys.*' => 'nullable|exists:poneys,id',
        ]);

        DB::transaction(function () use ($validated, $request) {
            $horaireDebut = Carbon::createFromFormat('H:i', $request->horaire_debut);
            $horaireFin = Carbon::createFromFormat('H:i', $request->horaire_fin);

            // Créer le rendez-vous
            $rendezVous = RendezVous::create([
                'client_id' => $validated['client_id'],
                'horaire_debut' => $horaireDebut,
                'horaire_fin' => $horaireFin,
                'nombre_personnes' => $validated['nombre_personnes'],
            ]);

            // Associer les poneys uniquement si des poneys ont été sélectionnés
            $selectedPoneys = array_filter($validated['poneys'], fn($poneyId) => $poneyId !== null);
            if (!empty($selectedPoneys)) {
                $rendezVous->poneys()->attach($selectedPoneys);

                // Marquer les poneys sélectionnés comme indisponibles
                Poney::whereIn('id', $selectedPoneys)->update(['disponible' => false]);
            }

            // Mettre à jour les poneys
            Poney::whereIn('id', $request->poneys)->update(['disponible' => false]);
        });

        return redirect()->route('rendez-vous.index')->with('success', 'Rendez-vous créé avec succès.');
    }
}
