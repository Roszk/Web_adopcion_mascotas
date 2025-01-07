<?php

namespace App\Http\Controllers;

use App\Models\HappyEndings;
use App\Models\Pets;
use Illuminate\Http\Request;

class HappyEndingsController extends Controller
{
    // Muestra todos los finales felices
    public function index()
    {
        $happyEndings = HappyEndings::with('pet')->get();
        $adopted_pets = Pets::whereHas('godfather')->get();
        return view('happy-endings.index', compact('happyEndings', 'adopted_pets'));
    }

    // Muestra el formulario para crear un nuevo final feliz
    public function create(Request $request)
    {
        $pet = Pets::where('id', $request->query('petId'))->first();

        if (!$pet) {
            return redirect()->route('happy-endings.index')->with('error', 'La mascota no fue encontrada.');
        }

        return view('happy-endings.create', compact('pet'));
    }

    // Guarda un nuevo final feliz
    public function store(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'story' => 'required|string',
            'location' => 'required|string',
        ]);

        $pet = Pets::findOrFail($request->pet_id);

        // Validamos que la mascota esté adoptada
        if ($pet->getStatus() !== 'Adoptado') {
            return redirect()->back()->with('error', 'Solo las mascotas adoptadas pueden tener un final feliz.');
        }

        $happyEnding = new HappyEndings($request->only(['pet_id', 'story', 'location']));

        $happyEnding->images = json_encode(collect($request->file('images'))->map(fn($file) => $file->store('happy_endings', 'public'))->toArray());


        $happyEnding->save();

        return redirect()->route('happy-endings.index')->with('success', 'Final feliz creado exitosamente.');
    }

    // Muestra el formulario para editar un final feliz
    public function edit(HappyEndings $happyEnding)
    {
        // Obtener todas las mascotas adoptadas
        $pets = Pets::whereHas('godfather')->get(); // Solo mascotas adoptadas
        return view('happy-endings.edit', compact('happyEnding', 'pets'));
    }

    // Actualiza un final feliz
    public function update(Request $request, HappyEndings $happyEnding)
    {
        // Validación de los datos
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'story' => 'required|string',
            'location' => 'required|string',
        ]);

        // Actualizar los campos del final feliz
        $happyEnding->fill($request->only(['pet_id', 'story', 'location']));

        // Si se suben nuevas imágenes, procesarlas y almacenarlas
        if ($request->has('images')) {
            $happyEnding->images = json_encode(collect($request->file('images'))->map(fn($file) => $file->store('happy_endings', 'public'))->toArray());
        }

        // Guardar los cambios
        $happyEnding->save();

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('happy-endings.index')->with('success', 'Final feliz actualizado exitosamente.');
    }

    // Elimina un final feliz
    public function destroy(HappyEndings $happyEnding)
    {
        $happyEnding->delete();
        return redirect()->route('happy-endings.index')->with('success', 'Final feliz eliminado exitosamente.');
    }
}
