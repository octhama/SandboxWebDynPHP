<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\RendezVousController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalierController;
use App\Http\Controllers\PoneyController;
use App\Http\Controllers\FactureController;

Route::get('/rendezvous', [RendezVousController::class, 'index'])->name('rendezvous.index');
Route::post('/rendezvous/assigner/{id}', [RendezVousController::class, 'assignerPoneys'])->name('rendezvous.assigner');

Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
