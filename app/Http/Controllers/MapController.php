<?php

namespace App\Http\Controllers;
use App\Models\Bus;
use Illuminate\Http\Request;

class MapController extends Controller
{

    /**
     * Affiche la page de suivi d'un bus spécifique.
     */
    public function bus(Bus $bus)
    {
        $bus->load('latestLocation');

        return view('tracking.bus', compact('bus'));
    }
    /**
     * Affiche la page de la carte.
     */
    public function index()
    {
        return view('tracking.map');
    }
}
