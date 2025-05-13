<?php

namespace App\Http\Controllers;

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
        return view('lectores.home', compact('noticias'));
    }

   

    /**
     * Display the specified resource.
     */
    public function show(Lectores $lectores)
    {
        // mostrar una noticia en especifico

    }


}
