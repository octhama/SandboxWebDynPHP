<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::resource('customers', CustomerController::class); // Ressource route pour les clients : index, create, store, show, edit, update, destroy
