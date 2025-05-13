<?php

namespace App\Http\Controllers;

use App\Models\Noticias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class NoticiasController extends Controller
{
    //dashboar

    public function index()
    {
         $noticias = Noticias::all();
        return view('noticias_admin.Dashboard', compact('noticias'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //crea un nuevo banner
        return view('noticias_admin.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo_noticia_portada' => 'required|string|max:255',
            'titulo_noticia'         => 'required|string|max:255',
            'descripcion_noticia'    => 'required|string|max:2000',
            'imagen_noticia'         => 'required|in:imagen1.jpg,imagen2.jpg,imagen3.jpg,imagen4.jpg,imagen5.jpg,imagen6.jpg',
        ]);
    
        // Aquí puedes guardar los datos en la base de datos
        // Ejemplo:
        Noticias::create([
            'titulo_noticia_portada' => $request->titulo_noticia_portada,
            'titulo_noticia'         => $request->titulo_noticia,
            'descripcion_noticia'    => $request->descripcion_noticia,
            'imagen_noticia'         => $request->imagen_noticia,
            'user_id'                => Auth::id()
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Noticia creada exitosamente.');
    

    }

  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //mostrar la vista de editar banner
        $noticia = Noticias::findOrFail($id); // Encuentra el banner por ID
        return view('noticias_admin.edit', compact('noticia')); // Muestra el formulario de edición
    }

   


     // Actualizar un banner en la base de datos
     public function update(Request $request, $id)
     {
        $request->validate([
            'titulo_noticia_portada' => 'required|string|max:255',
            'titulo_noticia'         => 'required|string|max:255',
            'descripcion_noticia'    => 'required|string|max:2000',
            'imagen_noticia'         => 'required|in:imagen1.jpg,imagen2.jpg,imagen3.jpg,imagen4.jpg,imagen5.jpg,imagen6.jpg',
        ]);
        
 
         $noticia = Noticias::findOrFail($id); // Encuentra el banner
 
         // Actualizar enlace y descripción
         $noticia->titulo_noticia_portada = $request->input('titulo_noticia_portada');
         $noticia->titulo_noticia = $request->input('titulo_noticia');
         $noticia->descripcion_noticia = $request->input('descripcion_noticia');
         $noticia->imagen_noticia = $request->input('imagen_noticia');
         $noticia->user_id = Auth::id();
 
         // Actualiza el resto de los datos
         $noticia->save();
 
         return redirect()->route('dashboard')->with('success', 'Noticia actualizada correctamente');
     
     }


  



     // Eliminar un noticia
     public function destroy($id)
     {
         $noticia = Noticias::findOrFail($id); // Encuentra el noticia por ID

 
         // Elimina el noticia de la base de datos
         $noticia->delete();
 
         return redirect()->route('dashboard')->with('success', 'Noticia eliminado correctamente');
     }

}
