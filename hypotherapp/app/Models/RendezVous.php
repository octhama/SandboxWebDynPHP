<?php

// Modèle RendezVous
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    protected $table = 'rendez_vous';
    protected $fillable = [
        'client_id', // Si cette colonne existe dans la table RendezVous
        'horaire',
        'nombre_personnes',
        'poneys_assignes',
        'prix_total',
    ];
    // Relation avec le modèle Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
