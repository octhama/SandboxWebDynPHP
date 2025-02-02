<?php

namespace App\Http\Controllers;

use App\Models\Facturation;
use App\Models\Client;
use Illuminate\Http\Request;

class FacturationController extends Controller
{
    public function index() {
        $facturations = Facturation::with('client')->orderByDesc('mois')->get();
        return view('facturation.index', compact('facturations'));
    }

    public function show($id) {
        $facturation = Facturation::with('client')->findOrFail($id);
        return view('facturation.show', compact('facturation'));
    }
}

