<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poney extends Model
{
    protected $table = 'poneys';
    protected $fillable = ['nom', 'heures_travail', 'heures_max'];

    public function rendezVous()
    {
        return $this->belongsToMany(RendezVous::class, 'rendez_vous_poneys', 'poney_id', 'rendez_vous_id');
    }

    public function isAvailableDuring($start, $end)
    {
        return !$this->rendezVous()
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('horaire_debut', [$start, $end])
                    ->orWhereBetween('horaire_fin', [$start, $end]);
            })
            ->exists();
    }
}





