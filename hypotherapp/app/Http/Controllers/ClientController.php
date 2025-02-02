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
        // Validation des données
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clients,email',
            'nombre_personnes' => 'required|integer|min:1',
            'heures' => 'required|integer|min:1|max:6',
            'prix_total' => 'required|numeric|min:0',
        ]);

        // Création du client avec les données soumises, y compris le prix total
        $client = Client::create([
            'nom' => $validated['nom'],
            'email' => $validated['email'] ?? null,
            'nombre_personnes' => $validated['nombre_personnes'],
            'heures' => $validated['heures'],
            'prix_total' => $validated['prix_total'],
        ]);

        // Création de la facturation pour le client
        Facturation::create([
            'client_id' => $client->id,
            'nombre_heures' => $client->heures,
            'montant' => $client->prix_total,
            'created_at' => now(),
        ]);


        return redirect()->route('clients.index')->with('success', 'Client créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'nombre_personnes' => 'required|integer|min:1',
            'heures' => 'required|integer|min:0',
            'prix_total' => 'required|numeric|min:0',
        ]);

        $client = Client::findOrFail($id);

        $client->update($validated);

        return redirect()->route('clients.index')->with('success', 'Client mis à jour avec succès.');
    }

    public function create()
    {
        return view('clients.create');
    }

    public function generateInvoice($id)
    {
        $client = Client::findOrFail($id);

        $pdf = Pdf::loadView('clients.invoice', compact('client'));

        return $pdf->download('facture_' . $client->nom . '.pdf');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id); // Vérifie que le client existe ou renvoie une erreur 404
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');
    }
}
