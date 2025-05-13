<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
       
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
       
        <h1>qqui van las noticias </h1>

        {{-- <div x-data="{ activeSlide: 0 }" class="relative w-full max-w-6xl mx-auto overflow-hidden mt-10">
            <div class="flex transition-transform duration-500"
                 :style="'transform: translateX(-' + activeSlide * 100 + '%)'">
                @foreach($noticias as $noticia)
                    <a href="{{ route('noticia.show', $noticia->id) }}"
                       class="min-w-full p-4 bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300">
                        <img src="{{ asset('imagenes_noticias/' . $noticia->imagen_noticia) }}"
                             alt="{{ $noticia->titulo_noticia_portada }}"
                             class="w-full h-64 object-cover rounded-md mb-4">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $noticia->titulo_noticia_portada }}</h3>
                        <p class="text-gray-600">{{ Str::limit($noticia->descripcion_noticia, 100) }}</p>
                    </a>
                @endforeach
            </div>
        
            <!-- Controles -->
            <div class="absolute inset-y-0 left-0 flex items-center">
                <button @click="activeSlide = activeSlide > 0 ? activeSlide - 1 : {{ count($noticias) - 1 }}"
                        class="bg-gray-800 text-white p-2 rounded-full hover:bg-gray-600">
                    ‹
                </button>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center">
                <button @click="activeSlide = activeSlide < {{ count($noticias) - 1 }} ? activeSlide + 1 : 0"
                        class="bg-gray-800 text-white p-2 rounded-full hover:bg-gray-600">
                    ›
                </button>
            </div>
        
            <!-- Indicadores -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                @foreach($noticias as $index => $noticia)
                    <button @click="activeSlide = {{ $index }}"
                            :class="activeSlide === {{ $index }} ? 'bg-indigo-600' : 'bg-gray-300'"
                            class="w-3 h-3 rounded-full"></button>
                @endforeach
            </div>
        </div>
         --}}


    </body>
</html>
