<?php

// 3. Contrôleur principal pour RendezVous
namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Poney;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    public function index()
    {
        $rendezVous = RendezVous::with('client')->get(); // Charge les clients liés
        $poneys = Poney::where('disponible', true)->get(); // Récupère les poneys disponibles
        return view('rendezvous.index', compact('rendezVous', 'poneys'));
    }

    public function create()
    {
        $clients = Client::all(); // Récupère tous les clients disponibles
        $poneys = Poney::all();   // Récupère tous les poneys disponibles
        return view('rendezvous.create', compact('clients', 'poneys'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'nombre_personnes' => 'required|integer|min:1',
            'horaire' => ['required', 'regex:/^\d{1,2}h\d{2}-\d{1,2}h\d{2}$/'], // Valide le format "12h30-14h30"
            'poneys' => 'required|array|min:1',
            'poneys.*' => 'exists:poneys,id',
        ]);

        // Créer un nouveau rendez-vous
        RendezVous::create([
            'client_id' => $validated['client_id'],
            'nombre_personnes' => $validated['nombre_personnes'],
            'horaire' => $validated['horaire'],
            'poneys_assignes' => json_encode($validated['poneys']),
        ]);

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous créé avec succès.');
    }

    public function assignerPoneys(Request $request, $id)
    {
        $rendezVous = RendezVous::findOrFail($id);
        $rendezVous->poneys_assignes = json_encode($request->input('poneys'));
        $rendezVous->save();

        // Marquer les poneys comme non disponibles
        Poney::whereIn('id', $request->input('poneys'))->update(['disponible' => false]);

        return redirect()->back()->with('success', 'Poneys assignés avec succès.');
    }
}
