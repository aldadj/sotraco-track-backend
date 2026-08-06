<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\AdminBusController;

Route::get('/', function () {
    return view('welcome');
});

// Page de la carte en temps réel
Route::get('/map', [MapController::class, 'index'])->name('map.index');

// Groupe de routes pour l'administration des bus
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/buses', [AdminBusController::class, 'index'])->name('buses.index');
    Route::post('/buses', [AdminBusController::class, 'store'])->name('buses.store');
    Route::get('/buses/{bus}/edit', [AdminBusController::class, 'edit'])->name('buses.edit');
    Route::put('/buses/{bus}', [AdminBusController::class, 'update'])->name('buses.update');
    Route::delete('/buses/{bus}', [AdminBusController::class, 'destroy'])->name('buses.destroy');
});
