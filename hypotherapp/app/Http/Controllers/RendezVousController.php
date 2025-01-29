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

        $selectedPoneys = array_filter($validated['poneys'], fn($poneyId) => $poneyId !== null);

        // Créer un rendez-vous
        $rendezVous = RendezVous::create([
            'client_id' => $validated['client_id'],
            'nombre_personnes' => $validated['nombre_personnes'],
            'horaire_debut' => $validated['horaire_debut'],
            'horaire_fin' => $validated['horaire_fin'],
            'poneys_assignes' => json_encode($selectedPoneys),
        ]);

        DB::transaction(function () use ($request) {
            $horaireDebut = Carbon::createFromFormat('H:i', $request->horaire_debut);
            $horaireFin = Carbon::createFromFormat('H:i', $request->horaire_fin);

            // Créer le rendez-vous
            $rendezVous = RendezVous::create([
                'client_id' => $request->client_id,
                'horaire_debut' => $horaireDebut,
                'horaire_fin' => $horaireFin,
                'nombre_personnes' => $request->nombre_personnes,
            ]);

            // Associer les poneys
            $rendezVous->poneys()->attach($request->poneys);

            // Mettre à jour les poneys
            Poney::whereIn('id', $request->poneys)->update(['disponible' => false]);
        });

        return redirect()->route('rendez-vous.index')->with('success', 'Rendez-vous créé avec succès.');
    }
}
