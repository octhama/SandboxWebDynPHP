<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\RendezVousController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalierController;
use App\Http\Controllers\PoneyController;
use App\Http\Controllers\FactureController;

Route::get('/gestion-journaliere', [JournalierController::class, 'index'])->name('gestion.journaliere');
Route::post('/nouveau-client', [JournalierController::class, 'storeClient']);
Route::post('/assigner-poneys', [JournalierController::class, 'assignPoneys']);

Route::get('/gestion-poneys', [PoneyController::class, 'index']);
Route::post('/ajouter-poney', [PoneyController::class, 'store']);
Route::put('/modifier-poney/{id}', [PoneyController::class, 'update']);
Route::delete('/supprimer-poney/{id}', [PoneyController::class, 'destroy']);

Route::get('/gestion-factures', [FactureController::class, 'index']);

Route::post('/rendezvous/store', [RendezVousController::class, 'store'])->name('rendezvous.store');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');

// Routes pour la gestion des rendez-vous
Route::prefix('rendezvous')->group(function () {
    Route::get('/', [RendezVousController::class, 'index'])->name('rendezvous.index');
    Route::get('/create', [RendezVousController::class, 'create'])->name('rendezvous.create');
    Route::post('/store', [RendezVousController::class, 'store'])->name('rendezvous.store');
    Route::get('/{id}/edit', [RendezVousController::class, 'edit'])->name('rendezvous.edit');
    Route::put('/{id}', [RendezVousController::class, 'update'])->name('rendezvous.update');
    Route::delete('/{id}', [RendezVousController::class, 'destroy'])->name('rendezvous.destroy');
});

// Routes pour la gestion des clients
Route::prefix('clients')->group(function () {
    Route::post('/store', [ClientController::class, 'store'])->name('clients.store');
    // Ajoutez d'autres routes pour les clients si nécessaire
});
