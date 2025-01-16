<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Poney;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'nom_client' => 'required|string|max:255',
            'nombre_personnes' => 'required|integer|min:1',
            'horaire' => 'required',
            'prix' => 'required|numeric|min:0',
            'poneys' => 'array|required|min:1'
        ]);

        // Créer un nouveau client
        $client = Client::create([
            'nom' => $validated['nom_client'],
        ]);

        // Créer un nouveau rendez-vous
        $rendezVous = RendezVous::create([
            'client_id' => $client->id,
            'nombre_personnes' => $validated['nombre_personnes'],
            'horaire' => $validated['horaire'],
            'prix' => $validated['prix'],
            'poneys_assignes' => json_encode($validated['poneys']),
        ]);

        // Mettre à jour la disponibilité des poneys
        foreach ($validated['poneys'] as $poneyId) {
            $poney = Poney::find($poneyId);
            if ($poney) {
                $poney->disponible = false;
                $poney->save();
            }
        }

        return redirect()->back()->with('success', 'Client et rendez-vous enregistrés avec succès.');
    }
}
