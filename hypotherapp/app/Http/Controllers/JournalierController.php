<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Poney;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class JournalierController extends Controller
{
    /**
     * Affiche la page de gestion journalière.
     */
    public function index()
    {
        // Date format complet en français
        $date = now()->format('l j F Y');
        $poneysDisponibles = Poney::where('disponible', true)->count(); // Nombre de poneys disponibles
        $rendezvous = RendezVous::with(['client', 'poneys'])->orderBy('horaire_debut', 'asc')->get();
        $clients = Client::all(); // Récupérer tous les clients pour le formulaire
        $poneys = Poney::all(); // Récupérer tous les poneys

        return view('gestion.journaliere', compact('date', 'poneysDisponibles', 'rendezvous', 'clients', 'poneys'));
    }

    /**
     * Enregistre un nouveau rendez-vous.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'horaire_debut' => 'required|date_format:Y-m-d H:i:s',
            'horaire_fin' => 'required|date_format:Y-m-d H:i:s|after:horaire_debut',
            'poneys' => 'required|array|min:1',
            'poneys.*' => 'exists:poneys,id',
        ]);

        $nombreDePoneysDisponibles = Poney::where('disponible', true)->count();

        if (count($validated['poneys']) > $nombreDePoneysDisponibles) {
            return back()->withErrors(['poneys' => 'Le nombre de poneys assignés dépasse le nombre disponible.']);
        }

        $rendezvous = RendezVous::create([
            'client_id' => $validated['client_id'],
            'horaire_debut' => $validated['horaire_debut'],
            'horaire_fin' => $validated['horaire_fin'],
        ]);

        // Associer les poneys au rendez-vous
        $rendezvous->poneys()->sync($validated['poneys']);

        // Mettre à jour la disponibilité des poneys
        Poney::whereIn('id', $validated['poneys'])->update(['disponible' => false]);

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous créé avec succès.');
    }

    /**
     * Met à jour les poneys assignés à un rendez-vous.
     */
    public function updateRendezVousPoneys(Request $request, $id)
    {
        $validated = $request->validate([
            'poneys' => 'required|array|min:1',
            'poneys.*' => 'exists:poneys,id',
        ]);

        $rendezvous = RendezVous::findOrFail($id);

        // Libérer les poneys précédemment assignés
        $rendezvous->poneys()->update(['disponible' => true]);

        // Associer les nouveaux poneys
        $rendezvous->poneys()->sync($validated['poneys']);

        // Mettre à jour leur disponibilité
        Poney::whereIn('id', $validated['poneys'])->update(['disponible' => false]);

        return redirect()->route('gestion.journaliere.index')->with('success', 'Poneys mis à jour avec succès.');
    }
}
