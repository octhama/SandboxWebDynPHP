<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Class Customer créée par la commande "php artisan make:model Customer" dans le terminal dans le dossier "app/Models"
// pour la table "Customer" de la base de données "chinook" du fichier ".env"
// cela crrée le fichier "Customer.php" dans le dossier "app/Models" et le fichier "CustomerController.php" dans le dossier "app/Http/Controllers"
//le controller permet de mettre en relation le fichier "Customer.php" avec la table "Customer" de la base de données "chinook"
// et de pouvoir utiliser les fonctionnalités de l'ORM Laravel pour interagir avec la base de données

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers'; // Nom exact de la table
    protected $primaryKey = 'CustomerId'; // Si différent de "id"
    public $timestamps = false; // Si la table n'a pas `created_at` et `updated_at`
    protected $fillable = [ // Attributs de la table qui peuvent être modifiables par l'utilisateur
        'FirstName',
        'LastName',
        'Company',
        'Address',
        'City',
        'State',
        'Country',
        'PostalCode',
        'Phone',
        'Fax',
        'Email',
        'SupportRepId'
    ];
}
