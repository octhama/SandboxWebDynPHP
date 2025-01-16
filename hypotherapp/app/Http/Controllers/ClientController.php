<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'nb_personnes' => 'required|integer|min:1',
        ]);

        // Création du client
        Client::create($validated);

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Client ajouté avec succès !');
    }
}
