<?php

namespace App\Http\Controllers;

use App\Models\Poney;
use Illuminate\Http\Request;

class PoneyController extends Controller
{
    public function index()
    {
        $poneys = Poney::all(); // Récupère tous les poneys
        return view('poneys.index', compact('poneys'));
    }

    public function create()
    {
        return view('poneys.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'max_work_hours' => 'required|integer|min:1',
        ]);

        Poney::create([
            'nom' => $request->nom,
            'max_work_hours' => $request->max_work_hours,
            'current_hours' => 0,
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
            'max_work_hours' => 'required|integer|min:1',
        ]);

        $poney->update($request->only(['nom', 'max_work_hours']));

        return redirect()->route('poneys.index')->with('success', 'Poney mis à jour avec succès.');
    }

    public function destroy(Poney $poney)
    {
        $poney->delete();

        return redirect()->route('poneys.index')->with('success', 'Poney supprimé avec succès.');
    }
}
