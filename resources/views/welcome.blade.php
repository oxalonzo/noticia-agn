<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>AGN - Mural digital</title>
  <meta name="description" content="Mural digital">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{asset('assets/css/main.css') }}" rel="stylesheet">



      {{-- <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

       


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

  <body class="index-page">

 
 <!-- Modal Normal -->
<div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 min-h-screen overflow-y-auto transition-opacity duration-300 hidden">
    <div id="modalBox"
        class="relative bg-white rounded-lg shadow-xl w-full max-w-[80%] mx-4 p-6 transform scale-95 opacity-0 transition-all duration-300 max-h-[90vh] overflow-y-auto">
        
        <!-- Botón de cerrar -->
        <button onclick="closeNoticiaModal()" class="absolute top-4 right-4 text-gray-600 hover:text-red-600 text-2xl font-bold">
            &times;
        </button>

        <!-- Contenido del modal -->
        <div id="modalContent" class="mt-6 grid md:grid-cols-1 gap-6 items-start">
            <!-- JS injecta aquí -->
            <!-- Imagen a la izquierda -->
            <!-- Texto a la derecha -->
        </div>
    </div>
</div>

<!-- Modal Destacada -->
<div id="modalDestacada" class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 min-h-screen overflow-y-auto transition-opacity duration-300 hidden">
    <div id="modalBoxDestacada"
        class="relative bg-white rounded-lg shadow-xl w-full max-w-[80%] mx-4 p-6 transform scale-95 opacity-0 transition-all duration-300 max-h-[90vh] overflow-y-auto">
        
        <!-- Botón de cerrar -->
        <button onclick="closeDestacadaModal()" class="absolute top-4 right-4 text-gray-600 hover:text-red-600 text-2xl font-bold">
            &times;
        </button>

        <!-- Contenido del modal -->
        <div id="modalContentdestacada" class="mt-6 grid md:grid-cols-1 gap-6 items-start">
            <!-- JS injecta aquí -->
        </div>
    </div>
</div>



  <main class="main">

    <!-- noticias Section -->
    <section id="noticias" class="hero section ">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

       <div class="pt-3 pb-2 px-0 flex justify-between items-center relative">
    <!-- Icono central del mural con ajuste hacia la derecha -->
    <div class="absolute left-1/2 transform -translate-x-[46%]">
       <i class="bi bi-grid-1x2 text-[#dd6b10] text-3xl "></i>
    </div>

    <!-- Espaciador izquierdo para mantener estructura -->
    <div class="w-1/3"></div>

    <!-- Icono de usuario a la derecha -->
    <div class="w-1/3 flex justify-end">
        <a href="{{ route('login') }}" class="text-[#dd6b10] font-bold text-3xl">
            <i class="bi bi-person"></i>
        </a>
    </div>
</div>


         <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Mural Digital <span class="text-[#dd6b10]">AGN</span></h2>
      </div><!-- End Section Title -->

       


  <div class="container mx-auto px-4 py-8 space-y-10">
    @if($destacada)

   
        <div class="grid  grid-cols-2 gap-4">
            <!-- Noticia destacada -->
            <div class="">
                <a class="mt-4 text-[#dd6b10]" onclick="openDestacadaModal({{ $destacada->id }})">
                    <div class="relative group w-full h-96 rounded-lg overflow-hidden shadow-lg">
                        @php
                            $rutaImagen = Str::startsWith($destacada->imagen_noticia_destacada, 'http') 
                                ? $destacada->imagen_noticia_destacada
                                : (file_exists(public_path('storage/imagenes_subidas_noticias_destacada/' . $destacada->imagen_noticia_destacada)) 
                                    ? asset('storage/imagenes_subidas_noticias_destacada/' . $destacada->imagen_noticia_destacada) 
                                    : asset('imagenes_noticias/' . $destacada->imagen_noticia_destacada));
                        @endphp

                        <img src="{{ $rutaImagen }}" alt="Imagen destacada" class="absolute inset-0 group-hover:scale-105 transition-scale duration-300 w-full h-full object-cover z-0">
                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/35 bg-opacity-40 z-10"></div>
                        <div class="absolute inset-0 z-20 flex flex-col justify-end p-6 text-white">
                            <h2 class="text-2xl font-bold text-white tracking-wider">{{ $destacada->titulo_noticia_portada_destacada }}</h2>
                        </div>
                    </div>
                </a>
            </div>

             <div class="grid grid-cols-1 gap-4">
            
               <div class="flex flex-col items-center  rounded shadow-sm   justify-center w-full text-center">
                   <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square-quote-icon lucide-message-square-quote text-[#dd6b10] font-bold text-3xl"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M8 12a2 2 0 0 0 2-2V8H8"/><path d="M14 12a2 2 0 0 0 2-2V8h-2"/></svg>
                  <h2 class=" mb-5 text-[32px] font-bold ">Frase del <span class="titulo-agn">día</span></h2>
                  @if(!empty($frase))
                      <h3 class="text-[27px] frase-dia font"><span class="text-[#dd6b10]">" </span>{{ $frase->frase }}<span class="text-[#dd6b10]"> "</span></h3>
                @else
                      <h3 class="text-[27px] frase-dia font"><span class="text-[#dd6b10]">" </span> No hay frase del día aun <span class="text-[#dd6b10]"> "</span></h3>
                @endif
                 
               </div>
  
             </div>

        </div>

       

    @endif

    <!-- Noticias restantes -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($noticias as $noticia)
            <a class="mt-4 text-[#dd6b10] cursor-pointer" onclick="openNoticiaModal({{ $noticia->id }})">
                @php
                    $rutaImagen = Str::startsWith($noticia->imagen_noticia, 'http') 
                        ? $noticia->imagen_noticia
                        : (file_exists(public_path('storage/imagenes_subidas_noticias/' . $noticia->imagen_noticia)) 
                            ? asset('storage/imagenes_subidas_noticias/' . $noticia->imagen_noticia) 
                            : asset('imagenes_noticias/' . $noticia->imagen_noticia));
                @endphp
                <div class="bg-white rounded-lg shadow-md overflow-hidden  h-full flex flex-col  group">
                    <img src="{{ $rutaImagen }}" alt="Imagen de noticia" class="w-full h-48 object-cover group-hover:scale-105 transition-scale duration-300">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-[#dd6b10] tracking-wider">{{ $noticia->titulo_noticia_portada }}</h3>
                        
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>




        

      </div>

    </section><!-- /Hero Section -->

    

   

  </main>

  
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{asset('assets/js/main.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{asset('assets/js/main.js') }}"></script>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif


  <script>
    function openNoticiaModal(noticiaId) {
        fetch(`/noticia/${noticiaId}/show`)
            .then(response => response.json())
            .then(data => {
                let rutaImagen = '';

                if (data.imagen.startsWith('http')) {
                    rutaImagen = data.imagen;
                    renderNoticiaModalContent(data, rutaImagen);
                } else {
                    const storagePath = `/storage/imagenes_subidas_noticias/${data.imagen}`;
                    const fallbackPath = `/imagenes_noticias/${data.imagen}`;

                    fetch(storagePath, { method: 'HEAD' })
                        .then(res => {
                            rutaImagen = res.ok ? storagePath : fallbackPath;
                            renderNoticiaModalContent(data, rutaImagen);
                        })
                        .catch(() => {
                            rutaImagen = fallbackPath;
                            renderNoticiaModalContent(data, rutaImagen);
                        });
                }
            })
            .catch(error => {
                console.error('Error cargando la noticia:', error);
            });
    }

    function renderNoticiaModalContent(data, rutaImagen) {
        const modalContent = document.getElementById('modalContent');
        const modal = document.getElementById('modal');
        const modalBox = document.getElementById('modalBox');

        modalContent.innerHTML = `
            

            <div>
                 <h2 class="text-2xl text-[#dd6b10] font-bold  mb-4">${data.titulo}</h2>
            </div>
               
        
             <div>
                <img src="${rutaImagen}" alt="Imagen de la noticia" class="w-full h-auto object-contain rounded-lg">
            </div>
            
            <div>
                
                <p class="text-gray-700 leading-relaxed text-lg">${data.descripcion}</p>
            </div>
        `;

        modal.classList.remove('hidden');
        setTimeout(() => {
            modalBox.classList.remove('scale-95', 'opacity-0');
            modalBox.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeNoticiaModal() {
        const modal = document.getElementById('modal');
        const modalBox = document.getElementById('modalBox');

        modalBox.classList.remove('scale-100', 'opacity-100');
        modalBox.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function openDestacadaModal(destacadoId) {
        fetch(`/destacada/${destacadoId}/show`)
            .then(response => response.json())
            .then(data => {
                let rutaImagen = '';

                if (data.imagen.startsWith('http')) {
                    rutaImagen = data.imagen;
                    renderDestacadaModalContent(data, rutaImagen);
                } else {
                    const storagePath = `/storage/imagenes_subidas_noticias_destacada/${data.imagen}`;
                    const fallbackPath = `/imagenes_noticias/${data.imagen}`;

                    fetch(storagePath, { method: 'HEAD' })
                        .then(res => {
                            rutaImagen = res.ok ? storagePath : fallbackPath;
                            renderDestacadaModalContent(data, rutaImagen);
                        })
                        .catch(() => {
                            rutaImagen = fallbackPath;
                            renderDestacadaModalContent(data, rutaImagen);
                        });
                }
            })
            .catch(error => {
                console.error('Error cargando la destacada:', error);
            });
    }

    function renderDestacadaModalContent(data, rutaImagen) {
        const modalContent = document.getElementById('modalContentdestacada');
        const modal = document.getElementById('modalDestacada');
        const modalBox = document.getElementById('modalBoxDestacada');

        modalContent.innerHTML = `


        <div>
                  <h2 class="text-3xl font-bold text-[#dd6b10] mb-4">${data.titulo}</h2>
        </div>

         <div>
            <img src="${rutaImagen}" alt="Imagen destacada" class="w-full h-auto object-contain rounded-lg">
        </div>
        
         <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-4">${data.titulo}</h2>
            <p class="text-gray-700 leading-relaxed text-lg">${data.descripcion}</p>
        </div>
        `;

        modal.classList.remove('hidden');
        setTimeout(() => {
            modalBox.classList.remove('scale-95', 'opacity-0');
            modalBox.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeDestacadaModal() {
        const modal = document.getElementById('modalDestacada');
        const modalBox = document.getElementById('modalBoxDestacada');

        modalBox.classList.remove('scale-100', 'opacity-100');
        modalBox.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>





    </body>
</html>
