<div>
<div id="autoSlider" class="relative w-full h-screen overflow-hidden">
  <div class="flex h-full transition-transform duration-500 ease-in-out">
    @foreach($banners as $banner)
      <div class="min-w-full relative bg-cover bg-center flex items-center"
           style="background-image: url('{{ $banner->image_url }}'); height: 100vh;">
        
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/60"></div>
        
        <div class="ml-10 relative z-10 max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
          <div>
            <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight dark:text-white" style="max-width: 50%;">Kuasai Dunia Fashion Bersama <span class="text-blue-600">Srikandi March</span></h1>
              <div class="flex w-120 mt-2 mb-6 overflow-hidden rounded" style="max-width: 50%;">
                <div class="flex-1 h-2 bg-blue-200"></div>
                <div class="flex-1 h-2 bg-blue-400"></div>
                <div class="flex-1 h-2 bg-blue-600"></div>
              </div>

            <p class="text-lg text-white">Beli Sekarang dan dapatkan Promo Menarik lainnya.</p>
            <div class="mt-7 grid gap-3 w-full sm:inline-flex">
              <a wire:navigate class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/products">
                Beli Sekarang
                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m9 18 6-6-6-6" />
                </svg>
              </a>
              <a wire:navigate class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/contact-us">
                Hubungi Kami
              </a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <!-- Tombol Prev -->
  <button id="prevBtn" aria-label="Previous slide"
          class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/60 text-white rounded-full p-3 z-20 transition">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
    </svg>
  </button>

  <!-- Tombol Next -->
  <button id="nextBtn" aria-label="Next slide"
          class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/60 text-white rounded-full p-3 z-20 transition">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
  </button>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('autoSlider');
    const slidesContainer = slider.querySelector('.flex');
    const slides = slider.querySelectorAll('.min-w-full');
    
    // Clone slide pertama untuk infinite loop
    const firstSlide = slides[0].cloneNode(true);
    slidesContainer.appendChild(firstSlide);
    
    const totalSlides = slides.length + 1;
    let currentSlide = 0;
    const slideDuration = 6000; // 6 detik per slide
    
    function updateSlide() {
      slidesContainer.style.transition = 'transform 0.5s ease-in-out';
      slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
    }

    function goToNextSlide() {
      currentSlide++;
      updateSlide();
      
      if (currentSlide === totalSlides - 1) {
        setTimeout(() => {
          slidesContainer.style.transition = 'none';
          currentSlide = 0;
          slidesContainer.style.transform = 'translateX(0)';
        }, 500);
      }
    }

    function goToPrevSlide() {
      if (currentSlide === 0) {
        slidesContainer.style.transition = 'none';
        currentSlide = totalSlides - 1;
        slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
        // Delay kemudian ke slide asli sebelum clone
        setTimeout(() => {
          slidesContainer.style.transition = 'transform 0.5s ease-in-out';
          currentSlide--;
          updateSlide();
        }, 20);
      } else {
        currentSlide--;
        updateSlide();
      }
    }

    let slideInterval = setInterval(goToNextSlide, slideDuration);

    // Event tombol
    document.getElementById('nextBtn').addEventListener('click', () => {
      clearInterval(slideInterval);
      goToNextSlide();
      slideInterval = setInterval(goToNextSlide, slideDuration);
    });

    document.getElementById('prevBtn').addEventListener('click', () => {
      clearInterval(slideInterval);
      goToPrevSlide();
      slideInterval = setInterval(goToNextSlide, slideDuration);
    });
  });
  </script>

  <style>
    #autoSlider {
      overflow: hidden;
      height: 100vh;
    }
    #autoSlider .flex {
      display: flex;
      width: 100%;
      height: 100%;
    }
    #autoSlider .min-w-full {
      flex: 0 0 100%;
      position: relative;
    }
  </style>
</div>

