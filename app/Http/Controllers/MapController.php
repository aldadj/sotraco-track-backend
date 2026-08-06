<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Affiche la page de la carte.
     */
    public function index()
    {
        return view('tracking.map');
    }
}
