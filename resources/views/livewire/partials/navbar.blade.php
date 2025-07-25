<header class="flex z-[999] sticky top-0 flex-wrap md:justify-start md:flex-nowrap w-full bg-white text-sm py-5 shadow-md">
  <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global" x-data="{ activeTab: '{{ request()->path() }}' }">
    <div class="relative md:flex md:items-center md:justify-between">
      <div class="flex items-center justify-between">
        <a class="flex items-center" href="/" aria-label="Brand">
          <img src="../img/logo.jpg" alt="Logo Srikandi Merch" class="object-cover w-18 h-18 rounded-full">
          <span class="text-xl font-bold text-black ml-4">Srikandi Merch</span>
        </a>
        <div class="md:hidden">
          <button type="button" class="hs-collapse-toggle flex justify-center items-center w-9 h-9 text-sm font-semibold rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
            <svg class="hs-collapse-open:hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="3" x2="21" y1="6" y2="6" />
              <line x1="3" x2="21" y1="12" y2="12" />
              <line x1="3" x2="21" y1="18" y2="18" />
            </svg>
            <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 6 6 18" />
              <path d="m6 6 12 12" />
            </svg>
          </button>
        </div>
      </div>

      <div id="navbar-collapse-with-animation" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block">
        <div class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500">
          <div class="flex flex-col gap-x-0 mt-5 divide-y divide-dashed divide-gray-200 md:flex-row md:items-center md:justify-end md:gap-x-1 md:mt-0 md:ps-7 md:divide-y-0 md:divide-solid dark:divide-gray-700">

            <!-- Beranda -->
            <a
              wire:navigate
              href="/"
              @mouseenter="hoverTab = 'home'"
              @mouseleave="hoverTab = null"
              :class="(hoverTab === 'home' && '{{ request()->is('/') ? 'false' : 'true' }}' === 'true')
                  ? 'text-gray-800 after:block after:h-[2px] after:bg-gray-400 after:w-full after:absolute after:bottom-0 after:left-0'
                  : '{{ request()->is('/') ? 'true' : 'false' }}' === 'true'
                      ? 'text-blue-600 after:block after:h-[2px] after:bg-blue-600 after:w-full after:absolute after:bottom-0 after:left-0'
                      : 'text-black hover:text-gray-500 hover:after:block hover:after:h-[2px] hover:after:bg-gray-400 hover:after:w-full hover:after:absolute hover:after:bottom-0 hover:after:left-0'"
              class="relative flex items-center gap-1 px-4 py-3 font-medium text-base">
              <span>Beranda</span>
            </a>
            <!-- Kategori -->
            <a
              wire:navigate
              href="/categories"
              @mouseenter="hoverTab = 'categories'"
              @mouseleave="hoverTab = null"
              :class="(hoverTab === 'categories' && '{{ request()->is('categories*') ? 'false' : 'true' }}' === 'true')
                  ? 'text-gray-800 after:block after:h-[2px] after:bg-gray-400 after:w-full after:absolute after:bottom-0 after:left-0'
                  : '{{ request()->is('categories') ? 'true' : 'false' }}' === 'true'
                      ? 'text-blue-600 after:block after:h-[2px] after:bg-blue-600 after:w-full after:absolute after:bottom-0 after:left-0'
                      : 'text-black hover:text-gray-500 hover:after:block hover:after:h-[2px] hover:after:bg-gray-400 hover:after:w-full hover:after:absolute hover:after:bottom-0 hover:after:left-0'"
              class="relative flex items-center gap-1 px-4 py-3 font-medium text-base">
              <span>Kategori</span>
            </a>
            <!-- Produk -->
            <a
              wire:navigate
              href="/products"
              @mouseenter="hoverTab = 'products'"
              @mouseleave="hoverTab = null"
              :class="(hoverTab === 'products' && '{{ request()->is('products*') ? 'false' : 'true' }}' === 'true')
                  ? 'text-gray-800 after:block after:h-[2px] after:bg-gray-400 after:w-full after:absolute after:bottom-0 after:left-0'
                  : '{{ request()->is('products') ? 'true' : 'false' }}' === 'true'
                      ? 'text-blue-600 after:block after:h-[2px] after:bg-blue-600 after:w-full after:absolute after:bottom-0 after:left-0'
                      : 'text-black hover:text-gray-500 hover:after:block hover:after:h-[2px] hover:after:bg-gray-400 hover:after:w-full hover:after:absolute hover:after:bottom-0 hover:after:left-0'"
              class="relative flex items-center gap-1 px-4 py-3 font-medium text-base">
              <span>Produk</span>
            </a>
            <!-- Kontak -->
            <a
              wire:navigate
              href="/contact-us"
              @mouseenter="hoverTab = 'kontak'"
              @mouseleave="hoverTab = null"
              :class="(hoverTab === 'kontak' && '{{ request()->is('contact-us*') ? 'false' : 'true' }}' === 'true')
                  ? 'text-gray-800 after:block after:h-[2px] after:bg-gray-400 after:w-full after:absolute after:bottom-0 after:left-0'
                  : '{{ request()->is('contact-us') ? 'true' : 'false' }}' === 'true'
                      ? 'text-blue-600 after:block after:h-[2px] after:bg-blue-600 after:w-full after:absolute after:bottom-0 after:left-0'
                      : 'text-black hover:text-gray-500 hover:after:block hover:after:h-[2px] hover:after:bg-gray-400 hover:after:w-full hover:after:absolute hover:after:bottom-0 hover:after:left-0'"
              class="relative flex items-center gap-1 px-4 py-3 font-medium text-base">
              <span>Kontak</span>
            </a>

            <!-- Tentang Kami -->
            <a
              wire:navigate
              href="/about-us"
              @mouseenter="hoverTab = 'tentang'"
              @mouseleave="hoverTab = null"
              :class="(hoverTab === 'tentang' && '{{ request()->is('about-us*') ? 'false' : 'true' }}' === 'true')
                  ? 'text-gray-800 after:block after:h-[2px] after:bg-gray-400 after:w-full after:absolute after:bottom-0 after:left-0'
                  : '{{ request()->is('about-us') ? 'true' : 'false' }}' === 'true'
                      ? 'text-blue-600 after:block after:h-[2px] after:bg-blue-600 after:w-full after:absolute after:bottom-0 after:left-0'
                      : 'text-black hover:text-gray-500 hover:after:block hover:after:h-[2px] hover:after:bg-gray-400 hover:after:w-full hover:after:absolute hover:after:bottom-0 hover:after:left-0'"
              class="relative flex items-center gap-1 px-4 py-3 font-medium text-base">
              <span>Tentang Kami</span>
            </a>

            <!-- Keranjang -->
            <a
              wire:navigate
              href="/cart"
              @mouseenter="hoverTab = 'cart'"
              @mouseleave="hoverTab = null"
              :class="(hoverTab === 'cart' && '{{ request()->is('cart*') ? 'false' : 'true' }}' === 'true')
                  ? 'text-gray-800 after:block after:h-[2px] after:bg-gray-400 after:w-full after:absolute after:bottom-0 after:left-0'
                  : '{{ request()->is('cart') ? 'true' : 'false' }}' === 'true' 
                      ? 'text-blue-600 after:block after:h-[2px] after:bg-blue-600 after:w-full after:absolute after:bottom-0 after:left-0'
                      : 'text-black hover:text-gray-500 hover:after:block hover:after:h-[2px] hover:after:bg-gray-400 hover:after:w-full hover:after:absolute hover:after:bottom-0 hover:after:left-0'"
              class="relative flex items-center gap-1 px-4 py-3 font-medium text-base">

              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
              </svg>
              <span>Keranjang</span>
              <span class="py-0.5 px-1.5 rounded-full text-xs font-medium bg-blue-50 border border-blue-200 text-blue-600">{{ $total_count }}</span>
            </a>


            @guest
            <div class="pt-3 md:pt-0">
              <a wire:navigate class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/login">
                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                  <circle cx="12" cy="7" r="4" />
                </svg>
                Log in
              </a>
            </div>
            @endguest

            @auth
            <div class="hs-dropdown relative md:[--strategy:fixed] md:[--trigger:hover] md:py-4">
              <button type="button" class="flex items-center w-full text-gray-500 hover:text-blue-400 font-medium text-base rounded-lg transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:text-grey dark:hover:text-blue-400" aria-controls="hs-basic-dropdown" aria-haspopup="true" data-hs-dropdown="#hs-basic-dropdown">
                @if(Auth::user()->profile_photo_path)
                <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" class="h-10 w-10 rounded-full object-cover object-top object-center mr-2">
                @else
                <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center text-gray-500 mr-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                </div>
                @endif
                {{ Auth::user()->name }}
                <svg class="ms-2 w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m6 9 6 6 6-6" />
                </svg>
              </button>

              <div class="hs-dropdown-menu transition-[opacity, margin] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 bg-white md:shadow-md rounded-lg p-2 md:dark:border dark:border-gray-400 dark:divide-gray-700 before:absolute top-full md:border before:-top-5 before:start-0 before:w-full before:h-5">
                <a href="/my-orders" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-black hover:bg-blue-100 dark:hover:text-blue-500 font-medium">Pesanan Saya</a>
                <a href="/history" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-black hover:bg-blue-100 dark:hover:text-blue-500 font-medium">Riwayat Pesanan</a>
                <a href="/profile" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-black hover:bg-blue-100 dark:hover:text-blue-500 font-medium">Akun Saya</a>
                <a href="/logout" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-black hover:bg-blue-100 dark:hover:text-blue-500 font-medium">Logout</a>
              </div>
            </div>
            @endauth

          </div>
        </div>
      </div>
    </div>
  </nav>
</header>