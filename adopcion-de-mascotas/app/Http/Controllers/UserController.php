<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recupera todos los usuarios
        $users = User::all();

        return view('users.index', compact('users'));
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
    public function store(StoreUserRequest $request)
    {
        try {
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'type' => $request->input('type'),
            ]);

            return redirect()->route('users.index')
                ->with('success', 'Usuario creado exitosamente.');
        } catch (Exception $e) {
            Log::error('Error al crear usuario: ' . $e->getMessage());

            // Redirige con un mensaje de error.
            return redirect()->route('users.index')
                ->with('error', 'Ocurrió un error al crear el usuario.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            // Actualiza los datos del usuario
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'type' => $request->input('type'),
            ]);

            // Redirige con un mensaje de éxito
            return redirect()->route('users.index')
                ->with('success', 'Usuario actualizado exitosamente.');
        } catch (Exception $e) {
            Log::error('Error al actualizar usuario: ' . $e->getMessage());

            // Redirige con un mensaje de error
            return redirect()->route('users.index')
                ->with('error', 'Ocurrió un error al actualizar el usuario.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}
