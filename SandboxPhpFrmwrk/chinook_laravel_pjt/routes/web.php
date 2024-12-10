<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;

Route::resource('customers', CustomerController::class); // Ressource route pour les clients : index, create, store, show, edit, update, destroy
Route::resource('employees', EmployeeController::class); // Ressource route pour les employés : index, create, store, show, edit, update, destroy
Route::get('/', function () {
    return view('welcome');
}); // Route pour la page d'accueil de l'application
