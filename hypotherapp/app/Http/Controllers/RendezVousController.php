<?php

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
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'horaire' => 'required|regex:/^\d{1,2}h\d{2}-\d{1,2}h\d{2}$/', // Format horaire valide
            'nombre_personnes' => 'required|integer|min:1',
            'poneys' => 'required|array|min:1', // Vérifie qu'au moins un poney est sélectionné
        ]);

        $horaire = $this->parseHoraire($request->horaire); // Convertir l'horaire en timestamps
        $poneys = $request->poneys;

        // Vérification des plages horaires (6h max)
        if (($horaire['end'] - $horaire['start']) > 6 * 3600) {
            return back()->withErrors(['horaire' => 'La durée du rendez-vous ne peut pas excéder 6 heures.']);
        }

        // Vérification que les poneys sont disponibles
        foreach ($poneys as $poneyId) {
            $poney = Poney::findOrFail($poneyId);

            $overlap = RendezVous::where('poneys_assignes', 'like', "%\"$poneyId\"%")
                ->where(function ($query) use ($horaire) {
                    $query->whereBetween('horaire_start', [$horaire['start'], $horaire['end']])
                        ->orWhereBetween('horaire_end', [$horaire['start'], $horaire['end']])
                        ->orWhere(function ($q) use ($horaire) {
                            $q->where('horaire_start', '<=', $horaire['start'])
                                ->where('horaire_end', '>=', $horaire['end']);
                        });
                })->exists();

            if ($overlap) {
                return back()->withErrors(['poneys' => "Le poney {$poney->nom} est déjà pris pour ce créneau horaire."]);
            }

            if (($poney->heures_travail_effectuee + (($horaire['end'] - $horaire['start']) / 3600)) > $poney->heures_travail_max) {
                return back()->withErrors(['poneys' => "Le poney {$poney->nom} a dépassé ses heures de travail autorisées."]);
            }
        }

        // Créer le rendez-vous
        $rendezVous = RendezVous::create([
            'client_id' => $request->client_id,
            'horaire' => $request->horaire,
            'horaire_start' => $horaire['start'],
            'horaire_end' => $horaire['end'],
            'nombre_personnes' => $request->nombre_personnes,
            'poneys_assignes' => json_encode($poneys),
        ]);

        // Mettre à jour les heures de travail des poneys
        foreach ($poneys as $poneyId) {
            $poney = Poney::find($poneyId);
            $poney->heures_travail_effectuee += ($horaire['end'] - $horaire['start']) / 3600;
            $poney->disponible = false;
            $poney->save();
        }

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous créé avec succès.');
    }

    private function parseHoraire($horaire)
    {
        [$start, $end] = explode('-', $horaire);
        $start = \Carbon\Carbon::createFromFormat('H\hi', str_replace('h', ':', $start))->timestamp;
        $end = \Carbon\Carbon::createFromFormat('H\hi', str_replace('h', ':', $end))->timestamp;

        return ['start' => $start, 'end' => $end];
    }

    public function assignerPoneys(Request $request, $id)
    {
        $rendezVous = RendezVous::findOrFail($id);
        $rendezVous->poneys_assignes = json_encode($request->input('poneys'));
        $rendezVous->save();

        Poney::whereIn('id', $request->input('poneys'))->update(['disponible' => false]);

        return redirect()->back()->with('success', 'Poneys assignés avec succès.');
    }
}
