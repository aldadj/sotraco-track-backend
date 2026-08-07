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
Route::prefix('admin')
    ->group(function () {

    Route::get('/buses', [AdminBusController::class,'index'])
        ->name('admin.buses.index');

    Route::post('/buses', [AdminBusController::class,'store'])
        ->name('admin.buses.store');

    Route::get('/buses/{bus}/edit', [AdminBusController::class,'edit'])
        ->name('admin.buses.edit');

    Route::put('/buses/{bus}', [AdminBusController::class,'update'])
        ->name('admin.buses.update');

    Route::delete('/buses/{bus}', [AdminBusController::class,'destroy'])
        ->name('admin.buses.destroy');

});