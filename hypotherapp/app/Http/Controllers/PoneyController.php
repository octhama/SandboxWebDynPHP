<?php

namespace App\Http\Controllers;

use App\Models\Poney;
use Illuminate\Http\Request;

class PoneyController extends Controller
{
    // Afficher la liste des poneys
    public function index()
    {
        $poneys = Poney::all();
        return view('poneys.index', compact('poneys'));
    }

    // Ajouter un nouveau poney
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'heures_travail_validee' => 'required|integer|min:1|max:24',
        ]);

        Poney::create([
            'nom' => $request->nom,
            'heures_travail_validee' => $request->heures_travail_validee,
        ]);

        return redirect()->route('poneys.index')->with('success', 'Poney ajouté avec succès.');
    }
    public function edit(Poney $poney)
    {
        return view('poneys.edit', compact('poney'));
    }

    public function update(Request $request, Poney $poney)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'heures_travail_validee' => 'required|integer|min:0',
        ]);

        $poney->update([
            'nom' => $request->nom,
            'heures_travail_validee' => $request->heures_travail_validee,
            'disponible' => $request->has('disponible'),
        ]);

        return redirect()->route('poneys.index')->with('success', 'Poney mis à jour avec succès.');
    }

    // Supprimer un poney
    public function destroy(Poney $poney)
    {
        $poney->delete();
        return redirect()->route('poneys.index')->with('success', 'Poney supprimé avec succès.');
    }
}


