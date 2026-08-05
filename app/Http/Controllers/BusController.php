<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{

    /**
     * Afficher tous les bus
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Bus::all()
        ]);
    }


    /**
     * Ajouter un bus
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'number' => 'required|unique:buses',
            'line' => 'required',
            'destination' => 'required'
        ]);


        $bus = Bus::create($validated);


        return response()->json([
            'status' => true,
            'message' => 'Bus créé avec succès',
            'data' => $bus
        ], 201);

    }


    /**
     * Afficher un bus
     */
    public function show(Bus $bus)
    {

        return response()->json([
            'status'=>true,
            'data'=>$bus
        ]);

    }


}