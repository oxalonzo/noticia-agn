@section('titulo')
    noticias
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-800 leading-tight">
            {{ __('Publicaciones') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center h-full">

        <div class="md:w-3/4 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0 h-full ">

            <div class="flex justify-between items-center mb-4">
                <!-- Botón para Crear nueva noticia -->
                <x-link :href="route('noticia.create')"
                    class="border border-[#dd6b10] p-3 text-xs text-white dark:text-white hover:text-white font-bold dark:hover:text-white rounded-md focus:outline-none bg-[#dd6b10] hover:bg-[#e98f3a]">
                    Crear nueva Publicación
                </x-link>

                <!-- Barra de búsqueda -->
                <form method="GET" action="{{ route('dashboard') }}" class="flex items-center">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por título"
                        class=" border-gray-300 rounded-md p-2 mr-2 focus:outline-none focus:ring focus:ring-transparent border focus:border-[#dd6b10]">
                    <button type="submit" class="bg-[#dd6b10] hover:bg-[#e98f3a] text-white text-sm font-semibold py-2.5 px-4 rounded shadow transition duration-200">
                        Buscar
                    </button>
                </form>
            </div>

            @if (session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
                    class="rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3 shadow-md mb-3"
                    role="alert">
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
                    class="rounded-lg bg-red-100 border border-red-400 text-red-700 px-4 py-3 shadow-md mb-3"
                    role="alert">
                    <p class="font-semibold">{{ session('error') }}</p>
                </div>
            @endif

            <div class="container mx-auto">
                <h2 class="text-2xl font-semibold mb-4">Lista de Publicaciones</h2>

                <!-- Tabla de Noticias -->
                <table class="min-w-full bg-white border border-gray-300 rounded-md">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Título Portada</th>
                            <th class="px-4 py-2 text-left">Título</th>
                            <th class="px-4 py-2 text-left">Descripción</th>
                            <th class="px-4 py-2 text-left">IMG Portada</th>
                            <th class="px-4 py-2 text-left">Imágenes Subidas</th>
                            <th class="px-4 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($noticias as $noticia)
                            <tr>
                                <td class="px-4 py-2">{{ $noticia->id }}</td>
                                <td class="px-4 py-2">{{ $noticia->titulo_noticia_portada }}</td>
                                <td class="px-4 py-2">{{ $noticia->titulo_noticia }}</td>
                                <td class="px-4 py-2">{{ \Str::limit($noticia->descripcion_noticia, 50) }}</td>
                                <td class="px-4 py-2">
                                    @php
                                    $esImagenSubida = !str_starts_with($noticia->imagen_noticia, 'imagen'); // ejemplo: imagen3.jpg
                                    $rutaImagen = $esImagenSubida
                                        ? asset('storage/imagenes_subidas_noticias/' . $noticia->imagen_noticia)
                                        : asset('imagenes_noticias/' . $noticia->imagen_noticia);
                                    @endphp
                                    <img src="{{ $rutaImagen }}" alt="Imagen noticia" class="w-48 h-auto rounded shadow">
                                </td>

                               <td class="px-4 py-2">
                                  <div class="flex overflow-x-auto gap-2 max-w-xs">
                                    <div class="flex flex-nowrap space-x-2">
                                        @foreach (json_decode($noticia->imagenes, true) ?? [] as $img)
                                             <img src="{{ asset('storage/imagenes_publicaciones/' . $img) }}" alt="Imagen subida"
                                               class="w-20 h-20 object-cover rounded shadow flex-shrink-0">
                                        @endforeach
                                    </div>
                                 </div>
                               </td>

                                <td class="px-4 py-2">
                                    <div class="flex justify-center items-center space-x-3">
                                        <!-- Botón Editar -->
                                        <a href="{{ route('noticia.edit', $noticia->id) }}"
                                           class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold py-1.5 px-4 rounded shadow transition duration-200">
                                            Editar
                                        </a>

                                        <!-- Botón Eliminar -->
                                        <form action="{{ route('noticia.destroy', $noticia->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta noticia?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white text-sm font-semibold py-1.5 px-4 rounded shadow transition duration-200">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginación -->
                <div class="mt-4 bg-white dark:bg-transparent">
                    {{ $noticias->links() }} <!-- Esto genera los enlaces de paginación -->
                </div>

            </div>

        </div>

    </div>
</x-app-layout>
