<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalierController;
use App\Http\Controllers\PoneyController;
use App\Http\Controllers\FactureController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/rapports', [RapportController::class, 'index'])->name('rapports.index');
Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
Route::get('/support', [SupportController::class, 'index'])->name('support.index');


Route::get('/rendezvous', [RendezVousController::class, 'index'])->name('rendezvous.index');
Route::post('/rendezvous/assigner/{id}', [RendezVousController::class, 'assignerPoneys'])->name('rendezvous.assigner');

Route::resource('clients', ClientController::class);
Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');


Route::resource('poneys', PoneyController::class);
Route::get('poneys/{poney}/edit', [PoneyController::class, 'edit'])->name('poneys.edit');

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

Route::get('/rendezvous/create', [RendezVousController::class, 'create'])->name('rendezvous.create');
Route::post('/rendezvous', [RendezVousController::class, 'store'])->name('rendezvous.store');
