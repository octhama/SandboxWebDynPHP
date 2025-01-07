<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $table = 'factures'; // Nom de la table
    protected $fillable = ['client_id', 'nombre_jours', 'montant', 'mois'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public $timestamps = true;
}
