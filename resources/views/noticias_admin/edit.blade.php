@section('titulo')
    Edita la noticia
@endsection

@php
    $nombresImagenes = [
        1 => 'junta',
        2 => 'aviso importante',
        3 => 'cumpleaños',
        4 => 'flojo',
        5 => 'premios',
        6 => 'pago',
    ];
@endphp


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar noticia ' .  $noticia->titulo_noticia ) }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center h-full">
      
        <div class="md:w-3/4 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0 ">

            <div class="flex justify-end items-center mb-4">
                <x-link :href="route('dashboard')"
                    class=" border border-indigo-500 p-3 text-xs text-white dark:text-white hover:text-white font-bold dark:hover:text-white rounded-md focus:outline-none bg-indigo-500 hover:bg-indigo-700">
                    Ver todas las noticias
                </x-link>
            </div>

            
            <form action="{{ route('noticia.update', $noticia->id) }}" method="POST">
                @csrf
                @method('PUT')
        
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Primera columna: campos de texto -->
                    <div>
                        <!-- Título Portada -->
                        <div class="mb-4">
                            <x-input-label for="titulo_noticia_portada" :value="__('Título Portada')" class="mb-2 block uppercase text-gray-500 font-bold" />
                            <x-text-input id="titulo_noticia_portada" class="p-3 w-full" type="text" name="titulo_noticia_portada"
                                value="{{ old('titulo_noticia_portada', $noticia->titulo_noticia_portada) }}" required />
                        </div>
        
                        <!-- Título Noticia -->
                        <div class="mb-4">
                            <x-input-label for="titulo_noticia" :value="__('Título de la Noticia')" class="mb-2 block uppercase text-gray-500 font-bold" />
                            <x-text-input id="titulo_noticia" class="p-3 w-full" type="text" name="titulo_noticia"
                                value="{{ old('titulo_noticia', $noticia->titulo_noticia) }}" required />
                        </div>
        
                        <!-- Descripción -->
                        <div class="mb-4">
                            <x-input-label for="descripcion_noticia" :value="__('Descripción')" class="mb-2 block uppercase text-gray-500 font-bold" />
                            <textarea id="descripcion_noticia" name="descripcion_noticia" class="w-full p-3 border border-gray-300 rounded"
                                rows="5" required>{{ old('descripcion_noticia', $noticia->descripcion_noticia) }}</textarea>
                        </div>
                    </div>
        
                    <!-- Segunda columna: selección de imagen -->
                    <div>
                        <p class="mb-4 text-gray-700 font-semibold">Selecciona una imagen para la noticia:</p>
        
                        <div class="grid grid-cols-2 gap-4">
                            @php
                                $imagenes = [
                                    'imagen1.jpg' => 'Paisaje urbano',
                                    'imagen2.jpg' => 'Naturaleza viva',
                                    'imagen3.jpg' => 'Evento cultural',
                                    'imagen4.jpg' => 'Tecnología y futuro',
                                    'imagen5.jpg' => 'Noticias deportivas',
                                    'imagen6.jpg' => 'Educación y sociedad'
                                ];
                            @endphp
        
                            @foreach ($imagenes as $archivo => $nombre)
                                <label class="cursor-pointer relative border-2 border-transparent hover:border-indigo-500 rounded overflow-hidden">
                                    <input type="radio" name="imagen_noticia" value="{{ $archivo }}"
                                        class="hidden peer"
                                        {{ $noticia->imagen_noticia === $archivo ? 'checked' : '' }}>
                                    <img src="{{ asset('imagenes_noticias/' . $archivo) }}" alt="{{ $nombre }}"
                                        class="w-full h-32 object-cover rounded peer-checked:border-4 peer-checked:border-indigo-500">
                                    <span class="mt-2 block text-center text-sm text-gray-700 font-semibold">{{ $nombre }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
        
                <!-- Botón de enviar -->
                <div class="mt-6 ">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded shadow transition duration-200">
                        Actualizar Noticia
                    </button>
                </div>
            </form>

        </div>

    </div>
</x-app-layout>



