<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\Client;
use App\Models\Poney;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    /**
     * Affiche la liste des rendez-vous.
     */
    public function index()
    {
        $rendezvous = RendezVous::with(['client', 'poneys'])->orderBy('horaire_debut', 'asc')->get();

        return view('rendezvous.index', compact('rendezvous'));
    }

    /**
     * Affiche le formulaire pour créer un nouveau rendez-vous.
     */
    public function create()
    {
        $clients = Client::all();
        $poneys = Poney::where('disponible', true)->get();

        return view('rendezvous.create', compact('clients', 'poneys'));
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
     * Affiche le formulaire pour modifier un rendez-vous existant.
     */
    public function edit($id)
    {
        $rendezvous = RendezVous::with(['client', 'poneys'])->findOrFail($id);
        $clients = Client::all();
        $poneys = Poney::where('disponible', true)->orWhereIn('id', $rendezvous->poneys->pluck('id'))->get();

        return view('rendezvous.edit', compact('rendezvous', 'clients', 'poneys'));
    }

    /**
     * Met à jour un rendez-vous existant.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'horaire_debut' => 'required|date_format:Y-m-d H:i:s',
            'horaire_fin' => 'required|date_format:Y-m-d H:i:s|after:horaire_debut',
            'poneys' => 'required|array|min:1',
            'poneys.*' => 'exists:poneys,id',
        ]);

        $rendezvous = RendezVous::findOrFail($id);

        // Libérer les poneys précédemment assignés
        $rendezvous->poneys()->update(['disponible' => true]);

        // Mettre à jour les informations du rendez-vous
        $rendezvous->update([
            'client_id' => $validated['client_id'],
            'horaire_debut' => $validated['horaire_debut'],
            'horaire_fin' => $validated['horaire_fin'],
        ]);

        // Réassigner les poneys
        $rendezvous->poneys()->sync($validated['poneys']);
        Poney::whereIn('id', $validated['poneys'])->update(['disponible' => false]);

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous mis à jour avec succès.');
    }

    /**
     * Supprime un rendez-vous.
     */
    public function destroy($id)
    {
        $rendezvous = RendezVous::findOrFail($id);

        // Libérer les poneys associés
        $rendezvous->poneys()->update(['disponible' => true]);

        // Supprimer le rendez-vous
        $rendezvous->delete();

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous supprimé avec succès.');
    }
}
