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
        'minutes', // Durée en minutes
        'prix_total',
    ];

    protected static function boot()
    {
        parent::boot();

        // Quand un client est créé, créer une facturation associée avec les mêmes données initiales
        static::created(function ($client) {
            Facturation::create([
                'client_id' => $client->id,
                'nombre_heures' => $client->minutes, // Garder les minutes, pas d'erreur de conversion
                'montant' => $client->prix_total,
            ]);
        });

        // Quand un client est mis à jour, mettre à jour la facturation associée
        static::updated(function ($client) {
            $facturation = Facturation::where('client_id', $client->id)->first();
            if ($facturation) {
                $facturation->update([
                    'nombre_heures' => $client->minutes, // Toujours en minutes
                    'montant' => $client->prix_total,
                ]);
            }
        });

        // Quand un client est supprimé, supprimer la facturation associée
        static::deleted(function ($client) {
            $facturation = Facturation::where('client_id', $client->id)->first();
            if ($facturation) {
                $facturation->delete();
            }
        });
    }
}
