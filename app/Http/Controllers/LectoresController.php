<?php

namespace App\Http\Controllers;

use App\Models\Destacada;
use App\Models\Lectores;
use App\Models\Noticias;
use Illuminate\Http\Request;

class LectoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mostrar las noticias 
        $noticias = Noticias::all();

        // Obtener la última noticia publicada
        $destacada = Destacada::latest()->first();
        
        return view('welcome', compact('noticias', 'destacada'));
    }

   

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       // Buscar la noticia por ID
    $noticia = Noticias::findOrFail($id);

    // Retornar los datos de la noticia en formato JSON
    return response()->json([
        'titulo' => $noticia->titulo_noticia,
        'descripcion' => $noticia->descripcion_noticia,
        'imagen' => $noticia->imagen_noticia,
    ]);

    }


    //busca la noticia destacada
    public function MostrarDestacada($id)
    {

           // Buscar la noticia por ID
    $destacada = Destacada::findOrFail($id);

    // Retornar los datos de la destacada en formato JSON
    return response()->json([
        'titulo' => $destacada->titulo_noticia_destacada,
        'descripcion' => $destacada->descripcion_noticia_destacada,
        'imagen' => $destacada->imagen_noticia_destacada,
    ]);

       

    }


}
