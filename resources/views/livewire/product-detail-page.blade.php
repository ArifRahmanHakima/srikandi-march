<div class="w-full max-w-[85rem] py-8 px-4 sm:px-6 lg:px-8 mx-auto">

<div x-data="{ showNotification: false, message: '' }" 
         x-show="showNotification"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-2"
         @notify.window="showNotification = true; message = $event.detail.message; setTimeout(() => showNotification = false, 3000)"
         class="fixed bottom-4 right-4 z-50">
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span x-text="message"></span>
        </div>
    </div>
  <!-- Product Detail Section -->
   <div class="mb-8">
        <h1 class="text-3xl font-semibold text-gray-700">Detail Produk</h1>
    </div>
  <section class="bg-white py-10 rounded-lg">
    <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
      
      <div class="flex flex-wrap -mx-4">
        <!-- Product Images Section -->
        <div class="w-full mb-8 md:w-1/2 md:mb-0" 
          x-data="{
              mainImage: '{{url('storage', $product->images[0]) }}',
              currentIndex: 0,
              images: [@foreach($product->images as $image)'{{url('storage', $image) }}',@endforeach],
              zoomed: false,
              zoomPosition: { x: 0, y: 0 },
              showZoom: false
          }">
          <div class="sticky top-0 z-50 overflow-hidden">
              <div class="relative mb-6 lg:mb-10 bg-gray-100 rounded-lg overflow-hidden group 
                          h-[400px] sm:h-[500px] md:h-[600px] lg:h-[700px] xl:h-[800px]" 
                  @mousemove="if(zoomed) {
                      const rect = $event.currentTarget.getBoundingClientRect();
                      const x = ($event.clientX - rect.left) / rect.width * 100;
                      const y = ($event.clientY - rect.top) / rect.height * 100;
                      zoomPosition = { x, y };
                  }"
                  @mouseenter="showZoom = true"
                  @mouseleave="showZoom = false; zoomed = false">

                  <img x-bind:src="mainImage" 
                      alt="{{$product->name}}" 
                      class="object-cover w-full h-full transition-transform duration-300" 
                      :class="{'scale-[2.5]': zoomed}" 
                      :style="zoomed ? 'transform-origin: ' + zoomPosition.x + '% ' + zoomPosition.y + '%;' : ''">
                  
                  <template x-if="images.length > 1">
                      <div class="absolute inset-0 flex items-center justify-between px-4 sm:px-8 opacity-0 group-hover:opacity-100 transition-opacity">
                          <button @click="currentIndex = (currentIndex - 1 + images.length) % images.length; mainImage = images[currentIndex];"
                                  class="w-10 h-10 bg-white/80 rounded-full flex items-center justify-center shadow-md hover:bg-white transition-colors">
                              <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                              </svg>
                          </button>
                          <button @click="currentIndex = (currentIndex + 1) % images.length; mainImage = images[currentIndex];"
                                  class="w-10 h-10 bg-white/80 rounded-full flex items-center justify-center shadow-md hover:bg-white transition-colors">
                              <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                              </svg>
                          </button>
                      </div>
                  </template>
                  
                  <button @click="zoomed = !zoomed" 
                          class="absolute bottom-4 right-4 bg-white/80 rounded-full px-4 py-2 shadow-md hover:bg-white transition-colors text-sm"
                          x-text="zoomed ? 'Zoom Out' : 'Zoom In'"></button>
              </div>

              <div class="flex flex-wrap gap-2">
                  @foreach ($product->images as $index => $image)
                      <div class="w-24 h-24 sm:w-28 sm:h-28 lg:w-32 lg:h-32 border-2 border-gray-200 rounded-lg overflow-hidden cursor-pointer hover:border-blue-500 transition-colors" 
                          x-on:click="mainImage='{{url('storage', $image) }}'; currentIndex = {{$index}}"
                          :class="{'border-blue-500': mainImage === '{{url('storage', $image) }}'}">
                          <img src="{{url('storage', $image) }}" alt="{{$product->name}}" class="object-cover w-full h-full">
                      </div>
                  @endforeach
              </div>
          </div>
        </div>

        <!-- Product Info Section -->
        <div class="w-full px-4 md:w-1/2">
          <div class="lg:pl-8">
            <!-- Product Title & Price -->
            <div class="mb-8">
              <h1 class="max-w-xl mb-4 text-2xl font-bold text-gray-900 md:text-3xl lg:text-4xl">
                {{$product->name}}
              </h1>
              <div class="mb-4">
                <span class="text-3xl font-bold text-blue-600 lg:text-4xl">
                  {{'Rp ' . number_format($product->price, 0, ',', '.')}}
                </span>
              </div>
              <div class="prose prose-sm max-w-none text-gray-600 mb-6 flex items-center space-x-2">

                {{-- Tampilkan Angka Rating --}}
                <span class="text-gray-900 font-medium">{{ number_format($product->average_rating, 1) }}</span>

                {{-- Tampilkan Bintang --}}
                <div class="flex items-center">
                  @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= floor($product->average_rating))
                      {{-- Bintang Penuh --}}
                      <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                          <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                      </svg>
                    @elseif ($i - $product->average_rating < 1)
                      {{-- Bintang Setengah --}}
                      <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                          <defs>
                              <linearGradient id="half">
                                  <stop offset="50%" stop-color="currentColor"/>
                                  <stop offset="50%" stop-color="transparent"/>
                              </linearGradient>
                          </defs>
                          <path fill="url(#half)" d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                      </svg>
                    @else
                      {{-- Bintang Kosong --}}
                      <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
                          <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                      </svg>
                    @endif
                  @endfor
                </div>
              </div>

              <div class="prose prose-sm max-w-none text-gray-600 mb-6">
                <span class="font-semibold text-gray-900">SKU : </span>
                {{$product->sku ?? 'N/A'}} 
              </div>

              <div class="prose prose-sm max-w-none text-gray-600 mb-6">
                <span class="font-semibold text-gray-900">Kategori : </span>
                <span class="text-gray-700">{{ $product->category->name ?? 'Tidak ada kategori' }}</span>
              </div>

              <div class="prose prose-sm max-w-none text-gray-600 mb-6">
                <span class="font-semibold text-gray-900">Brand : </span>
                <span class="text-gray-700">{{ $product->brand->name ?? 'Tidak ada brand' }}</span>
              </div>
            </div>
            
            <!-- Product Options -->
            <div class="mb-8 space-y-6">
              <!-- Color Selection -->
              <div>
                <label class="block text-sm font-semibold text-gray-900 mb-3">Warna</label>
                <div class="flex flex-wrap gap-3">
                    @php
                        // Gunakan fallback jika casting model belum bekerja sempurna
                        $colors = is_string($product->color) ? explode(',', $product->color) : ($product->color ?? []);
                        $colors = array_filter(array_map('trim', $colors));
                    @endphp

                    @forelse($colors as $colorOption)
                        <button
                            type="button" {{-- Pastikan type="button" agar tidak submit form --}}
                            wire:click="selectColor('{{ $colorOption }}')" {{-- Ini yang membuat tombol bisa diklik dan memanggil Livewire --}}
                            class="px-4 py-2 text-sm border border-gray-300 rounded-md
                                  hover:border-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500
                                  transition-all duration-200 transform-gpu hover:-translate-y-1 hover:shadow-lg
                                  {{ $selectedColor === $colorOption ? 'bg-blue-500 text-white border-blue-500' : '' }}"> {{-- Kelas aktif --}}
                            {{ $colorOption }}
                        </button>
                    @empty
                        <span class="text-gray-500 text-sm">Tidak ada pilihan warna tersedia.</span>
                    @endforelse
                  </div>
              </div>

              <!-- Size Selection -->
              <div>
                <label class="block text-sm font-semibold text-gray-900 mb-3">Ukuran</label>
                <div class="flex flex-wrap gap-3">
                      @php
                          // Gunakan fallback jika casting model belum bekerja sempurna
                          $sizes = is_string($product->size) ? explode(',', $product->size) : ($product->size ?? []);
                          $sizes = array_filter(array_map('trim', $sizes));
                      @endphp

                      @forelse($sizes as $sizeOption)
                          <button
                              type="button" {{-- Pastikan type="button" --}}
                              wire:click="selectSize('{{ $sizeOption }}')" {{-- Ini yang membuat tombol bisa diklik dan memanggil Livewire --}}
                              class="px-4 py-2 text-sm border border-gray-300 rounded-md
                                    hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500
                                    transition-all duration-200 transform-gpu hover:-translate-y-1 hover:shadow-lg
                                    {{ $selectedSize === $sizeOption ? 'bg-blue-500 text-white border-blue-500' : '' }}"> {{-- Kelas aktif --}}
                              {{ $sizeOption }}
                          </button>
                      @empty
                          <span class="text-gray-500 text-sm">Tidak ada pilihan ukuran tersedia.</span>
                      @endforelse
                  </div>
              </div>

              <!-- Quantity -->
              <div class="w-40">
                <label class="block text-sm font-semibold text-gray-900 mb-3">Jumlah</label>
                <div class="relative flex flex-row w-full h-12 bg-transparent rounded-lg border border-gray-300">
                  <button wire:click="decreaseQty" class="w-12 h-full text-gray-600 bg-gray-100 rounded-l-lg outline-none cursor-pointer hover:bg-gray-200 hover:text-gray-700 transition-colors">
                    <span class="m-auto text-xl font-thin">−</span>
                  </button>
                  <input type="number" wire:model="quantity" readonly class="flex items-center w-full font-semibold text-center text-gray-700 bg-white outline-none focus:outline-none text-md border-l border-r border-gray-300" value="1">
                  <button wire:click="increaseQty" class="w-12 h-full text-gray-600 bg-gray-100 rounded-r-lg outline-none cursor-pointer hover:bg-gray-200 hover:text-gray-700 transition-colors">
                    <span class="m-auto text-xl font-thin">+</span>
                  </button>
                </div>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mb-8">
              <button wire:click="addToCart({{$product->id}})" 
                  @click="$dispatch('notify', {message: 'Pesanan sudah berhasil ditambahkan ke keranjang'})"
                  class="flex items-center justify-center px-8 py-4 bg-gradient-to-r bg-blue-500 hover:bg-gray-400 text-white font-bold rounded-lg transition-transform transform-gpu hover:-translate-y-1 hover:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span wire:loading.remove wire:target='addToCart({{$product->id}})'>Tambahkan ke Keranjang</span>
                <span wire:loading wire:target='addToCart({{$product->id}})'>Proses...</span>
              </button>
            </div>
            

            <div class="flex items-center mb-6"> 
              <div class="prose prose-sm max-w-none text-gray-600 mr-4"> 
                  <span class="font-semibold text-gray-900">Follow Kami : </span> 
              </div>
    
              <a class="inline-flex items-center gap-x-2 text-black to-purple-800 hover:text-blue-500 transition duration-300 ease-in-out" 
                href="https://www.instagram.com/srikandimerch_official" target="_blank">
                  <svg class="w-6 h-6 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0,0,256,256">
                      <g fill="currentColor"> <g transform="scale(4,4)">
                        <path d="M21.58008,7c-8.039,0-14.58008,6.54494-14.58008,14.58594v20.83203c0,8.04,6.54494,14.58203,14.58594,14.58203h20.83203c8.04,0,14.58203-6.54494,14.58203-14.58594v-20.83398c0-8.039-6.54494-14.58008-14.58594-14.58008zM47,15c1.104,0,2,0.896,2,2c0,1.104-0.896,2-2,2c-1.104,0-2-0.896-2-2c0-1.104,0.896-2,2-2zM32,19c7.17,0,13,5.83,13,13c0,7.17-5.831,13-13,13c-7.17,0-13-5.831-13-13c0-7.169,5.83-13,13-13zM32,23c-4.971,0-9,4.029-9,9c0,4.971,4.029,9,9,9c4.971,0,9-4.029,9-9c0-4.971-4.029-9-9-9z" />
                        </g>
                      </g>
                  </svg>
                  <span>Instagram</span>
              </a>
            </div>
            

            <!-- Product Features -->
            <div class="border-t border-gray-200 pt-6">
              <div class="grid grid-cols-2 gap-4 text-sm">
                <div class="flex items-center">
                  <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  <span class="text-gray-600">Bahan Premium</span>
                </div>
                <div class="flex items-center">
                  <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  <span class="text-gray-600">Garansi Kualitas</span>
                </div>
                <div class="flex items-center">
                  <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  <span class="text-gray-600">Pengiriman Cepat</span>
                </div>
                <div class="flex items-center">
                  <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  <span class="text-gray-600">Batik Original</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Product Details Tabs -->
  <section class="bg-white py-8 border-t border-gray-200" x-data="{ activeTab: 'description' } rounded-lg py-18">
    <div class="max-w-6xl mx-auto px-4" x-data="{ activeTab: 'description' }">
    <!-- Tab Navigation -->
    <div class="flex border-b border-gray-200 mb-8">
      <button @click="activeTab = 'description'" 
              :class="activeTab === 'description' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
              class="py-4 px-6 border-b-2 font-medium text-sm focus:outline-none transition-colors">
        Deskripsi
      </button>
      <button @click="activeTab = 'information'" 
              :class="activeTab === 'information' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
              class="py-4 px-6 border-b-2 font-medium text-sm focus:outline-none transition-colors">
        Informasi Tambahan
      </button>
      <button @click="activeTab = 'sizechart'" 
              :class="activeTab === 'sizechart' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
              class="py-4 px-6 border-b-2 font-medium text-sm focus:outline-none transition-colors">
        Panduan Ukuran
      </button>
      <button @click="activeTab = 'reviews'" 
              :class="activeTab === 'reviews' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
              class="py-4 px-6 border-b-2 font-medium text-sm focus:outline-none transition-colors">
        Ulasan Pelanggan
      </button>
    </div>

      <!-- Tab Content -->
      <div>
        <!-- Description Tab -->
        <div x-show="activeTab === 'description'" class="prose max-w-none">
          <h3 class="text-xl font-semibold text-gray-900 mb-4">Deskripsi Produk</h3>
          <p class="text-gray-600">
            {!!Str::markdown($product->description ?? '')!!}
          </p>
        </div>

        <!-- Information Tab -->
        <div x-show="activeTab === 'information'" class="space-y-6">
          <h3 class="text-xl font-semibold text-gray-900 mb-4">Informasi Tambahan</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-3">
              <div class="flex justify-between border-b border-gray-200 pb-2">
                <span class="font-medium text-gray-900">SKU</span>
                <span class="text-gray-600">{{$product->sku ?? 'N/A'}} </span>
              </div>
              <div class="flex justify-between border-b border-gray-200 pb-2">
                <span class="font-medium text-gray-900">Kategori</span>
                <span class="text-gray-600">{{$product->category->name}}</span>
              </div>
              <div class="flex justify-between border-b border-gray-200 pb-2">
                <span class="font-medium text-gray-900">Brand</span>
                <span class="text-gray-600">{{$product->brand->name}}</span>
              </div>
              <div class="flex justify-between border-b border-gray-200 pb-2">
                <span class="font-medium text-gray-900">Material</span>
                <span class="text-gray-600">{{ $product->material }}</span>
              </div>
              <div class="flex justify-between border-b border-gray-200 pb-2">
                <span class="font-medium text-gray-900">Motif</span>
                <span class="text-gray-600">{{ $product->pattern }}</span>
              </div>
              <div class="flex justify-between border-b border-gray-200 pb-2">
                <span class="font-medium text-gray-900">Berat</span>
                <span class="text-gray-600">{{ $product->weight }} gram</span>
              </div>
              <div class="flex justify-between border-b border-gray-200 pb-2">
                <span class="font-medium text-gray-900">Garansi</span>
                <span class="text-gray-600">{{ $product->warranty }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Size Chart Tab -->
        <div x-show="activeTab === 'sizechart'" class="space-y-6">
          <h3 class="text-xl font-semibold text-gray-900 mb-4">Panduan Ukuran</h3>
          <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Ukuran</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Lingkar Dada (cm)</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Panjang Baju (cm)</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Lebar Bahu (cm)</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">S</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">96</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">70</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">42</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">M</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">102</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">72</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">44</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">L</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">108</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">74</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">46</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">XL</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">114</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">76</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">48</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h4 class="font-medium text-blue-900 mb-2">Cara Mengukur:</h4>
            <ul class="text-sm text-blue-800 space-y-1">
              <li>• Lingkar Dada: Ukur bagian terlebar dari dada</li>
              <li>• Panjang Baju: Ukur dari bahu hingga ujung bawah baju</li>
              <li>• Lebar Bahu: Ukur dari ujung bahu kiri ke ujung bahu kanan</li>
            </ul>
          </div>
        </div>

        <!-- Reviews Tab -->
        <div x-show="activeTab === 'reviews'" class="space-y-8">
          <div class="flex justify-between items-center">
            <h3 class="text-xl font-semibold text-gray-900">Ulasan Pelanggan</h3>
          </div>

          <!-- Review Summary -->
          <div class="bg-gray-50 rounded-lg p-6">
            <div class="flex items-center space-x-4">
              <!-- Rata-rata Rating & Total Review -->
              <div class="text-center">
                <div class="text-3xl font-bold text-gray-900">
                  {{ number_format($product->reviews_avg_rating, 1) }} / 5
                </div>

                <div class="flex items-center justify-center mt-1">
                  @for ($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= round($product->reviews_avg_rating) ? 'text-yellow-400' : 'text-gray-300' }} fill-current" viewBox="0 0 20 20">
                      <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                    </svg>
                  @endfor
                </div>

                <div class="text-sm text-gray-500 mt-1">
                  {{ $product->reviews_count }} ulasan
                </div>
              </div>

              <!-- Rating Distribution -->
              <div class="flex-1 space-y-2">
                @for ($i = 5; $i >= 1; $i--)
                  @php
                    $data = $rating_data[$i] ?? ['count' => 0, 'percentage' => 0];
                  @endphp
                  <div class="flex items-center">
                    <span class="text-sm text-gray-600 w-8">{{ $i }}★</span>
                    <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-400 h-2 rounded-full" style="width: {{ $data['percentage'] }}%"></div>
                    </div>
                    <span class="text-sm text-gray-600 w-8">{{ $data['count'] }}</span>
                  </div>
                @endfor
              </div>
            </div>
          </div>

          <!-- Individual Reviews -->
          <div class="space-y-6">
            <!-- Review 1 -->
            @forelse ($product->reviews as $review)
              <div class="border-b border-gray-200 pb-6">
                <div class="flex items-start space-x-4">
                  <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                    @if($review->user && $review->user->profile_photo_path)
                      <img src="{{ asset('storage/' . $review->user->profile_photo_path) }}" alt="{{ $review->user->name }}" class="w-full h-full object-cover object-top object-center rounded-full">
                    @else
                      <span class="text-sm font-medium text-gray-600">
                          {{ strtoupper(substr($review->user->name ?? '?', 0, 1)) }}
                      </span>
                    @endif
                  </div>
                  <div class="flex-1">
                    <div class="flex items-center space-x-2 mb-2">
                      <h4 class="font-medium text-gray-900">{{ $review->user->name }}</h4>
                      <span class="text-sm text-gray-500">•</span>
                      <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="flex items-center mb-3">
                      @for($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }} fill-current" viewBox="0 0 20 20">
                          <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                        </svg>
                      @endfor
                    </div>
                    <p class="text-gray-600">
                      {{ $review->comment }}
                    </p>
                  </div>
                </div>
              </div>          
            </div>
            @empty
              <div class="text-gray-500 text-center py-6">
                Belum ada ulasan untuk produk ini.
              </div>
            @endforelse
          </div>
        </div>
      </div>
  </section>
</div>