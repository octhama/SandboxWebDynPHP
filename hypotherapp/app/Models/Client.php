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

    protected static function boot()
    {
        parent::boot();

        static::created(function ($client) {
            Facturation::create([
                'client_id' => $client->id,
                'nombre_heures' => $client->heures,
                'montant' => 0.00, // Valeur initiale de la facturation
            ]);
        });
    }
}



