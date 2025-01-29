<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'email',
        'nombre_personnes',
        'heures',
        'prix_total',
    ];

    // Relation inverse avec le modèle RendezVous
    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }
}



