@section('titulo')
    Crear una Publicación destacada
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
            {{ __('Crear una nueva noticia destacada') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center h-full">
      
        <div class="md:w-3/4 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0 ">

            <div class="flex justify-end items-center mb-4">
                <x-link :href="route('destacada.index')"
                    class=" border border-[#dd6b10] p-3 text-xs text-white dark:text-white hover:text-white font-bold dark:hover:text-white rounded-md focus:outline-none bg-[#dd6b10] hover:bg-[#e98f3a]">
                    Ver todas las publicaciones
                </x-link>
            </div>

            
            <form action="{{ route('destacada.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
            
                <div class="flex flex-wrap">
                    {{-- Columna izquierda: campos de texto --}}
                    <div class="w-full md:w-1/2 px-4">
                        {{-- Titulo Noticia Portada --}}
                        <div class="mb-5">
                            <x-input-label for="titulo_noticia_portada_destacada" :value="__('Título Portada ')" class="mb-2 block uppercase text-gray-500 font-bold" />
                            <x-text-input id="titulo_noticia_portada_destacada" class="p-3 w-full mb-4" type="text" name="titulo_noticia_portada_destacada" required />
                            <x-input-error :messages="$errors->get('titulo_noticia_portada_destacada')" class="mt-2" />
                        </div>
            
                        {{-- Titulo Noticia --}}
                        <div class="mb-5">
                            <x-input-label for="titulo_noticia_destacada" :value="__('Título Publicación  ')" class="mb-2 block uppercase text-gray-500 font-bold" />
                            <x-text-input id="titulo_noticia_destacada" class="p-3 w-full mb-4" type="text" name="titulo_noticia_destacada" required />
                            <x-input-error :messages="$errors->get('titulo_noticia_destacada')" class="mt-2" />
                        </div>
            
                        {{-- Descripción Noticia --}}
                        <div class="mb-5">
                            <x-input-label for="descripcion_noticia_destacada" :value="__('Descripción ')" class="mb-2 block uppercase text-gray-500 font-bold" />
                            <textarea id="descripcion_noticia_destacada" name="descripcion_noticia_destacada" rows="4" class="p-3 w-full border-gray-300 focus:border-[#dd6b10] focus:ring-[#dd6b10] rounded-md shadow-sm" required></textarea>
                            <x-input-error :messages="$errors->get('descripcion_noticia_destacada')" class="mt-2" />
                        </div>
                    </div>
            
                    {{-- Columna derecha: selección de imagen --}}
                    <div class="w-full md:w-1/2 px-4">
                        <x-input-label :value="__('Selecciona imagen de Publicación  ')" class="mb-4 block uppercase text-gray-500 font-bold" />
                        <x-input-error :messages="$errors->get('imagen_noticia_destacada')" class="mt-2" />
                        <div class="grid grid-cols-2 gap-4">
                            @foreach (range(1, 6) as $i)
                                <label class="cursor-pointer relative border-2 border-transparent hover:border-[#dd6b10] rounded overflow-hidden p-1">
                                    <input type="radio" name="imagen_noticia_destacada" value="imagen{{ $i }}.jpg" class="hidden peer" required>
                                    <img src="{{ asset('imagenes_noticias/imagen'.$i.'.jpg') }}" alt="Imagen {{ $i }}" class="w-full h-32 object-cover rounded peer-checked:border-4 peer-checked:border-indigo-500">
                                    <span class="mt-2 text-sm text-gray-700 font-bold flex justify-center">{{ $nombresImagenes[$i] }}</span>
                                </label>
                            @endforeach

                            {{-- Subir imagen personalizada --}}
                            <div class="mt-6">
                               <x-input-label for="imagen_personalizada" :value="__('O sube tu propia imagen')" class="mb-2 block uppercase text-gray-500 font-bold" />
                               <input type="file" name="imagen_personalizada" id="imagen_personalizada" class="block w-full text-sm text-gray-500
                               file:mr-4 file:py-2 file:px-4
                               file:rounded file:border-0
                                file:text-sm file:font-semibold
                               file:bg-gray-300 file:text-black
                               hover:file:bg-gray-200
                               " accept="image/*">
                               <x-input-error :messages="$errors->get('imagen_personalizada')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
            
                {{-- Botón para enviar --}}
                <div class="mt-6">
                    <button type="submit" class=" bg-green-500 text-white px-6 py-2 rounded hover:bg-green-400">Guardar</button>
                </div>
            </form>


        </div>

    </div>
</x-app-layout>



