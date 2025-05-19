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
        // mostrar una noticia en especifico
          // Buscar la noticia por ID
    $noticia = Noticias::findOrFail($id);

    // Retornar la vista con la noticia
    return view('noticias-show', compact('noticia'));

    }


    //busca la noticia destacada
    public function MostrarDestacada($id)
    {

        $destacada = Destacada::FindOrFail($id);

        return view('noticias-destacada-show', compact('destacada'));

    }


}
