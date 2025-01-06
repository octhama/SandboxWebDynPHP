<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RendezVous;
use App\Models\Client;
use App\Models\Poney;

class RendezVousController extends Controller
{
    public function index()
    {
        $rendezVous = RendezVous::with('client', 'poneys')->get();
        $clients = Client::all();
        $poneys = Poney::all();

        return view('rendez_vous.index', compact('rendezVous', 'clients', 'poneys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date' => 'required|date',
            'heure' => 'required|string',
            'prix' => 'required|numeric',
        ]);

        $rendezVous = RendezVous::create($request->all());
        $rendezVous->poneys()->sync($request->input('poneys', []));

        return redirect()->route('rendez_vous.index')->with('success', 'Rendez-vous créé avec succès.');
    }
}