<!-- brand section start -->
<section class="py-20 bg-white dark:bg-gray-900 overflow-hidden">
  <div class="max-w-xl mx-auto">
    <div class="text-center">
      <div class="relative flex flex-col items-center">
        <h1 class="text-5xl font-bold dark:text-gray-200">Brand<span class="text-blue-500"> Batik Terbaik</span></h1>
        <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
          <div class="flex-1 h-2 bg-blue-200"></div>
          <div class="flex-1 h-2 bg-blue-400"></div>
          <div class="flex-1 h-2 bg-blue-600"></div>
        </div>
      </div>
      <p class="mb-12 text-base text-center text-gray-500"></p>
    </div>
  </div>
  
  <div class="relative overflow-hidden py-4">
    <div class="animate-marquee whitespace-nowrap flex">
      <!-- Duplicate the brands for seamless looping -->
      @foreach ($brands as $brand)
      <div class="bg-white rounded-lg shadow-md dark:bg-gray-800 mx-4 inline-block w-64" wire-key="{{ $brand->id }}">
        <a href="/products?selected_brands[0]={{$brand->id}}" class="">
          <img src="{{url('storage', $brand->image) }}" 
          alt="{{$brand->name}}" 
          class="object-cover w-full h-64 rounded-t-lg">
        </a>
        <div class="p-5 text-center">
          <a href="" class="text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-300">
          {{$brand->name}}
          </a>
        </div>
      </div>
      @endforeach
      
      <!-- Duplicate the brands again for seamless looping -->
      @foreach ($brands as $brand)
      <div class="bg-white rounded-lg shadow-md dark:bg-gray-800 mx-4 inline-block w-64" wire-key="{{ $brand->id }}-duplicate">
        <a href="/products?selected_brands[0]={{$brand->id}}" class="">
          <img src="{{url('storage', $brand->image) }}" 
          alt="{{$brand->name}}" 
          class="object-cover w-full h-64 rounded-t-lg">
        </a>
        <div class="p-5 text-center">
          <a href="" class="text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-300">
          {{$brand->name}}
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<style>
  /* Hide scrollbar */
  .overflow-hidden {
    -ms-overflow-style: none;
    scrollbar-width: none;
  }
  .overflow-hidden::-webkit-scrollbar {
    display: none;
  }
  
  /* Animation */
  @keyframes marquee {
    0% {
      transform: translateX(0);
    }
    100% {
      transform: translateX(-50%);
    }
  }
  .animate-marquee {
    animation: marquee 80s linear infinite;
    display: inline-block;
  }
</style>
<!-- brand section end -->


<!-- category section start -->
<div class="bg-gray-500 py-20">
  <div class="max-w-xl mx-auto">
    <div class="text-center">
      <div class="relative flex flex-col items-center">
        <h1 class="text-5xl font-bold dark:text-gray-100">Batik <span class="text-blue-500">Kategori</span></h1>
        <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
          <div class="flex-1 h-2 bg-blue-200"></div>
          <div class="flex-1 h-2 bg-blue-400"></div>
          <div class="flex-1 h-2 bg-blue-600"></div>
        </div>
      </div>

      <p id="typewriter" class="mb-12 text-xl font-bold text-center text-gray-300">
      </p>

      <p class="mb-12 text-base text-center text-gray-500"></p>

    </div>
  </div>

  <div class="space-y-10 max-w-screen-lg mx-auto px-4 sm:px-0">
    @foreach ($categories as $category)
    <div 
      class="w-full sm:w-[95%] md:w-[92%] overflow-hidden rounded-xl border border-gray-200 shadow-lg transition duration-3000 hover:translate-x-4 
             @if($loop->even) ml-auto @else mr-auto @endif"
      data-aos="@if($loop->odd)fade-right @else fade-left @endif"
    >
      <div class="flex flex-col overflow-hidden bg-white sm:flex-row md:h-100">
        <!-- Gambar akan bergantian posisi berdasarkan index ganjil/genap -->
        <div class="h-48 w-full bg-gray-100 sm:h-auto sm:w-1/2 lg:w-2/5 @if($loop->odd) order-first @else order-last @endif">
          <img 
            class="w-full h-auto object-contain transition-transform duration-500 hover:scale-105" 
            src="{{url('storage', $category->image) }}" 
            alt="{{$category->name}}" 
            loading="lazy" 
          />
        </div>
        
        <!-- Konten deskripsi -->
        <div class="flex w-full flex-col p-6 sm:w-1/2 sm:p-8 lg:w-3/5">
          <h2 class="text-2xl font-bold text-gray-900 md:text-3xl lg:text-4xl transition-colors duration-300 hover:text-blue-600">
            {{$category->name}}
          </h2>
          <p class="mt-4 mb-8 text-gray-600">
            Temukan koleksi batik terbaik dari kategori {{ $category->name }}. Dari motif klasik hingga modern, ada banyak pilihan untuk setiap selera.
          </p>
          <a 
            href="/products?selected_categories[0]={{$category->id}}" 
            class="group mt-auto flex w-48 items-center justify-between rounded-lg bg-gradient-to-r from-blue-600 to-blue-900 px-6 py-3 text-white shadow-md transition-all duration-300 hover:from-blue-700 hover:to-blue-900 hover:shadow-lg"
          >
            <span class="font-medium">Lihat Koleksi</span>
            <svg class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<script>
