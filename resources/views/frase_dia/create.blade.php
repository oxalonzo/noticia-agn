@section('titulo')
    Crear una frase
@endsection



<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear una nueva frase') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center h-full">
      
        <div class="md:w-3/4 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0 ">

            <div class="flex justify-end items-center mb-4">
                <x-link :href="route('frases.index')"
                    class=" border border-[#dd6b10] p-3 text-xs text-white dark:text-white hover:text-white font-bold dark:hover:text-white rounded-md focus:outline-none bg-[#dd6b10] hover:bg-[#e98f3a]">
                    Ver todas las frases
                </x-link>
            </div>

            
            <form action="{{ route('frases.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
            
                <div class="flex flex-wrap">
                    {{-- Columna izquierda: campos de texto --}}
                    <div class="w-full px-4">
                      
            
                        {{-- Titulo Noticia --}}
                        <div class="mb-5">
                            <x-input-label for="frase" :value="__('Frase del día')" class="mb-2 block uppercase text-gray-500 font-bold" />
                            <x-text-input id="frase" class="p-3 w-full mb-4" type="text" name="frase" required />
                            <x-input-error :messages="$errors->get('frase')" class="mt-2" />
                        </div>
            
                       
                    </div>
            
                   
                </div>
            
                {{-- Botón para enviar --}}
                <div class="mt-6 ">
                    <button type="submit" class=" bg-green-500 w-full text-white px-6 py-2 rounded hover:bg-green-400">Guardar</button>
                </div>
            </form>


        </div>

    </div>
</x-app-layout>



