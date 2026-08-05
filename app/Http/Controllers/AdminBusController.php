<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class AdminBusController extends Controller
{
    /**
     * Affiche la page de gestion des bus avec la liste et le formulaire.
     */
    public function index()
    {
        $buses = Bus::orderBy('number')->get();
        return view('admin.buses.index', ['buses' => $buses]);
    }

    /**
     * Enregistre un nouveau bus depuis le formulaire web.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|unique:buses',
            'line' => 'required',
            'destination' => 'required'
        ]);

        Bus::create($validated);

        // Redirige vers la page de gestion avec un message de succès.
        return redirect()->route('admin.buses.index')->with('success', 'Bus créé avec succès !');
    }

    /**
     * Affiche le formulaire pour modifier un bus existant.
     */
    public function edit(Bus $bus)
    {
        return view('admin.buses.edit', ['bus' => $bus]);
    }

    /**
     * Met à jour un bus dans la base de données.
     */
    public function update(Request $request, Bus $bus)
    {
        $validated = $request->validate([
            // La règle 'unique' doit ignorer l'ID du bus actuel lors de la validation
            'number' => 'required|unique:buses,number,' . $bus->id,
            'line' => 'required',
            'destination' => 'required'
        ]);

        $bus->update($validated);

        return redirect()->route('admin.buses.index')->with('success', 'Bus mis à jour avec succès !');
    }

    /**
     * Supprime un bus.
     */
    public function destroy(Bus $bus)
    {
        // Avant de supprimer le bus, on pourrait vouloir supprimer les localisations associées.
        // $bus->locations()->delete(); // Décommentez si vous avez une relation 'locations'
        
        $bus->delete();

        return redirect()->route('admin.buses.index')->with('success', 'Bus supprimé avec succès !');
    }
}