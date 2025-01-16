<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = ['nom', 'nb_personnes'];

    public $timestamps = false; // Désactive la gestion automatique des timestamps


    public function rendezvous()
    {
        return $this->hasMany(RendezVous::class);
    }

    public function getMaxPoneysAttribute()
    {
        return Poney::where('disponible', true)->count();
    }

    public function validateNbPersonnes()
    {
        if ($this->nb_personnes > $this->getMaxPoneysAttribute()) {
            throw new \Exception('Le nombre de personnes dépasse le nombre de poneys disponibles.');
        }
    }
}


