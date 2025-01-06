<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{

    protected $table = 'rendez_vous';

    protected $fillable = [
        'client_id',
        'date',
        'heure',
        'prix',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function poneys()
    {
        return $this->belongsToMany(Poney::class, 'rendez_vous_poneys');
    }
}
