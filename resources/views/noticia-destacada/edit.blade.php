@section('titulo')
    Editar Publicación
@endsection

@php
    $nombresImagenes = [
        1 => 'Avisos',
        2 => 'Charlas',
        3 => 'Cursos',
        4 => 'Vacantes',
    ];
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Publicación ' .  $destacada->titulo_noticia_destacada ) }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center h-full">
        <div class="md:w-3/4 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0 ">

            <div class="flex justify-end items-center mb-4">
                <x-link :href="route('destacada.index')"
                    class=" border border-[#dd6b10] p-3 text-xs text-white dark:text-white hover:text-white font-bold dark:hover:text-white rounded-md focus:outline-none bg-[#dd6b10] hover:bg-[#e98f3a]">
                    Ver todas las Publicaciones
                </x-link>
            </div>

            <form action="{{ route('destacada.update', $destacada->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="flex flex-wrap">
                    {{-- Columna izquierda: campos de texto --}}
                    <div class="w-full md:w-1/2 px-4">
                        {{-- Titulo Noticia Portada --}}
                        <div class="mb-5">
                            <x-input-label for="titulo_noticia_portada_destacada" :value="__('Título Noticia Portada')" class="mb-2 block uppercase text-gray-500 font-bold" />
                            <x-text-input id="titulo_noticia_portada_destacada" class="p-3 w-full mb-4" type="text" name="titulo_noticia_portada_destacada" value="{{ old('titulo_noticia_portada_destacada', $destacada->titulo_noticia_portada_destacada) }}" required />
                            <x-input-error :messages="$errors->get('titulo_noticia_portada_destacada')" class="mt-2" />
                        </div>
            
                        {{-- Titulo Noticia --}}
                        <div class="mb-5">
                            <x-input-label for="titulo_noticia_destacada" :value="__('Título Noticia')" class="mb-2 block uppercase text-gray-500 font-bold" />
                            <x-text-input id="titulo_noticia_destacada" class="p-3 w-full mb-4" type="text" name="titulo_noticia_destacada" value="{{ old('titulo_noticia_destacada', $destacada->titulo_noticia_destacada) }}" required />
                            <x-input-error :messages="$errors->get('titulo_noticia_destacada')" class="mt-2" />
                        </div>
            
                        {{-- Descripción Noticia --}}
                        <div class="mb-5">
                            <x-input-label for="descripcion_noticia_destacada" :value="__('Descripción Noticia')" class="mb-2 block uppercase text-gray-500 font-bold" />
                            <textarea id="descripcion_noticia_destacada" name="descripcion_noticia_destacada" rows="4" class="p-3 w-full border-gray-300 focus:border-[#dd6b10] focus:ring-[#dd6b10] rounded-md shadow-sm" required>{{ old('descripcion_noticia_destacada', $destacada->descripcion_noticia_destacada) }}</textarea>
                            <x-input-error :messages="$errors->get('descripcion_noticia_destacada')" class="mt-2" />
                        </div>

                        {{-- Imágenes Actuales con opción de eliminar --}}
            @if ($destacada->imagenes)
                <div class="mb-5">
                    <x-input-label :value="__('Imágenes Actuales')" class="mb-2 block uppercase text-gray-500 font-bold" />
                    <div class="flex overflow-x-auto gap-2 max-w-full">
                        <div class="flex flex-nowrap space-x-2">
                            @foreach (json_decode($destacada->imagenes, true) ?? [] as $index => $img)
                                <div class="relative flex flex-col items-center">
                                    <img src="{{ asset('storage/imagenes_publicaciones_destacadas/' . $img) }}" alt="Imagen subida"
                                        class="w-20 h-20 object-cover rounded shadow flex-shrink-0 mb-1">

                                    {{-- Checkbox para eliminar --}}
                                    <label class="text-xs text-red-600 cursor-pointer select-none">
                                        <input type="checkbox" name="eliminar_imagenes[]" value="{{ $img }}" class="mr-1">
                                        Eliminar
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            {{-- Subir nuevas imágenes --}}
            <div class="mb-5">
                <x-input-label for="imagenes" :value="__('Subir Nuevas Imágenes')" class="mb-2 block uppercase text-gray-500 font-bold" />
                <input 
                    type="file" 
                    name="imagenes[]" 
                    id="imagenes" 
                    multiple 
                    accept="image/*"
                    class="p-3 w-full border-gray-300 focus:border-[#dd6b10] focus:ring-[#dd6b10] rounded-md shadow-sm"
                >
                <x-input-error :messages="$errors->get('imagenes')" class="mt-2" />
            </div>

                    </div>
            
                    {{-- Columna derecha: selección de imagen --}}
                    <div class="w-full md:w-1/2 px-4">
                        <x-input-label :value="__('Selecciona una Imagen para la Noticia')" class="mb-4 block uppercase text-gray-500 font-bold" />
                        <x-input-error :messages="$errors->get('imagen_noticia_destacada')" class="mt-2" />
                        <div class="grid grid-cols-2 gap-4">
                            @foreach (range(1, 4) as $i)
                                <label class="cursor-pointer relative border-2 border-transparent hover:border-[#dd6b10]  rounded overflow-hidden p-1">
                                    <input type="radio" name="imagen_noticia_destacada" value="imagen{{ $i }}.jpg" class="hidden peer" @if($destacada->imagen_noticia_destacada === 'imagen'.$i.'.jpg') checked @endif>
                                    <img src="{{ asset('imagenes_noticias/imagen'.$i.'.jpg') }}" alt="Imagen {{ $i }}" class="w-full h-32 object-cover rounded peer-checked:border-4 peer-checked:border-indigo-500">
                                    <span class="mt-2 text-sm text-gray-700 font-bold flex justify-center">{{ $nombresImagenes[$i] }}</span>
                                </label>
                            @endforeach

                            {{-- Subir imagen personalizada --}}
                            <div class="mt-6">
                               <x-input-label for="imagen_personalizada" :value="__('Peronalizado')" class="mb-2 block uppercase text-gray-500 font-bold" />
                               <input type="file" name="imagen_personalizada" id="imagen_personalizada" class="block w-full text-sm text-gray-500
                               file:mr-4 file:py-2 file:px-4
                               file:rounded file:border-0
                                file:text-sm file:font-semibold
                               file:bg-gray-300 file:text-[#dd6b10]
                               hover:file:bg-[#dd6b10] hover:file:text-white
                               " accept="image/*">
                               <x-input-error :messages="$errors->get('imagen_personalizada')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
            
                {{-- Botón para enviar --}}
                <div class="mt-6">
                    <button type="submit" class=" bg-[#dd6b10] hover:bg-[#e98f3a] text-white px-6 py-2 rounded ">Actualizar Publicación</button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
