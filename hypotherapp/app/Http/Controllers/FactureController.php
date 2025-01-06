<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function index()
    {
        $factures = Facture::with('client')->get();
        return view('gestion-factures', compact('factures'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'montant' => 'required|numeric',
            'mois' => 'required|string',
        ]);
        Facture::create($request->all());
        return redirect()->route('factures.index')->with('success', 'Facture créée avec succès.');
    }

    public function sendAll()
    {
        // Logic to send all invoices (for example, via email)
        return redirect()->route('factures.index')->with('success', 'Toutes les factures ont été envoyées.');
    }
}
