<?php

// Modèle Poney
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poney extends Model
{
    protected $table = 'poneys';
    protected $fillable = ['nom', 'disponible'];
}





