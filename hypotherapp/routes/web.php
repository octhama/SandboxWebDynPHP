<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FacturationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\PoneyController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// ========================
// 🔐 AUTHENTIFICATION
// ========================
// Affichage du formulaire de connexion
Route::get('/', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
// Soumission du formulaire de connexion
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
// Déconnexion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ========================
// 🔒 ZONE PROTÉGÉE (AUTH)
// ========================
Route::middleware(['auth'])->group(function () {

    // 🏠 Tableau de bord
    Route::get('/dashboard', function () {
        return view('dashboard.welcome');
    })->name('dashboard.welcome');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // ========================
    // 📁 GESTION DES CLIENTS
    // ========================

    Route::resource('clients', ClientController::class)->except(['destroy']);
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])
        ->name('clients.destroy')
        ->middleware('can:delete,client'); // Utilisation correcte
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{id}/invoice', [ClientController::class, 'generateInvoice'])->name('clients.invoice');

    // ========================
    // 🐴 GESTION DES PONEYS
    // ========================
    Route::resource('poneys', PoneyController::class)->except(['destroy']);
    Route::delete('/poneys/{poney}', [PoneyController::class, 'destroy'])
        ->name('poneys.destroy')
        ->middleware('can:delete,poney');

    // ========================
    // 📆 GESTION DES RENDEZ-VOUS
    // ========================
    Route::resource('rendez-vous', RendezVousController::class);
    Route::post('/rendez-vous/{id}/confirm', [RendezVousController::class, 'confirm'])->name('rendez-vous.confirm');
    Route::patch('/rendez-vous/{id}/reset', [RendezVousController::class, 'reset'])->name('rendez-vous.reset');
    Route::put('/rendez-vous/{id}', [RendezVousController::class, 'update'])->name('rendez-vous.update');
    Route::get('/rendez-vous/{id}/edit', [RendezVousController::class, 'edit'])->name('rendez-vous.edit');
    Route::delete('/rendez-vous/{id}', [RendezVousController::class, 'destroy'])->name('rendez-vous.destroy');
    Route::post('/rendez-vous/assigner/{id}', [RendezVousController::class, 'assignerPoneys'])->name('rendez-vous.assigner');

    // ========================
    // 💰 GESTION DE LA FACTURATION
    // ========================
    Route::resource('facturation', FacturationController::class);

    // ========================
    // ⚙️ PARAMÈTRES ET AUTRES
    // ========================
    Route::get('/rapports', [RapportController::class, 'index'])->name('rapports.index');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('/support', [SupportController::class, 'index'])->name('support.index');

    // ========================
    // 🔍 CALCUL DU PRIX
    // ========================
    Route::post('/calcul-prix', function (Request $request) {
        $nombrePersonnes = (int) $request->input('nombre_personnes');
        $dureeMinutes = (int) $request->input('duree');

        // Vérifier que la durée est d'au moins 10 minutes
        if ($dureeMinutes < 10) {
            return response()->json(['error' => 'La durée minimale est de 10 minutes.'], 400);
        }

        $tarifParMinute = 185 / 20;  // Prix par minute (185 € pour 20 minutes)
        $prixTotal = $nombrePersonnes * $dureeMinutes * $tarifParMinute;

        return response()->json(['prix_total' => number_format($prixTotal, 2, '.', '')]);
    })->name('calcul.prix');

});
