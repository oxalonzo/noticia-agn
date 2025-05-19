<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        if (Auth::user()->rol !== 1) {
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para acceder a esa página.');
        }
    
        $usuarios = User::paginate(3);
        return view('usuarios_admin.index', compact('usuarios'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        if (Auth::user()->rol !== 1) {
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para acceder a esa página.');
        }
        
         //mostrar la vista de editar usuario
         $usuario = User::findOrFail($id); // Encuentra el banner por ID
         return view('usuarios_admin.edit', compact('usuario')); // Muestra el formulario de edición
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|max:255|unique:users,email,' . $id,
            'rol' => 'required|in:1,2',
            'password' => 'nullable|confirmed|min:8',
        ]);
    
        $usuario = User::findOrFail($id);
    
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->rol = $request->rol;
    
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
    
        $usuario->save();
    
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    $usuario = User::findOrFail($id);

         // Opcional: Evitar que un usuario se elimine a sí mismo
    if (Auth::id() === $usuario->id) {
        return redirect()->route('usuarios.index')->with('error', 'No puedes eliminar tu propio usuario.');
    }

    $usuario->delete();

    return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }


    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }



}
