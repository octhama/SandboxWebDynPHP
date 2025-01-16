<?php

// Modèle Client
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = ['nom', 'nombre_personnes', 'prix_total', 'heures'];

    // Relation inverse avec le modèle RendezVous
    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }
}


