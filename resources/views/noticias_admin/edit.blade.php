@section('titulo')
    Editar Publicación
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
            {{ __('Editar Noticia ' .  $noticia->titulo_noticia ) }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center h-full">
        <div class="md:w-3/4 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0 ">

            <div class="flex justify-end items-center mb-4">
                <x-link :href="route('dashboard')"
                    class=" border border-[#dd6b10] p-3 text-xs text-white dark:text-white hover:text-white font-bold dark:hover:text-white rounded-md focus:outline-none bg-[#dd6b10] hover:bg-[#e98f3a]">
                    Ver todas las noticias
                </x-link>
            </div>

            <form action="{{ route('noticia.update', $noticia->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="flex flex-wrap">
                    {{-- Columna izquierda: campos de texto --}}
                    <div class="w-full md:w-1/2 px-4">
                        {{-- Titulo Noticia Portada --}}
                        <div class="mb-5">
                            <x-input-label for="titulo_noticia_portada" :value="__('Título Noticia Portada')" class="mb-2 block uppercase text-gray-500 font-bold" />
                            <x-text-input id="titulo_noticia_portada" class="p-3 w-full mb-4" type="text" name="titulo_noticia_portada" value="{{ old('titulo_noticia_portada', $noticia->titulo_noticia_portada) }}" required />
                            <x-input-error :messages="$errors->get('titulo_noticia_portada')" class="mt-2" />
                        </div>
            
                        {{-- Titulo Noticia --}}
                        <div class="mb-5">
                            <x-input-label for="titulo_noticia" :value="__('Título Noticia')" class="mb-2 block uppercase text-gray-500 font-bold" />
                            <x-text-input id="titulo_noticia" class="p-3 w-full mb-4" type="text" name="titulo_noticia" value="{{ old('titulo_noticia', $noticia->titulo_noticia) }}" required />
                            <x-input-error :messages="$errors->get('titulo_noticia')" class="mt-2" />
                        </div>
            
                        {{-- Descripción Noticia --}}
                        <div class="mb-5">
                            <x-input-label for="descripcion_noticia" :value="__('Descripción Noticia')" class="mb-2 block uppercase text-gray-500 font-bold" />
                            <textarea id="descripcion_noticia" name="descripcion_noticia" rows="4" class="p-3 w-full border-gray-300 focus:border-[#dd6b10] focus:ring-[#dd6b10] rounded-md shadow-sm" required>{{ old('descripcion_noticia', $noticia->descripcion_noticia) }}</textarea>
                            <x-input-error :messages="$errors->get('descripcion_noticia')" class="mt-2" />
                        </div>
                    </div>
            
                    {{-- Columna derecha: selección de imagen --}}
                    <div class="w-full md:w-1/2 px-4">
                        <x-input-label :value="__('Selecciona una Imagen para la Noticia')" class="mb-4 block uppercase text-gray-500 font-bold" />
                        <x-input-error :messages="$errors->get('imagen_noticia')" class="mt-2" />
                        <div class="grid grid-cols-2 gap-4">
                            @foreach (range(1, 4) as $i)
                                <label class="cursor-pointer relative border-2 border-transparent hover:border-[#dd6b10]  rounded overflow-hidden p-1">
                                    <input type="radio" name="imagen_noticia" value="imagen{{ $i }}.jpg" class="hidden peer" @if($noticia->imagen_noticia === 'imagen'.$i.'.jpg') checked @endif>
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
                    <button type="submit" class="bg-[#dd6b10] hover:bg-[#e98f3a] text-white px-6 py-2 rounded ">Actualizar Publicación</button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
