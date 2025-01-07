<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventsController extends Controller
{
    // Muestra una lista de todos los eventos
    public function index()
    {
        $events = Events::all();
        return view('events.index', compact('events'));
    }

    // Muestra el formulario para crear un nuevo evento
    public function create()
    {
        return view('events.create');
    }

    // Almacena un nuevo evento en la base de datos
    public function store(Request $request)
    { // Validación de los campos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date', // Validación para datetime
            'description' => 'required|string', // Validación para datetime
            'user_name' => 'required|string|max:255',
            'user_phone' => 'required|string|max:15', // Ajusta según lo que necesites
            'location' => 'required|string|max:255',
        ]);

        try {
            // Crea el evento en la base de datos
            Events::create([
                'name' => $request->input('name'),
                'date' => $request->input('date'),
                'user_name' => $request->input('user_name'),
                'user_phone' => $request->input('user_phone'),
                'location' => $request->input('location'),
                'description' => $request->input('description'),
            ]);

            return redirect()->route('events.index')
                ->with('success', 'Evento registrado exitosamente.');
        } catch (Exception $e) {
            // En caso de error, muestra los detalles en el log y la vista
            Log::error('Error al registrar evento: ' . $e->getMessage());

            // Redirige con un mensaje de error
            return redirect()->route('events.index')
                ->with('error', 'Ocurrió un error al registrar el evento.');
        }
    }

    // Muestra un evento específico
    public function show(Events $event)
    {
        return view('events.show', compact('event'));
    }

    // Muestra el formulario para editar un evento
    public function edit(Events $event)
    {
        return view('events.edit', compact('event'));
    }

    // Actualiza un evento específico
    public function update(Request $request, Events $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'user_name' => 'required|string|max:255',
            'user_phone' => 'required|string|max:20',
            'location' => 'required|string',
        ]);

        try {
            // Actualiza el evento
            $event->update([
                'name' => $request->name,
                'description' => $request->description,
                'date' => $request->date,
                'user_name' => $request->user_name,
                'user_phone' => $request->user_phone,
                'location' => $request->location,
            ]);

            return redirect()->route('events.index')
                ->with('success', 'Evento actualizado con éxito.');
        } catch (Exception $e) {
            // Registra el error en el log
            Log::error('Error al actualizar evento: ' . $e->getMessage());

            // Redirige con un mensaje de error
            return redirect()->route('events.index')
                ->with('error', 'Ocurrió un error al actualizar el evento.');
        }
    }

    // Elimina un evento específico
    public function destroy(Events $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento eliminado con éxito.');
    }
}
