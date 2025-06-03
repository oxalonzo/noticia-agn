<?php

namespace App\Http\Controllers;

use App\Models\Frases;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $frases = Frases::paginate(5);
        return view('frase_dia.index', compact('frases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         return view('frase_dia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'frase' => 'required|string|min:5|max:255|regex:/^[\pL\s.,;:!?¡¿"\'()-]+$/u'
        ]);

        Frases::create([
            'frase' => $request->frase,
            'user_id' => Auth::id()
        ]);

       return redirect()->route('frases.index')->with('success', 'Frase creada correctamente');
    }

  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $frase = Frases::FindorFail($id);

        return view('frase_dia.edit', compact('frase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
        $request->validate([
            'frase' => 'required|string|min:5|max:255|regex:/^[\pL\s.,;:!?¡¿"\'()-]+$/u'
        ]);

         $frase = Frases::findOrFail($id);

         $frase->update([
            'frase' => $request->frase,
            'user_id' => Auth::id()
         ]);

         return redirect()->route('frases.index')->with('success', 'Frase actualizada exitosamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $frase = Frases::findOrFail($id); // Encuentra el frase por ID

 
         // Elimina el frase de la base de datos
         $frase->delete();
 
         return redirect()->route('frases.index')->with('success', 'Publicación eliminado correctamente');
    }
}
