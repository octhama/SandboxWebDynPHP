<?php

// app/Models/Employee.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees'; // Nom exact de la table dans la base de données
    protected $primaryKey = 'EmployeeId'; // Clé primaire (si ce n'est pas "id")
    public $timestamps = false; // Désactiver les timestamps si non utilisés

    protected $fillable = [
        'LastName',
        'FirstName',
        'Title',
        'BirthDate',
        'Country',
    ];
}
