<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'nom',
        'nombre_personnes',
        'heures',
        'prix',
    ];

    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class, 'client_id');
    }
}