const words = ["Jelajahi keindahan motif batik berdasarkan kategori.", "Temukan inspirasi untuk gaya Anda!"];
let i = 0;
let j = 0;
let currentWord = "";
let isDeleting = false;

function type() {
  currentWord = words[i];
  if (isDeleting) {
    document.getElementById("typewriter").textContent = currentWord.substring(0, j-1);
    j--;
    if (j == 0) {
      isDeleting = false;
      i++;
      if (i == words.length) {
        i = 0;
      }
    }
  } else {
    document.getElementById("typewriter").textContent = currentWord.substring(0, j+1);
    j++;
    if (j == currentWord.length) {
      isDeleting = true;
    }
  }
  setTimeout(type, 60);
}

type();
</script>

<style>
  /* Custom transitions */
  .transition-all {
    transition-property: all;
  }
  
  /* Hover effects */
  .hover\:scale-105:hover {
    transform: scale(1.05);
  }
  
  /* Smooth shadow transitions */
  .shadow-lg {
    transition: box-shadow 0.3s ease-in-out;
  }
</style>
<!-- category section end -->




<!-- produk terbaru section start -->
<section class="py-14 font-poppins dark:bg-gray-800">
  <div class="max-w-6xl px-4 py-6 mx-auto lg:py-4 md:px-6">
    <div class="max-w-xl mx-auto">
      <div class="text-center ">
        <div class="relative flex flex-col items-center">
          <h1 class="text-5xl font-bold dark:text-gray-200"> Produk <span class="text-blue-500"> Terbaru
            </span> </h1>
          <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
            <div class="flex-1 h-2 bg-blue-200"></div>
            <div class="flex-1 h-2 bg-blue-400"></div>
            <div class="flex-1 h-2 bg-blue-600"></div>
          </div>
        </div>

        <p class="mb-12 text-base text-center text-gray-500">
          Koleksi Produk Batik Terbaru dari Srikandi Merch
        </p>
      </div>
    </div>

    @if($newProducts->count() > 0)
    <!-- Container untuk scroll horizontal -->
    <div class="relative">
      <div class="flex overflow-x-auto pb-6 hide-scrollbar scroll-smooth" id="product-scroll-container">
        <div class="flex space-x-6 animate-auto-scroll">
          @foreach ($newProducts as $product)
          <div class="w-72 flex-shrink-0" wire:key="{{$product->id}}">
            <div class="relative w-full overflow-hidden rounded-lg bg-gray-200 shadow-md">
              <a wire:navigate href="/products/{{$product->slug}}">
                <img class="h-77 rounded-t-lg object-cover w-full transition-transform duration-1000 hover:scale-110" 
                     src="{{url('storage', $product->images[0]) }}" 
                     alt="{{$product->name}}" />
                <span class="absolute top-0 left-0 w-28 translate-y-4 -translate-x-6 -rotate-45 bg-blue-600 text-center text-sm text-white">Baru</span>
              </a>

              <div class="mt-4 px-5 pb-5">
                <a wire:navigate href="/products/{{$product->slug}}">
                  <h5 class="text-xl font-semibold tracking-tight text-slate-900 truncate">{{$product->name}}</h5>
                </a>
                <span class="text-gray-500 text-xs mt-1 block">
                    {{ $product->brand->name ?? 'N/A' }} 
                    @if($product->category) - {{ $product->category->name }} @endif
                </span>

                <div class="flex items-center justify-between mt-2.5 mb-2.5">
                  <p>
                    <span class="text-l font-bold text-slate-900">{{'Rp ' . number_format($product->price, 0, ',', '.')}}</span>
                    @if($product->on_sale)
                    <span class="text-sm text-slate-900 line-through ml-2">{{'Rp ' . number_format($product->price * 1.2, 0, ',', '.')}}</span>
                    @endif
                  </p>
                  
                  <button wire:click.prevent='addToCart({{ $product->id }})'
                      class="flex items-center rounded-md bg-slate-900 px-3 py-2 text-center text-sm font-medium text-white 
                           hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 transition-transform transform-gpu hover:-translate-y-1 hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span wire:loading.remove wire:target='addToCart({{ $product->id }})'>Tambah</span>
                    <span wire:loading wire:target='addToCart({{ $product->id }})'>Menambah..</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          
          <!-- Duplikat item untuk efek looping tak terbatas -->
          @foreach ($newProducts as $product)
          <div class="w-72 flex-shrink-0" wire:key="{{$product->id}}-duplicate">
            <div class="relative w-full overflow-hidden rounded-lg bg-gray-200 shadow-md">
              <a wire:navigate href="/products/{{$product->slug}}">
                <img class="h-77 rounded-t-lg object-cover w-full transition-transform duration-1000 hover:scale-110" 
                     src="{{url('storage', $product->images[0]) }}" 
                     alt="{{$product->name}}" />
                <span class="absolute top-0 left-0 w-28 translate-y-4 -translate-x-6 -rotate-45 bg-blue-600 text-center text-sm text-white">Baru</span>
              </a>

              <div class="mt-4 px-5 pb-5">
                <a wire:navigate href="/products/{{$product->slug}}">
                  <h5 class="text-xl font-semibold tracking-tight text-slate-900 truncate">{{$product->name}}</h5>
                </a>

                <span class="text-gray-500 text-xs mt-1 block">
                    {{ $product->brand->name ?? 'N/A' }} 
                    @if($product->category) - {{ $product->category->name }} @endif
                </span>

                <div class="flex items-center justify-between mt-2.5 mb-2.5">
                  <p>
                    <span class="text-l font-bold text-slate-900">{{'Rp ' . number_format($product->price, 0, ',', '.')}}</span>
                    @if($product->on_sale)
                    <span class="text-sm text-slate-900 line-through ml-2">{{'Rp ' . number_format($product->price * 1.2, 0, ',', '.')}}</span>
                    @endif
                  </p>
                  
                  <button wire:click.prevent='addToCart({{ $product->id }})'
                      class="flex items-center rounded-md bg-slate-900 px-3 py-2 text-center text-sm font-medium text-white 
                           hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 transition-transform transform-gpu hover:-translate-y-1 hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span wire:loading.remove wire:target='addToCart({{ $product->id }})'>Tambah</span>
                    <span wire:loading wire:target='addToCart({{ $product->id }})'>Menambah..</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    
    <!-- Tombol lihat semua produk -->
    <div class="text-center mt-8">
      <a wire:navigate href="/products" 
         class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        Lihat Semua Produk
        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
      </a>
    </div>
    @else
    <div class="text-center py-12">
      <div class="text-gray-500 text-lg">Belum ada produk baru yang tersedia</div>
    </div>
    @endif

  </div>
