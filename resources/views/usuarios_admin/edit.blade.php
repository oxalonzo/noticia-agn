@section('titulo')
    noticias
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Noticias') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center h-full">

        <div class="md:w-3/4 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0 h-full ">

            <div class="flex justify-end items-center mb-4">
                <!-- Botón para ver os usuarios -->
                <x-link :href="route('usuarios.index')"
                    class="border border-[#dd6b10] p-3 text-xs text-white dark:text-white hover:text-white font-bold dark:hover:text-white rounded-md focus:outline-none bg-[#dd6b10] hover:bg-[#e98f3a]">
                    Ver todos los usuarios
                </x-link>
            </div>

            <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
                @csrf
                @method('PUT')
        
                {{-- Nombre --}}
                <div class="mb-4">
                    <label for="name" class="block font-semibold text-gray-700">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $usuario->name) }}"
                           class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring focus:ring-transparent border-2 focus:border-[#dd6b10]">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
        
                {{-- usuario --}}
                <div class="mb-4">
                    <label for="email" class="block font-semibold text-gray-700">Usuario</label>
                    <input type="text" name="email" id="email" value="{{ old('email', $usuario->email) }}"
                           class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring focus:ring-transparent border-2 focus:border-[#dd6b10]">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
        
                {{-- Rol --}}
                <div class="mb-4">
                    <label for="rol" class="block font-semibold text-gray-700">Rol</label>
                    <select name="rol" id="rol"
                            class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring focus:ring-transparent border-2 focus:border-[#dd6b10]">
                        <option value="1" {{ $usuario->rol == 1 ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ $usuario->rol == 2 ? 'selected' : '' }}>Publicador</option>
                    </select>
                    @error('rol')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
        
                {{-- Password (opcional) --}}
                <div class="mb-4">
                    <label for="password" class="block font-semibold text-gray-700">Contraseña (dejar en blanco si no quieres cambiarla)</label>
                    <input type="password" name="password" id="password"
                           class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring focus:ring-transparent border-2 focus:border-[#dd6b10]">
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
        
                {{-- Confirmar Password --}}
                <div class="mb-4">
                    <label for="password_confirmation" class="block font-semibold text-gray-700">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring focus:ring-transparent border-2 focus:border-[#dd6b10]">
                </div>
        
                {{-- Botón --}}
                <div class="mt-6">
                    <button type="submit"
                            class="bg-green-500 hover:bg-green-400 text-white font-semibold px-4 py-2 rounded">
                        Actualizar Usuario
                    </button>
                </div>
            </form>

        </div>

    </div>
</x-app-layout>