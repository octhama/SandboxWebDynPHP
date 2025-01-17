<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Poney;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all(); // Récupère tous les clients
        return view('clients.index', compact('clients')); // Retourne une vue avec les clients
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
}
