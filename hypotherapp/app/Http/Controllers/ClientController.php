<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Facturation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $clients = Client::paginate(5); // Récupère les clients avec pagination
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
        // dd($request->all()); Afficher les données soumises

        // Nettoyer le prix_total en supprimant le symbole € et en convertissant en nombre
        $request->merge([
            'prix_total' => (float) str_replace('€', '', $request->prix_total),
        ]);

        // Validation des données
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'nombre_personnes' => 'required|integer|min:1',
            'duree' => 'required|integer|min:10|max:120', // Durée en minutes
            'prix_total' => 'required|numeric|min:0',
        ]);

        // Création du client avec les données soumises
        $client = Client::create([
            'nom' => $validated['nom'],
            'nombre_personnes' => $validated['nombre_personnes'],
            'minutes' => $validated['duree'], // Durée en minutes
            'prix_total' => $validated['prix_total'],
        ]);

        // dd($client);   Afficher l'objet client créé

        return redirect()->route('clients.index')->with('success', 'Client créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        // Nettoyer le prix_total en supprimant le symbole € et en convertissant en nombre
        $request->merge([
            'prix_total' => (float) str_replace('€', '', $request->prix_total),
        ]);

        // Validation des données
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'nombre_personnes' => 'required|integer|min:1',
            'minutes' => 'required|integer|min:10|max:120', // Durée en minutes
            'prix_total' => 'required|numeric|min:0',
        ]);

        // Mettre à jour le client
        $client = Client::findOrFail($id);
        $client->update([
            'nom' => $validated['nom'],
            'nombre_personnes' => $validated['nombre_personnes'],
            'minutes' => $validated['minutes'],
            'prix_total' => $validated['prix_total'],
        ]);

        return redirect()->route('clients.index')->with('success', 'Client mis à jour avec succès.');
    }
    // app/Http/Controllers/ClientController.php
    public function generateInvoice($id)
    {
        $client = Client::findOrFail($id);

        // Vérifie si l'utilisateur a le droit de générer une facture
        $this->authorize('generateInvoice', $client);

        $pdf = Pdf::loadView('clients.invoice', compact('client'));
        return $pdf->download('facture_' . $client->nom . '.pdf');
    }

    public function destroy(Client $client)
    {
        // Vérifie si l'utilisateur a le droit de supprimer un client
        $this->authorize('delete', $client);

        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');
    }
}
