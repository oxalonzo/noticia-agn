<?php

namespace App\Http\Controllers;

use App\Models\Noticias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class NoticiasController extends Controller
{
    //dashboar

    public function index(Request $request)
{
    // Obtener el término de búsqueda (si lo hay)
    $search = $request->input('search');
    
    // Filtrar las noticias por título de portada o título
    $noticias = Noticias::when($search, function ($query, $search) {
        return $query->where('titulo_noticia_portada', 'like', "%{$search}%")
                     ->orWhere('titulo_noticia', 'like', "%{$search}%");
    })->paginate(3); // Paginación de 10 noticias por página

    return view('dashboard', compact('noticias'));
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
            'imagenes' => ['required', 'array'],
            'imagenes.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:4048'], // 2MB máximo por imagen
            'imagen_noticia'         => 'nullable|in:imagen1.jpg,imagen2.jpg,imagen3.jpg,imagen4.jpg,imagen5.jpg,imagen6.jpg',
            'imagen_personalizada'   => 'nullable|image|max:4048', // 2MB máximo
        ]);


        //guarada varias imagenes subida para la publicacion
       $imagenes = [];

if ($request->hasFile('imagenes')) {
    foreach ($request->file('imagenes') as $imagen) {
        // Generar un nombre único para la imagen
        $nombreArchivo = uniqid() . '.' . $imagen->getClientOriginalExtension();

        // Guardar la imagen en la carpeta 'imagenes_publicaciones' pero sólo guardar el nombre
        $imagen->storeAs('imagenes_publicaciones', $nombreArchivo, 'public');

        // Solo guardamos el nombre, no la ruta
        $imagenes[] = $nombreArchivo;
    }
}


         // Determinar qué imagen usar
    $imagenFinal = $request->imagen_noticia;

    if ($request->hasFile('imagen_personalizada')) {
        $archivo = $request->file('imagen_personalizada');
        $nombreArchivo = uniqid() . '.' . $archivo->getClientOriginalExtension();
        $archivo->storeAs('imagenes_subidas_noticias', $nombreArchivo, 'public');
        $imagenFinal = $nombreArchivo; // Solo guarda el nombre del archivo
    } elseif ($request->filled('imagen_noticia')) {
        $imagenFinal = $request->imagen_noticia; // imagen predefinida
    } else {
        $imagenFinal = null;
    }
    
        // Aquí puedes guardar los datos en la base de datos
        // Ejemplo:
        Noticias::create([
            'titulo_noticia_portada' => $request->titulo_noticia_portada,
            'titulo_noticia'         => $request->titulo_noticia,
            'descripcion_noticia'    => $request->descripcion_noticia,
            'imagenes'               => json_encode($imagenes),
            'imagen_noticia'         => $imagenFinal,
            'user_id'                => Auth::id()
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Publicación creada exitosamente.');
    

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
    // Validación
    $request->validate([
        'titulo_noticia_portada' => 'required|string|max:255',
        'titulo_noticia'         => 'required|string|max:255',
        'descripcion_noticia'    => 'required|string|max:2000',
        'imagen_noticia'         => 'nullable|in:imagen1.jpg,imagen2.jpg,imagen3.jpg,imagen4.jpg,imagen5.jpg,imagen6.jpg',
        'imagen_personalizada'   => 'nullable|image|max:4048', // 4MB máximo
        'imagenes'               => 'nullable|array',
        'imagenes.*'             => 'image|mimes:jpeg,png,jpg,gif|max:4048',
        'eliminar_imagenes'      => 'nullable|array',
        'eliminar_imagenes.*'    => 'string',
    ]);

    // Obtener la noticia que estamos editando
    $noticia = Noticias::findOrFail($id);

    // --- 1. Manejar eliminación de imágenes múltiples (JSON) ---
    $imagenesActuales = json_decode($noticia->imagenes, true) ?? [];
    $imagenesEliminar = $request->input('eliminar_imagenes', []);

    // Filtrar las imágenes que NO fueron marcadas para eliminar
    $imagenesFinales = array_filter($imagenesActuales, function ($img) use ($imagenesEliminar) {
        return !in_array($img, $imagenesEliminar);
    });

    // Borrar físicamente las imágenes marcadas para eliminar
    foreach ($imagenesEliminar as $imgEliminar) {
        if (Storage::disk('public')->exists('imagenes_publicaciones/' . $imgEliminar)) {
            Storage::disk('public')->delete('imagenes_publicaciones/' . $imgEliminar);
        }
    }

    // --- 2. Manejar subida de nuevas imágenes múltiples ---
    if ($request->hasFile('imagenes')) {
        foreach ($request->file('imagenes') as $imagen) {
            $nombreArchivo = uniqid() . '.' . $imagen->getClientOriginalExtension();
            $imagen->storeAs('imagenes_publicaciones', $nombreArchivo, 'public');
            $imagenesFinales[] = $nombreArchivo;
        }
    }

    // --- 3. Manejar imagen principal ---
    $imagenFinal = $noticia->imagen_noticia;

    if ($request->hasFile('imagen_personalizada')) {
        // Eliminar imagen anterior personalizada si existe
        if ($noticia->imagen_noticia && !str_starts_with($noticia->imagen_noticia, 'imagen')) {
            $imagePath = public_path('storage/imagenes_subidas_noticias/' . $noticia->imagen_noticia);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $archivo = $request->file('imagen_personalizada');
        $nombreArchivo = uniqid() . '.' . $archivo->getClientOriginalExtension();
        $archivo->storeAs('imagenes_subidas_noticias', $nombreArchivo, 'public');
        $imagenFinal = $nombreArchivo;
    } elseif ($request->filled('imagen_noticia')) {
        // Si cambia de imagen predefinida y la anterior era personalizada, eliminar archivo personalizado
        if ($noticia->imagen_noticia && !str_starts_with($noticia->imagen_noticia, 'imagen')) {
            $imagePath = public_path('storage/imagenes_subidas_noticias/' . $noticia->imagen_noticia);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $imagenFinal = $request->imagen_noticia;
    }

    // --- 4. Actualizar noticia ---
    $noticia->update([
        'titulo_noticia_portada' => $request->titulo_noticia_portada,
        'titulo_noticia'         => $request->titulo_noticia,
        'descripcion_noticia'    => $request->descripcion_noticia,
        'imagenes'               => json_encode(array_values($imagenesFinales)), // reindexar para JSON limpio
        'imagen_noticia'         => $imagenFinal,
    ]);

    return redirect()->route('dashboard')->with('success', 'Publicación actualizada exitosamente.');
}

     

  



     // Eliminar un noticia
     public function destroy($id)
     {
         $noticia = Noticias::findOrFail($id); // Encuentra el noticia por ID

 
         // Elimina el noticia de la base de datos
         $noticia->delete();
 
         return redirect()->route('dashboard')->with('success', 'Publicación eliminado correctamente');
     }

}