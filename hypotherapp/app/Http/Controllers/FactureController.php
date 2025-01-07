<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Facture;
use App\Models\Historique;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    // Afficher la page de gestion des factures
    public function index()
    {
        // Obtenir les données nécessaires
        $historique = Historique::orderBy('id', 'desc')->get();
        $factures = Facture::with('client')->where('mois', 'Octobre 2024')->get();
        $total = $factures->sum('montant');

        return view('factures.index', compact('historique', 'factures', 'total'));
    }

    // Envoyer toutes les factures
    public function envoyerFactures()
    {
        // Logique pour envoyer les factures (exemple : générer un PDF et l'envoyer par email)
        $factures = Facture::where('mois', 'Octobre 2024')->get();

        // Exemple de boucle pour envoyer chaque facture
        foreach ($factures as $facture) {
            // Appeler une fonction d'envoi (peut être un service dédié pour l'envoi d'emails)
            $this->envoyerFactureEmail($facture);
        }

        return redirect()->back()->with('success', 'Toutes les factures ont été envoyées avec succès.');
    }

    // Fonction privée pour envoyer une facture par email
    private function envoyerFactureEmail(Facture $facture)
    {
        // Exemple de logique pour générer un PDF et envoyer un email
        // Mail::to($facture->client->email)->send(new FactureEmail($facture));
    }
}
