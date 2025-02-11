<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturation extends Model {

    use HasFactory;

    protected $fillable = ['client_id', 'nombre_heures', 'montant', 'mois'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

}




