<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusLocation;
use Illuminate\Http\Request;

class BusLocationController extends Controller
{

    // Récupérer les dernières positions de tous les bus actifs
    public function currentLocations()
    {
        // On ne prend que les bus qui ont déjà eu au moins une position
        $busIdsWithLocation = BusLocation::select('bus_id')->distinct()->get()->pluck('bus_id');

        $locations = Bus::whereIn('id', $busIdsWithLocation)
            ->with('latestLocation') // Assurez-vous que la relation 'latestLocation' est définie dans le modèle Bus
            ->get()
            ->map(function ($bus) {
                return [
                    'bus_id' => $bus->id,
                    'number' => $bus->number,
                    'line' => $bus->line,
                    'destination' => $bus->destination,
                    'latitude' => $bus->latestLocation->latitude,
                    'longitude' => $bus->latestLocation->longitude,
                    'timestamp' => $bus->latestLocation->created_at,
                ];
            });

        return response()->json(["data" => $locations]);
    }

    // Récupérer la dernière position d'un bus
    public function currentLocation(Bus $bus)
    {
        $location = BusLocation::where('bus_id', $bus->id)
            ->with('bus')->latest() // Charger la relation 'bus'
            ->first();


        if (!$location) {

            return response()->json([
                "status" => false,
                "message" => "Aucune position trouvée"
            ]);

        }


        return response()->json([
            "status" => true,
            "data" => $location
        ]);
    }



    // Enregistrer une nouvelle position GPS
    public function store(Request $request)
    {

        $data = $request->validate([

            'bus_id' => 'required|exists:buses,id',

            'user_id' => 'required|exists:users,id',

            'latitude' => 'required|numeric',

            'longitude' => 'required|numeric',

            'speed' => 'nullable|numeric',

            'heading' => 'nullable|numeric',

            'accuracy' => 'nullable|numeric',

        ]);


        $location = BusLocation::create($data);


        return response()->json([

            'status' => true,

            'message' => 'Position enregistrée',

            'data' => $location

        ]);

    }




    // Alias pour récupérer la dernière position
    public function latest(int $busId)
    {

        $location = BusLocation::where('bus_id', $busId)
            ->latest()
            ->first();


        return response()->json([

            'status'=>true,

            'data'=>$location

        ]);

    }

}