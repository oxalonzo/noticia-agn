<?php

namespace App\Http\Controllers;

use App\Models\Destacada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DestacadaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $destacadas = Destacada::all();
        return view('noticia-destacada.index', compact('destacadas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('noticia-destacada.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
          $request->validate([
            'titulo_noticia_portada_destacada' => 'required|string|max:255',
            'titulo_noticia_destacada'         => 'required|string|max:255',
            'descripcion_noticia_destacada'    => 'required|string|max:2000',
            'imagen_noticia_destacada'         => 'nullable|in:imagen1.jpg,imagen2.jpg,imagen3.jpg,imagen4.jpg,imagen5.jpg,imagen6.jpg',
            'imagen_personalizada'   => 'nullable|image|max:2048', // 2MB máximo
            'imagenes'                         => 'nullable|array',
            'imagenes.*'                       => 'image|mimes:jpeg,png,jpg,gif|max:4048',
        ]);

         // Manejo de múltiples imágenes
    $imagenes = [];

    if ($request->hasFile('imagenes')) {
        foreach ($request->file('imagenes') as $imagen) {
            $nombreArchivo = uniqid() . '.' . $imagen->getClientOriginalExtension();
            $imagen->storeAs('imagenes_publicaciones_destacadas', $nombreArchivo, 'public');
            $imagenes[] = $nombreArchivo;
        }
    }

         // Determinar qué imagen usar
    // $imagenFinal = $request->imagen_noticia_destacada;

    // if ($request->hasFile('imagen_personalizada')) {
    //     $archivo = $request->file('imagen_personalizada');
    //     $nombreArchivo = uniqid() . '.' . $archivo->getClientOriginalExtension();
    //     $archivo->storeAs('imagenes_subidas_noticias_destacada', $nombreArchivo, 'public');
    //     $imagenFinal = $nombreArchivo; // Solo guarda el nombre del archivo
    // } elseif ($request->filled('imagen_noticia')) {
    //     $imagenFinal = $request->imagen_noticia_destacada; // imagen predefinida
    // } else {
    //     $imagenFinal = null;
    // }

     // Manejo de imagen de portada
    $imagenFinal = null;

    if ($request->hasFile('imagen_personalizada')) {
        $archivo = $request->file('imagen_personalizada');
        $nombreArchivo = uniqid() . '.' . $archivo->getClientOriginalExtension();
        $archivo->storeAs('imagenes_subidas_noticias_destacada', $nombreArchivo, 'public');
        $imagenFinal = $nombreArchivo;
    } elseif ($request->filled('imagen_noticia_destacada')) {
        $imagenFinal = $request->imagen_noticia_destacada;
    }
    
        // Aquí puedes guardar los datos en la base de datos
        // Ejemplo:
        Destacada::create([
            'titulo_noticia_portada_destacada' => $request->titulo_noticia_portada_destacada,
            'titulo_noticia_destacada'         => $request->titulo_noticia_destacada,
            'descripcion_noticia_destacada'    => $request->descripcion_noticia_destacada,
            'imagen_noticia_destacada'         => $imagenFinal,
            'imagenes'                         => json_encode($imagenes),
            'user_id'                          => Auth::id()
        ]);
    
        return redirect()->route('destacada.index')->with('success', 'Publicación creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Destacada $destacada)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         $destacada = Destacada::findOrFail($id); // Encuentra el banner por ID
        return view('noticia-destacada.edit', compact('destacada'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
          // Validación
         $request->validate([
             'titulo_noticia_portada_destacada' => 'required|string|max:255',
             'titulo_noticia_destacada'         => 'required|string|max:255',
             'descripcion_noticia_destacada'    => 'required|string|max:2000',
             'imagen_noticia_destacada'         => 'nullable|in:imagen1.jpg,imagen2.jpg,imagen3.jpg,imagen4.jpg,imagen5.jpg,imagen6.jpg',
             'imagen_personalizada'             => 'nullable|image|max:2048', // 2MB máximo
             'imagenes'                         => 'nullable|array',
             'imagenes.*'                       => 'image|mimes:jpeg,png,jpg,gif|max:4048',
             'eliminar_imagenes'                => 'nullable|array',
             'eliminar_imagenes.*'              => 'string',
         ]);
     
         // Obtener la noticia que estamos editando
         $destacada = Destacada::findOrFail($id);
     

           // 1. Manejar eliminación de imágenes múltiples (campo `imagenes`)
    $imagenesActuales = json_decode($destacada->imagenes, true) ?? [];
    $imagenesEliminar = $request->input('eliminar_imagenes', []);

    $imagenesFinales = array_filter($imagenesActuales, function ($img) use ($imagenesEliminar) {
        return !in_array($img, $imagenesEliminar);
    });

    foreach ($imagenesEliminar as $imgEliminar) {
        if (Storage::disk('public')->exists('imagenes_publicaciones_destacadas/' . $imgEliminar)) {
            Storage::disk('public')->delete('imagenes_publicaciones_destacadas/' . $imgEliminar);
        }
    }

    // 2. Subida de nuevas imágenes múltiples
    if ($request->hasFile('imagenes')) {
        foreach ($request->file('imagenes') as $imagen) {
            $nombreArchivo = uniqid() . '.' . $imagen->getClientOriginalExtension();
            $imagen->storeAs('imagenes_publicaciones_destacadas', $nombreArchivo, 'public');
            $imagenesFinales[] = $nombreArchivo;
        }
    }



      // Determinar qué imagen usar
    $imagenFinal = $destacada->imagen_noticia_destacada;

    // Si se sube una nueva imagen personalizada
    if ($request->hasFile('imagen_personalizada')) {
        // Eliminar la imagen anterior si es personalizada
        if ($destacada->imagen_noticia_destacada && !str_starts_with($destacada->imagen_noticia_destacada, 'imagen')) {
            $imagePath = public_path('storage/imagenes_subidas_noticias_destacada/' . $destacada->imagen_noticia_destacada);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Eliminar el archivo
            }
        }

        // Subir la nueva imagen
        $archivo = $request->file('imagen_personalizada');
        $nombreArchivo = uniqid() . '.' . $archivo->getClientOriginalExtension();
        $archivo->storeAs('imagenes_subidas_noticias_destacada', $nombreArchivo, 'public');
        $imagenFinal = $nombreArchivo; // Guardamos el nombre del archivo
    } elseif ($request->filled('imagen_noticia_destacada')) {
        // Si se selecciona una imagen predefinida, no es necesario eliminar nada si ya es una imagen predeterminada
        // Pero si la imagen es personalizada previamente, la eliminamos
        if ($destacada->imagen_noticia_destacada && !str_starts_with($destacada->imagen_noticia_destacada, 'imagen')) {
            $imagePath = public_path('storage/imagenes_subidas_noticias_destacada/' . $destacada->imagen_noticia_destacada);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Eliminar el archivo
            }
        }
        $imagenFinal = $request->imagen_noticia_destacada; // Imagen predefinida seleccionada
    }
     
         // Actualizar la noticia
         $destacada->update([
             'titulo_noticia_portada_destacada' => $request->titulo_noticia_portada_destacada,
             'titulo_noticia_destacada'         => $request->titulo_noticia_destacada,
             'descripcion_noticia_destacada'    => $request->descripcion_noticia_destacada,
             'imagenes'                         => json_encode(array_values($imagenesFinales)), // Limpieza de índices
             'imagen_noticia_destacada'         => $imagenFinal,
         ]);
     
         return redirect()->route('destacada.index')->with('success', 'Publicación actualizada exitosamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $destacada = Destacada::findOrFail($id); // Encuentra el noticia por ID

 
         // Elimina el noticia de la base de datos
         $destacada->delete();
 
         return redirect()->route('destacada.index')->with('success', 'Publicación eliminado correctamente');
    }
}
