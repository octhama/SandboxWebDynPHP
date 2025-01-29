<?php

// Modèle RendezVous
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    protected $table = 'rendez_vous';

    protected $fillable = [
        'client_id',
        'horaire_debut',
        'horaire_fin',
        'nombre_personnes',
        'confirmed',
    ];

    protected $casts = [
        'horaire_debut' => 'datetime',
        'horaire_fin' => 'datetime',
    ];
    // Relation avec le modèle Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    // Relation avec les poneys (manipulés via un tableau JSON)
    public function poneys()
    {
        return $this->belongsToMany(Poney::class, 'rendez_vous_poneys', 'rendez_vous_id', 'poney_id');
    }
}
