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
