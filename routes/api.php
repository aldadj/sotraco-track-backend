<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;
use App\Http\Controllers\BusLocationController;
use App\Models\Bus;
use App\Models\BusLocation;


Route::get('/tracking/buses',
[BusLocationController::class, 'currentLocations']);

Route::get('/tracking/bus/{bus}', 
[BusLocationController::class, 'currentLocation']);

Route::post(
'/tracking/update-location',
[BusLocationController::class,'store']
);

Route::get('/buses', [BusController::class,'index']);

Route::post('/buses', [BusController::class,'store']);

Route::get('/buses/{bus}', [BusController::class,'show']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
