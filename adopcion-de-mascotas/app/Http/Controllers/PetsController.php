<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetsRequest;
use App\Http\Requests\UpdatePetsRequest;
use App\Models\Pets;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class PetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recupera todos los usuarios
        $pets = Pets::all();
        $veterinaries = User::veterinaries();
        $partners = User::partners();

        return view('pets.index', compact('pets', 'veterinaries', 'partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePetsRequest $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            // Guarda la imagen en el disco público
            $path = $request->file('image')->store('pets', 'public');

            Pets::create([
                'name' => $request->input('name'),
                'sex' => $request->input('sex'),
                'age' => $request->input('age'),
                'type' => $request->input('type'),
                'size' => $request->input('size'),
                'partner_id' => $request->input('partner_id'),
                'veterinary_id' => $request->input('veterinary_id'),
                'image' => $path,
            ]);

            return redirect()->route('pets.index')
                ->with('success', 'Mascota registrada exitosamente.');
        } catch (Exception $e) {
            dd($e);

            Log::error('Error al registrar mascota: ' . $e->getMessage());

            // Redirige con un mensaje de error.
            return redirect()->route('pets.index')
                ->with('error', 'Ocurrió un error al registrar mascota.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pets $pets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pets $pet)
    {
        $veterinaries = User::veterinaries();
        $godfathers = User::godfathers();
        $partners = User::partners();

        return view('pets.edit', compact('pet', 'veterinaries', 'godfathers', 'partners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePetsRequest $request, Pets $pet)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            $file = $request->file('image');

            $path = !$file ? $pet->image : $file->store('pets', 'public');

            // Actualiza los datos del usuario
            $pet->update([
                'name' => $request->input('name'),
                'sex' => $request->input('sex'),
                'age' => $request->input('age'),
                'type' => $request->input('type'),
                'size' => $request->input('size'),
                'partner_id' => $request->input('partner_id'),
                'veterinary_id' => $request->input('veterinary_id'),
                'godfather_id' => $request->input('godfather_id'),
                'image' => $path,
            ]);

            // Redirige con un mensaje de éxito
            return redirect()->route('pets.index')
                ->with('success', 'Mascota actualizada exitosamente.');
        } catch (Exception $e) {
            Log::error('Error al actualizar mascota: ' . $e->getMessage());

            // Redirige con un mensaje de error
            return redirect()->route('pets.index')
                ->with('error', 'Ocurrió un error al actualizar la mascota.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pets $pet)
    {
        $pet->delete();

        return redirect()->route('pets.index')
            ->with('success', 'Mascota eliminada exitosamente.');
    }
}
