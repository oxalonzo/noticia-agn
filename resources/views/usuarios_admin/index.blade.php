@section('titulo')
    Usuarios
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center h-full">

        <div class="md:w-3/4 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0 h-full ">

           

            @if (session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
                    class="rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3 shadow-md mb-3"
                    role="alert">
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
            @endif


            <div class="container mx-auto">
                <h2 class="text-2xl font-semibold mb-4">Lista de usuarios</h2>

                <!-- Tabla de usuarios -->
                <table class="min-w-full bg-white border border-gray-300 rounded-md">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left">Nombre</th>
                            <th class="px-4 py-2 text-left">Usuario</th>
                            <th class="px-4 py-2 text-left">rol</th>
                            <th class="px-4 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td class="px-4 py-2">{{ $usuario->name }}</td>
                                <td class="px-4 py-2">{{ $usuario->email}}</td>
                                <td class="px-4 py-2">{{ $usuario->rol }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex justify-center items-center space-x-3">
                                        <!-- Botón Editar -->
                                        <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                           class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold py-1.5 px-4 rounded shadow transition duration-200">
                                            Editar
                                        </a>

                                        <!-- Botón Eliminar -->
                                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta noticia?');">
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
                <div class="mt-4">
                    {{ $usuarios->links() }} <!-- Esto genera los enlaces de paginación -->
                </div>

            </div>

        </div>

    </div>
</x-app-layout>