<?php

namespace App\Http\Controllers;

use App\Models\Poney;
use Illuminate\Http\Request;

class PoneyController extends Controller
{
    public function index()
    {
        $poneys = Poney::all();
        return view('gestion.poneys', compact('poneys'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'heures_max' => 'required|integer|min:1',
        ]);

        Poney::create($validated);

        return redirect()->back()->with('success', 'Poney ajouté avec succès.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'heures_max' => 'required|integer|min:1',
        ]);

        $poney = Poney::findOrFail($id);
        $poney->update($validated);

        return redirect()->back()->with('success', 'Poney mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $poney = Poney::findOrFail($id);
        $poney->delete();

        return redirect()->back()->with('success', 'Poney supprimé avec succès.');
    }
}


