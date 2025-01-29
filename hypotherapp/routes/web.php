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


Route::get('/rendez-vous', [RendezVousController::class, 'index'])->name('rendez-vous.index');

Route::post('/rendez-vous/{id}/confirm', [RendezVousController::class, 'confirm'])->name('rendez-vous.confirm');
Route::patch('/rendez-vous/{id}/reset', [RendezVousController::class, 'reset'])->name('rendez-vous.reset');
Route::delete('/rendez-vous/{id}', [RendezVousController::class, 'destroy'])->name('rendez-vous.destroy');

Route::post('/rendez-vous/assigner/{id}', [RendezVousController::class, 'assignerPoneys'])->name('rendez-vous.assigner');

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

Route::get('/rendez-vous/create', [RendezVousController::class, 'create'])->name('rendez-vous.create');
Route::post('/rendez-vous', [RendezVousController::class, 'store'])->name('rendez-vous.store');
