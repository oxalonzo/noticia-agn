@php use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $destacada->titulo_noticia_destacada }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function toggleModal() {
      document.getElementById('modalImagen').classList.toggle('hidden');
    }

    // Scroll automático al contenido
    window.addEventListener('load', () => {
      const contenido = document.getElementById('contenidoNoticia');
      contenido.scrollIntoView({ behavior: 'smooth' });
    });
  </script>
</head>
<body class="bg-white text-gray-800 min-h-screen p-6 relative">

  <!-- Encabezado con imagen y título portada -->
  <div class="max-w-6xl w-full mx-auto bg-white shadow-2xl rounded-xl border border-orange-300 overflow-hidden p-6 md:p-10 space-y-10 animate-fade-in-up">
    <div class="flex flex-col md:flex-row items-center gap-6">
      <!-- Imagen -->
      <div class="w-full md:w-[35%] cursor-pointer group" onclick="toggleModal()">
        <div class="overflow-hidden rounded-lg shadow-lg transition-transform duration-300 group-hover:scale-105">
          <img 
            src="{{ Str::startsWith($destacada->imagen_noticia_destacada, 'http') 
                ? $destacada->imagen_noticia_destacada 
                : (file_exists(public_path('storage/imagenes_subidas_noticias_destacada/' . $destacada->imagen_noticia_destacada)) 
                  ? asset('storage/imagenes_subidas_noticias_destacada/' . $destacada->imagen_noticia_destacada) 
                  : asset('imagenes_noticias/' . $destacada->imagen_noticia_destacada)) }}" 
            alt="Imagen de la noticia"
            class="w-full h-64 object-cover rounded-lg"
          >
        </div>
        <p class="text-center text-sm text-gray-500 mt-2 italic">Haz clic en la imagen para verla en pantalla completa</p>
      </div>

      <!-- Título de portada -->
      <div class="w-full md:w-[65%] text-center md:text-left animate-fade-in-up">
        <h2 class="text-2xl md:text-3xl text-center font-bold text-[#dd6b10]">
          {{ $destacada->titulo_noticia_portada_destacada }}
        </h2>
      </div>
    </div>
  </div>

  <!-- Contenido con efecto de crecimiento -->
  <div id="contenidoNoticia" class="max-w-6xl w-full mx-auto bg-white shadow-2xl rounded-xl border border-orange-300 overflow-hidden p-6 md:p-10 mt-10 transform scale-75 opacity-0 animate-grow-in">
    <!-- Título de la noticia -->
    <h1 class="text-3xl md:text-4xl font-extrabold text-[#dd6b10] text-center mb-6">
      {{ $destacada->titulo_noticia_destacada }}
    </h1>

    <!-- Descripción -->
    <div class="text-base md:text-lg leading-relaxed text-gray-700 whitespace-pre-line text-center mx-auto max-w-prose">
      {{ $destacada->descripcion_noticia_destacada }}
    </div>
  </div>

  <!-- Botón volver -->
  <div class="w-fit ml-auto mt-10 mr-20 animate-bounce hover:animate-none transition-all duration-300">
    <a href="{{ route('noticias.index') }}" 
       class="inline-block bg-[#dd6b10] text-white px-6 py-3 rounded-full shadow-md hover:bg-orange-600 hover:scale-105 transition transform duration-300">
       
       Volver a las Publicaciones
    </a>
  </div>

  <!-- Modal de imagen fullscreen -->
  <div id="modalImagen" class="hidden fixed inset-0 bg-black bg-opacity-80 z-50  items-center justify-center transition-all">
    <div class="relative max-w-5xl w-full">
      <button onclick="toggleModal()" class="absolute top-4 right-4 text-white text-3xl font-bold z-50 hover:scale-110 transition">&times;</button>
      <img 
        src="{{ Str::startsWith($destacada->imagen_noticia_destacada, 'http') 
            ? $destacada->imagen_noticia_destacada 
            : (file_exists(public_path('storage/imagenes_subidas_noticias_destacada/' . $destacada->imagen_noticia_destacada)) 
              ? asset('storage/imagenes_subidas_noticias_destacada/' . $destacada->imagen_noticia_destacada) 
              : asset('imagenes_noticias/' . $destacada->imagen_noticia_destacada)) }}" 
        alt="Imagen de la noticia en pantalla completa"
        class="w-full h-[90vh] object-contain mx-auto"
      >
    </div>
  </div>

  <!-- Estilos personalizados -->
  <style>
    @keyframes fade-in-up {
      0% { opacity: 0; transform: translateY(30px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in-up {
      animation: fade-in-up 0.8s ease-out both;
    }

    @keyframes grow-in {
      0% {
        transform: scale(0.5);
        opacity: 0;
      }
      100% {
        transform: scale(1);
        opacity: 1;
      }
    }

    .animate-grow-in {
      animation: grow-in 0.8s ease-out forwards;
    }
  </style>

</body>
</html>
