<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>AGN - Mural digital</title>
  <meta name="description" content="Mural digital">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{asset('assets/img/favicon2.png') }}" rel="icon">
  <link href="{{asset('assets/img/favicon2.png') }}" rel="apple-touch-icon">

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


  <style>
 #zoomedImage {
  transition: transform 0.4s ease, transform-origin 0.3s ease;
  cursor: zoom-in;
  user-select: none;
  will-change: transform;
}
#zoomedImage.zoomed {
  cursor: grab;
}

#zoomedImage {
  max-width: 100%;
  height: auto;
}



</style>


      {{-- <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

       


        <!-- Estilos y scripts según entorno -->
@env('local')
    {{-- Entorno local: usa Vite en modo dev --}}
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
@else
    {{-- Entorno producción: carga archivos compilados manualmente --}}
     <link rel="stylesheet" href="{{ asset('build/assets/app-DsVy656E.css') }}">
        <script type="module" src="{{ asset('build/assets/app-Bf4POITK.js') }}"></script>
@endenv


    </head>

  <body class="index-page">


 
 
 <!-- Modal Normal -->
<div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 min-h-screen overflow-y-auto transition-opacity duration-300 hidden">
    <div id="modalBox"
        class="relative bg-white rounded-lg shadow-xl w-full max-w-[80%] mx-4 p-6 transform scale-95 opacity-0 transition-all duration-300 max-h-[90vh] overflow-y-auto">
        
        <!-- Botón de cerrar -->
        <button onclick="closeNoticiaModal()" class="absolute top-4 right-4 text-gray-600 hover:text-red-600 text-4xl font-bold">
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
        <button onclick="closeDestacadaModal()" class="absolute top-4 right-4 text-gray-600 hover:text-red-600 text-4xl font-bold">
            &times;
        </button>

        <!-- Contenido del modal -->
        <div id="modalContentdestacada" class="mt-6 grid md:grid-cols-1 gap-6 items-start">
            <!-- JS injecta aquí -->
        </div>
    </div>
</div>


   <!-- Modal para imagen ampliada -->
<div id="imageZoomModal" class="fixed inset-0 bg-black bg-opacity-80 z-50 overflow-auto transition-opacity duration-300 transform scale-95 opacity-0 hidden">
  <div class="flex items-center justify-center min-h-screen p-8">
    <img id="zoomedImage" src="" alt="Imagen ampliada" class="rounded shadow-lg max-w-[90vw] max-h-[90vh]">
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
            renderNoticiaModalContent(data);
        })
        .catch(error => {
            console.error('Error cargando la noticia:', error);
        });
}


  function renderNoticiaModalContent(data) {
    const modalContent = document.getElementById('modalContent');
    const modal = document.getElementById('modal');
    const modalBox = document.getElementById('modalBox');

    let imagenes = [];
    try {
        imagenes = JSON.parse(data.imagenes) || [];
    } catch {
        imagenes = [];
    }

    const imagenesHtml = imagenes.length > 0
        ? `
        <div class="relative w-full max-w-4xl mx-auto">
        <div id="carouselContainer" class="relative overflow-hidden">
            <div id="carouselImages" class="flex transition-transform duration-500 ease-in-out" style="transform: translateX(0);">
                ${imagenes.map(img => {
                    const imgSrcStorage = `/storage/imagenes_publicaciones/${img}`;
                    return `
                        <img src="${imgSrcStorage}" alt="Imagen noticia"
                            class="w-full max-w-none flex-shrink-0 object-contain rounded-lg  cursor-pointer "
                            style="height: 600px;"
                            onclick="openImageModal('${imgSrcStorage}')"
                        >
                    `;
                }).join('')}
            </div>
        </div>

        <!-- Botón Izquierda -->
        <button id="prevBtn" onclick="prevSlide()" class="absolute top-1/2 -left-20 -translate-y-1/2 bg-[#dd6b10] bg-opacity-100  text-white hover:scale-125  transition-transform duration-200 px-3 py-2 rounded-full shadow-lg">
            &#10094;
        </button>

        <!-- Botón Derecha -->
        <button id="nextBtn" onclick="nextSlide()" class="absolute top-1/2 -right-20 -translate-y-1/2 bg-[#dd6b10] bg-opacity-100  text-white hover:scale-125  transition-transform duration-200 px-3 py-2 rounded-full shadow-lg">
            &#10095;
        </button>
        </div>
        `
        : `<p class="italic text-gray-500 mb-6">No hay imágenes para esta noticia.</p>`;

    modalContent.innerHTML = `
        <div>
            <h2 class="text-2xl text-[#dd6b10] font-bold mb-4">${data.titulo}</h2>
        </div>
        
        <div>
            ${imagenesHtml}
        </div>
        
        <div>
            <p class="text-gray-700 leading-relaxed text-lg">${data.descripcion}</p>
        </div>
    `;

    currentSlide = 0;
    setTimeout(updateCarousel, 50); // Delay para esperar a que el DOM se actualice


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

//para el carousel de las imagenes de noticia

    let currentSlide = 0;

function updateCarousel() {
    const carousel = document.getElementById('carouselImages');
    const totalSlides = carousel.children.length;
    const slideWidth = carousel.children[0].clientWidth;

    // Limitar el rango
    if (currentSlide >= totalSlides) currentSlide = totalSlides - 1;
    if (currentSlide < 0) currentSlide = 0;

    // Mover el carrusel
    const translateX = -currentSlide * slideWidth;
    carousel.style.transform = `translateX(${translateX}px)`;

    // Controlar estado de los botones
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    if (currentSlide === 0) {
        prevBtn.classList.add('bg-gray-300', 'text-gray-500');
        prevBtn.classList.remove('bg-[#dd6b10]', 'text-white');
        prevBtn.disabled = true;
    } else {
        prevBtn.classList.remove('bg-gray-300', 'text-gray-500');
        prevBtn.classList.add('bg-[#dd6b10]', 'text-white');
        prevBtn.disabled = false;
    }

    if (currentSlide === totalSlides - 1) {
        nextBtn.classList.add('bg-gray-300', 'text-gray-500');
        nextBtn.classList.remove('bg-[#dd6b10]', 'text-white');
        nextBtn.disabled = true;
    } else {
        nextBtn.classList.remove('bg-gray-300', 'text-gray-500');
        nextBtn.classList.add('bg-[#dd6b10]', 'text-white');
        nextBtn.disabled = false;
    }
}


function nextSlide() {
    const carousel = document.getElementById('carouselImages');
    if (currentSlide < carousel.children.length - 1) {
        currentSlide++;
        updateCarousel();
    }
}

function prevSlide() {
    if (currentSlide > 0) {
        currentSlide--;
        updateCarousel();
    }
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

            currentSlide = 0;
            updateCarousel();

    }

    function renderDestacadaModalContent(data, rutaImagenPrincipal) {
    const modalContent = document.getElementById('modalContentdestacada');
    const modal = document.getElementById('modalDestacada');
    const modalBox = document.getElementById('modalBoxDestacada');

    let imagenesExtra = [];
    try {
        imagenesExtra = JSON.parse(data.imagenes) || [];
    } catch {
        imagenesExtra = [];
    }

    const imagenesHtml = imagenesExtra.length > 0
        ? `
         <div class="relative w-full max-w-4xl mx-auto">
        <div id="carouselDestacadaContainer" class="relative overflow-hidden">
            <div id="carouselDestacadaImages" class="flex transition-transform duration-500 ease-in-out" style="transform: translateX(0);">
                ${imagenesExtra.map(img => {
                    const imgSrc = `/storage/imagenes_publicaciones_destacadas/${img}`;
                    return `
                        <img src="${imgSrc}" alt="Imagen destacada extra"
                            class="w-full max-w-none flex-shrink-0 object-contain rounded-lg  cursor-pointer "
                            style="height: 600px;"
                            onclick="openImageModal('${imgSrc}')"
                        >
                    `;
                }).join('')}
            </div>
        </div>

        <!-- Botón Izquierda -->
        <button onclick="prevDestacadaSlide()" class="absolute top-1/2 -left-20 -translate-y-1/2 bg-[#dd6b10] bg-opacity-100  text-white hover:scale-125  transition-transform duration-200 px-3 py-2 rounded-full shadow-lg z-10">
            &#10094;
        </button>

        <!-- Botón Derecha -->
        <button onclick="nextDestacadaSlide()" class="absolute top-1/2 -right-20 -translate-y-1/2 bg-[#dd6b10] bg-opacity-100  text-white hover:scale-125  transition-transform duration-200 px-3 py-2 rounded-full shadow-lg z-10">
            &#10095;
        </button>
        </div>
        `
        : `<p class="italic text-gray-500 mb-6">No hay imágenes adicionales.</p>`;

    modalContent.innerHTML = `
        <div>
            <h2 class="text-3xl font-bold text-[#dd6b10] mb-4">${data.titulo}</h2>
        </div>

        

        ${imagenesHtml}

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

 


    function closeDestacadaModal() {
        const modal = document.getElementById('modalDestacada');
        const modalBox = document.getElementById('modalBoxDestacada');

        modalBox.classList.remove('scale-100', 'opacity-100');
        modalBox.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }


    //carousel de imagenes destacadas de noticia

    let currentDestacadaSlide = 0;

function updateDestacadaCarousel() {
    const carousel = document.getElementById('carouselDestacadaImages');
    if (!carousel || !carousel.children.length) return;

    const slideWidth = carousel.children[0].clientWidth;
    const totalSlides = carousel.children.length;

    if (currentDestacadaSlide >= totalSlides) currentDestacadaSlide = totalSlides - 1;
    if (currentDestacadaSlide < 0) currentDestacadaSlide = 0;

    const translateX = -currentDestacadaSlide * slideWidth;
    carousel.style.transform = `translateX(${translateX}px)`;
}

function nextDestacadaSlide() {
    const carousel = document.getElementById('carouselDestacadaImages');
    if (currentDestacadaSlide < carousel.children.length - 1) {
        currentDestacadaSlide++;
        updateDestacadaCarousel();
    }
}

function prevDestacadaSlide() {
    if (currentDestacadaSlide > 0) {
        currentDestacadaSlide--;
        updateDestacadaCarousel();
    }
}


const zoomModal = document.getElementById('imageZoomModal');
const zoomedImage = document.getElementById('zoomedImage');

let isZoomed = false;
let scale = 2.8; // escala de zoom
let translateX = 0;
let translateY = 0;
let originX = 0;
let originY = 0;

let isDragging = false;
let dragStartX = 0;
let dragStartY = 0;

function openImageModal(src) {
    zoomedImage.src = src;
    resetZoom();
    zoomModal.classList.remove('hidden');

    setTimeout(() => {
    zoomModal.classList.remove('scale-95', 'opacity-0');
    zoomModal.classList.add('scale-100', 'opacity-100');
}, 10);


    zoomModal.addEventListener('click', zoomModalClickHandler);
   

   
}

function closeImageModal() {
    zoomModal.classList.remove('scale-100', 'opacity-100');
    zoomModal.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        zoomModal.classList.add('hidden');
        zoomedImage.src = '';
        resetZoom();
    }, 300); // espera que termine la transición
}


function resetZoom() {
    isZoomed = false;
    translateX = 0;
    translateY = 0;
    originX = 0;
    originY = 0;
    updateTransform();
}

function zoomModalClickHandler(e) {
    if (e.target !== zoomedImage) {
        closeImageModal();
        return;
    }
    // Si está zoomed, hacer reset (deszoom)
    if (isZoomed) {
        resetZoom();
        return;
    }

    // Obtener posición del click relativo a la imagen
    const rect = zoomedImage.getBoundingClientRect();
    const clickX = e.clientX - rect.left;
    const clickY = e.clientY - rect.top;

    // Calcular origen de zoom en porcentaje
    originX = (clickX / rect.width) * 100;
    originY = (clickY / rect.height) * 100;

    // Ajustar transform-origin CSS para hacer zoom hacia ese punto
    zoomedImage.style.transformOrigin = `${originX}% ${originY}%`;

    // Aplicar zoom y guardar estado
    isZoomed = true;
    translateX = 0;
    translateY = 0;
    updateTransform();
}

function updateTransform() {
   zoomedImage.style.transform = isZoomed
    ? `scale(${scale})`
    : `scale(1)`;

zoomedImage.style.transformOrigin = isZoomed
    ? `${originX}% ${originY}%`
    : `50% 50%`;

    if (isZoomed) {
        zoomedImage.style.cursor = isDragging ? 'grabbing' : 'zoom-out';
    } else {
        zoomedImage.style.cursor = 'zoom-in';
    }
}


// Cerrar modal normal si se hace clic fuera del contenido
document.addEventListener('click', function (e) {
    const modal = document.getElementById('modal');
    const modalBox = document.getElementById('modalBox');

    if (!modal.classList.contains('hidden') && modal.contains(e.target) && !modalBox.contains(e.target)) {
        closeNoticiaModal();
    }
});

// Cerrar modal destacada si se hace clic fuera del contenido
document.addEventListener('click', function (e) {
    const modalDestacada = document.getElementById('modalDestacada');
    const modalBoxDestacada = document.getElementById('modalBoxDestacada');

    if (!modalDestacada.classList.contains('hidden') && modalDestacada.contains(e.target) && !modalBoxDestacada.contains(e.target)) {
        closeDestacadaModal();
    }
});



</script>





    </body>
</html>
