<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poney extends Model
{
    protected $table = 'poneys';
    protected $fillable = ['nom', 'current_hours', 'max_work_hours'];

    public function rendezVous()
    {
        return $this->belongsToMany(RendezVous::class, 'rendez_vous_poneys');
    }

    // Définissez 'id' comme clé primaire si nécessaire
    protected $primaryKey = 'id';
}
