<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\PoneyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RendezVousController;


/**
 * Route::get('/', function () {
 * return view('welcome');
 * });
 **/

Route::resource('poneys', PoneyController::class);
Route::get('/poneys/{poney}/edit', [PoneyController::class, 'edit'])->name('poneys.edit');


Route::get('/rendez_vous', [RendezVousController::class, 'index'])->name('rendez_vous.index');
Route::post('/rendez_vous', [RendezVousController::class, 'store'])->name('rendez_vous.store');

Route::resource('clients', ClientController::class);
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');

Route::get('/gestion-factures', [FactureController::class, 'index'])->name('factures.index');
Route::post('/gestion-factures/envoyer', [FactureController::class, 'envoyer'])->name('factures.envoyer');
