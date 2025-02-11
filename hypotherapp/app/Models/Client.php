<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'nombre_personnes',
        'minutes',
        'prix_total',
    ];

    protected static function boot()
    {
        parent::boot();

        // Quand un client est créé, créer une facturation associée
        static::created(function ($client) {
            Facturation::create([
                'client_id'     => $client->id,
                'nombre_heures' => round($client->minutes / 60, 2), // Convertir les minutes en heures
                'montant'       => $client->prix_total,
            ]);
        });

        // Quand un client est mis à jour, mettre à jour la facturation associée
        static::updated(function ($client) {
            $facturation = Facturation::where('client_id', $client->id)->first();
            if ($facturation) {
                $facturation->update([
                    'nombre_heures' => round($client->minutes / 60, 2), // Convertir en heures
                    'montant'       => $client->prix_total,
                ]);
            }
        });
    }
}
