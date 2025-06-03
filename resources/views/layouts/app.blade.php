<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('titulo') - AGN Noticia</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

               <!-- Estilos y scripts según entorno -->
@env('local')
    {{-- Entorno local: usa Vite en modo dev --}}
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
@else
    {{-- Entorno producción: carga archivos compilados manualmente --}}
     <link rel="stylesheet" href="{{ asset('build/assets/app-D5qsYbyp.css') }}">
        <script type="module" src="{{ asset('build/assets/app-Bf4POITK.js') }}"></script>
@endenv


    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
