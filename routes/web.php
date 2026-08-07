<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\AdminBusController;
use App\Models\Bus;

// Page d'accueil
Route::get('/', function () {

    // Récupérer tous les bus enregistrés
    $buses = Bus::orderBy('number')->get();

    return view('index', compact('buses'));

})->name('home');

// Page de gestion des bus
Route::patch(
    '/admin/buses/{bus}/tracking',
    [AdminBusController::class,'toggleTracking']
)
->name('admin.buses.tracking');

// Page de la carte
Route::get('/tracking/map', function () {
    return view('tracking.map');
})->name('map.index');

// Page de la carte en temps réel
Route::get('/tracking', [MapController::class, 'index'])->name('tracking.map');

// Récupérer la dernière position d'un bus
Route::get('/tracking/bus/{bus}', 
[MapController::class,'bus'])
->name('tracking.bus');

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