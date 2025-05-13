@section('titulo')
    Crear una noticia
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
            {{ __('Crear una nueva noticia') }}
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

            
            <form action="{{ route('noticia.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
            
                <div class="flex flex-wrap">
                    {{-- Columna izquierda: campos de texto --}}
                    <div class="w-full md:w-1/2 px-4">
                        {{-- Titulo Noticia Portada --}}
                        <div class="mb-5">
                            <x-input-label for="titulo_noticia_portada" :value="__('Título Noticia Portada')" class="mb-2 block uppercase text-gray-500 font-bold" />
                            <x-text-input id="titulo_noticia_portada" class="p-3 w-full mb-4" type="text" name="titulo_noticia_portada" required />
                        </div>
            
                        {{-- Titulo Noticia --}}
                        <div class="mb-5">
                            <x-input-label for="titulo_noticia" :value="__('Título Noticia')" class="mb-2 block uppercase text-gray-500 font-bold" />
                            <x-text-input id="titulo_noticia" class="p-3 w-full mb-4" type="text" name="titulo_noticia" required />
                        </div>
            
                        {{-- Descripción Noticia --}}
                        <div class="mb-5">
                            <x-input-label for="descripcion_noticia" :value="__('Descripción Noticia')" class="mb-2 block uppercase text-gray-500 font-bold" />
                            <textarea id="descripcion_noticia" name="descripcion_noticia" rows="4" class="p-3 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required></textarea>
                        </div>
                    </div>
            
                    {{-- Columna derecha: selección de imagen --}}
                    <div class="w-full md:w-1/2 px-4">
                        <x-input-label :value="__('Selecciona una Imagen para la Noticia')" class="mb-4 block uppercase text-gray-500 font-bold" />
            
                        <div class="grid grid-cols-2 gap-4">
                            @foreach (range(1, 6) as $i)
                                <label class="cursor-pointer relative border-2 border-transparent hover:border-indigo-500 rounded overflow-hidden p-1">
                                    <input type="radio" name="imagen_noticia" value="imagen{{ $i }}.jpg" class="hidden peer" required>
                                    <img src="{{ asset('imagenes_noticias/imagen'.$i.'.jpg') }}" alt="Imagen {{ $i }}" class="w-full h-32 object-cover rounded peer-checked:border-4 peer-checked:border-indigo-500">
                                    <span class="mt-2 text-sm text-gray-700 font-bold flex justify-center">{{ $nombresImagenes[$i] }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            
                {{-- Botón para enviar --}}
                <div class="mt-6">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Guardar Noticia</button>
                </div>
            </form>


        </div>

    </div>
</x-app-layout>