</section>

<style>
  /* Animasi auto scroll */
  .animate-auto-scroll {
    animation: scroll 50s linear infinite;
  }
  
  @keyframes scroll {
    0% {
      transform: translateX(0);
    }
    100% {
      transform: translateX(-50%);
    }
  }
  
  /* Sembunyikan scrollbar */
  .hide-scrollbar::-webkit-scrollbar {
    display: none;
  }
  .hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
  }
</style>

<script>
  // Pause animasi saat hover
  document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('product-scroll-container');
    const scrollContent = container.querySelector('.animate-auto-scroll');
    
    container.addEventListener('mouseenter', () => {
      scrollContent.style.animationPlayState = 'paused';
    });
    
    container.addEventListener('mouseleave', () => {
      scrollContent.style.animationPlayState = 'running';
    });
  });
</script>
<!-- produk terbaru section end -->

<!-- Go to Top Button -->
<button id="to-top-button" onclick="goToTop()" title="Go To Top"
    class="hidden fixed z-50 bottom-8 right-8 p-3 md:p-4 border-0 w-10 h-10 md:w-15 md:h-13 
           rounded-full shadow-lg 
           bg-gradient-to-br from-blue-500 to-purple-600 
           text-white text-lg font-semibold 
           transition-all duration-300 ease-in-out
           hover:scale-110 hover:shadow-xl hover:from-blue-600 hover:to-purple-700
           focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mx-auto">
        <path fill-rule="evenodd" d="M11.47 2.47a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 4.81l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
        <path fill-rule="evenodd" d="M12 4.5a.75.75 0 0 1 .75.75v15a.75.75 0 0 1-1.5 0v-15A.75.75 0 0 1 12 4.5Z" clip-rule="evenodd" />
    </svg>
    <span class="sr-only">Go to top</span>
</button>

<script>
    // Get the 'to top' button element by ID
    var toTopButton = document.getElementById("to-top-button");

    // Check if the button exists
    if (toTopButton) {
        // On scroll event, toggle button visibility based on scroll position
        window.onscroll = function() {
            if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
                toTopButton.classList.remove("hidden");
            } else {
                toTopButton.classList.add("hidden");
            }
        };

        // Function to scroll to the top of the page smoothly
        window.goToTop = function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };
    }
</script>

</div>

