<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Poney;
use App\Models\RendezVous;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $clients = Client::all(); // Récupère tous les clients
        return view('clients.index', compact('clients')); // Retourne une vue avec les clients
    }

    public function show($id)
    {
        $client = Client::findOrFail($id); // Récupère le client ou renvoie une erreur 404
        return view('clients.show', compact('client'));
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id); // Récupère le client ou retourne une erreur 404
        return view('clients.edit', compact('client'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_client' => 'required|string|max:255',
            'nombre_personnes' => 'required|numeric|min:1',
            'horaire' => 'required|numeric|min:1|max:6', // Validation pour les heures (1 à 6 max)
            'prix' => 'required|numeric|min:0',
            'poneys' => 'array|required|min:1'
        ]);

        // Calcul du prix total
        $prix_total = $validated['nombre_personnes'] * $validated['horaire'] * 100;

        // Créer un nouveau client
        $client = Client::create([
            'nom' => $validated['nom_client'],
            'nombre_personnes' => $validated['nombre_personnes'],
            'heures' => $validated['horaire'], // Ajouter cette ligne pour remplir la colonne 'heures'
            'prix_total' => $prix_total, // Ajouter le prix total
        ]);

        // Créer un nouveau rendez-vous
        $rendezVous = RendezVous::create([
            'client_id' => $client->id,
            'nombre_personnes' => $validated['nombre_personnes'],
            'horaire' => $validated['horaire'], // Inclure les heures ici aussi
            'prix' => $prix_total, // Utiliser le prix total calculé
            'poneys_assignes' => json_encode($validated['poneys']),
        ]);

        return redirect()->route('clients.index')->with('success', 'Client et rendez-vous créés avec succès.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'nombre_personnes' => 'required|integer|min:1',
            'heures' => 'required|integer|min:0',
            'prix_total' => 'required|numeric|min:0',
        ]);

        $client = Client::findOrFail($id);
        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client mis à jour avec succès.');
    }

    public function create()
    {
        return view('clients.create');
    }


    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        $this->authorize('delete', $client); // Vérifie l'autorisation

        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');
    }
}
