<div class="w-full max-w-[85rem] py-8 px-4 sm:px-6 lg:px-8 mx-auto">
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
              
              <!-- Rating Stars -->
              <div class="flex items-center mb-4">
                <div class="flex items-center">
                  @for($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                      <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                    </svg>
                  @endfor
                </div>
                <span class="ml-2 text-sm text-gray-500">(24 reviews)</span>
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
              <button wire:click="addToCart({{$product->id}})" class="flex items-center justify-center px-8 py-4 bg-gradient-to-r bg-blue-500 hover:bg-gray-400 text-white font-bold rounded-lg transition-transform transform-gpu hover:-translate-y-1 hover:shadow-lg">
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
            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
              Tulis Ulasan
            </button>
          </div>

          <!-- Review Summary -->
          <div class="bg-gray-50 rounded-lg p-6">
            <div class="flex items-center space-x-4">
              <div class="text-center">
                <div class="text-3xl font-bold text-gray-900">4.5</div>
                <div class="flex items-center justify-center mt-1">
                  @for($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                      <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                    </svg>
                  @endfor
                </div>
                <div class="text-sm text-gray-500 mt-1">24 ulasan</div>
              </div>
              <div class="flex-1 space-y-2">
                <div class="flex items-center">
                  <span class="text-sm text-gray-600 w-8">5★</span>
                  <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                    <div class="bg-yellow-400 h-2 rounded-full" style="width: 60%"></div>
                  </div>
                  <span class="text-sm text-gray-600 w-8">15</span>
                </div>
                <div class="flex items-center">
                  <span class="text-sm text-gray-600 w-8">4★</span>
                  <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                    <div class="bg-yellow-400 h-2 rounded-full" style="width: 25%"></div>
                  </div>
                  <span class="text-sm text-gray-600 w-8">6</span>
                </div>
                <div class="flex items-center">
                  <span class="text-sm text-gray-600 w-8">3★</span>
                  <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                    <div class="bg-yellow-400 h-2 rounded-full" style="width: 8%"></div>
                  </div>
                  <span class="text-sm text-gray-600 w-8">2</span>
                </div>
                <div class="flex items-center">
                  <span class="text-sm text-gray-600 w-8">2★</span>
                  <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                    <div class="bg-yellow-400 h-2 rounded-full" style="width: 4%"></div>
                  </div>
                  <span class="text-sm text-gray-600 w-8">1</span>
                </div>
                <div class="flex items-center">
                  <span class="text-sm text-gray-600 w-8">1★</span>
                  <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                    <div class="bg-yellow-400 h-2 rounded-full" style="width: 0%"></div>
                  </div>
                  <span class="text-sm text-gray-600 w-8">0</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Individual Reviews -->
          <div class="space-y-6">
            <!-- Review 1 -->
            <div class="border-b border-gray-200 pb-6">
              <div class="flex items-start space-x-4">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                  <span class="text-sm font-medium text-gray-600">JD</span>
                </div>
                <div class="flex-1">
                  <div class="flex items-center space-x-2 mb-2">
                    <h4 class="font-medium text-gray-900">John Doe</h4>
                    <span class="text-sm text-gray-500">•</span>
                    <span class="text-sm text-gray-500">01 Jan 2045</span>
                  </div>
                  <div class="flex items-center mb-3">
                    @for($i = 1; $i <= 4; $i++)
                      <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                      </svg>
                    @endfor
                    <svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 20 20">
                      <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                    </svg>
                  </div>
                  <p class="text-gray-600">
                    Kualitas batik sangat bagus, bahan adem dan nyaman dipakai. Motifnya juga cantik dan tidak mudah pudar. 
                    Pengiriman cepat dan packaging rapi. Sangat puas dengan pembelian ini!
                  </p>
                </div>
              </div>
            </div>

            <!-- Review 2 -->
            <div class="border-b border-gray-200 pb-6">
              <div class="flex items-start space-x-4">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                  <span class="text-sm font-medium text-gray-600">AB</span>
                </div>
                <div class="flex-1">
                  <div class="flex items-center space-x-2 mb-2">
                    <h4 class="font-medium text-gray-900">Ahmad Budi</h4>
                    <span class="text-sm text-gray-500">•</span>
                    <span class="text-sm text-gray-500">28 Des 2024</span>
                  </div>
                  <div class="flex items-center mb-3">
                    @for($i = 1; $i <= 5; $i++)
                      <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                      </svg>
                    @endfor
                  </div>
                  <p class="text-gray-600">
                    Kemeja batik ini benar-benar premium! Ukurannya pas sesuai size chart, warnanya bagus tidak luntur saat dicuci. 
                    Cocok untuk acara formal maupun santai. Akan order lagi untuk koleksi warna lain.
                  </p>
                </div>
              </div>
            </div>

            <!-- Review 3 -->
            <div class="border-b border-gray-200 pb-6">
              <div class="flex items-start space-x-4">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                  <span class="text-sm font-medium text-gray-600">RP</span>
                </div>
                <div class="flex-1">
                  <div class="flex items-center space-x-2 mb-2">
                    <h4 class="font-medium text-gray-900">Rudi Pratama</h4>
                    <span class="text-sm text-gray-500">•</span>
                    <span class="text-sm text-gray-500">15 Des 2024</span>
                  </div>
                  <div class="flex items-center mb-3">
                    @for($i = 1; $i <= 4; $i++)
                      <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                      </svg>
                    @endfor
                    <svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 20 20">
                      <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                    </svg>
                  </div>
                  <p class="text-gray-600">
                    Batik dengan kualitas yang memuaskan. Jahitannya rapi dan bahan terasa premium. 
                    Harga sebanding dengan kualitas yang didapat. Recommended!
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Write Review Form -->
          <div class="bg-gray-50 rounded-lg p-6">
            <h4 class="text-lg font-semibold text-gray-900 mb-4">Tulis Ulasan Anda</h4>
            <form class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Rating Anda *</label>
                <div class="flex items-center space-x-1">
                  @for($i = 1; $i <= 5; $i++)
                    <button type="button" class="text-gray-300 hover:text-yellow-400 focus:text-yellow-400 transition-colors">
                      <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                      </svg>
                    </button>
                  @endfor
                </div>
              </div>
              
              <div>
                <label for="review" class="block text-sm font-medium text-gray-700 mb-2">Ulasan Anda *</label>
                <textarea id="review" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Bagikan pengalaman Anda dengan produk ini..."></textarea>
              </div>
              
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Anda *</label>
                  <input type="text" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan nama Anda">
                </div>
                <div>
                  <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                  <input type="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan email Anda">
                </div>
              </div>
              
              <div class="flex items-center">
                <input type="checkbox" id="save-info" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="save-info" class="ml-2 text-sm text-gray-600">
                  Simpan nama dan email untuk ulasan selanjutnya
                </label>
              </div>
              
              <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                Kirim Ulasan
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>