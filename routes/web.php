<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\AdminBusController;

// Page d'accueil
Route::get('/', function () {
    return view('index');
})->name('home');

// Page de la carte en temps réel
Route::get('/tracking', [MapController::class, 'index'])->name('tracking.map');

// Groupe de routes pour l'administration des bus
Route::prefix('admin')->name('admin.')->group(function () {
    // Utilisation de Route::resource pour simplifier la déclaration des routes CRUD
    Route::resource('buses', AdminBusController::class)->except(['show']);
});
