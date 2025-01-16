<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{

    // Spécifie le nom de la table si elle diffère du nom par défaut (le pluriel du modèle)
    protected $table = 'rendez_vous';

    // Les colonnes de la table qui peuvent être remplies par assignation massive
    protected $fillable = [
        'client_id',
        'horaire_debut',
        'horaire_fin',
        'created_at',
        'updated_at',
    ];

    // Les relations avec d'autres modèles

    /**
     * Relation avec le modèle Client.
     * Un rendez-vous appartient à un seul client.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relation avec le modèle Poney.
     * Un rendez-vous peut avoir plusieurs poneys assignés.
     */
    public function poneys()
    {
        return $this->belongsToMany(Poney::class, 'rendez_vous_poneys', 'rendez_vous_id', 'poney_id');
    }
}
