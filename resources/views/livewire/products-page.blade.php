<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <section class="py-10 bg-white font-poppins rounded-lg">
    <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
      <div class="flex flex-wrap mb-24 -mx-3">
        <div class="w-full pr-2 lg:w-1/4 lg:block">
          <div class="p-4 mb-5 bg-white border border-gray-200">
            <h2 class="text-2xl font-bold "> Kategori</h2>
            <div class="w-16 pb-2 mb-6 border-b border-rose-600 "></div>
            <ul>
              @foreach ($categories as $category)
              <li class="mb-4" wire:key="{{$category->id}}">
                <label for="{{$category->slug}}" class="flex items-center">
                  <input type="checkbox" wire:model.live="selected_categories" id="{{$category->slug}}" value="{{$category->id}}" class="w-4 h-4 mr-2">
                  <span class="text-lg">{{$category->name}}</span>
                </label>
              </li>
              @endforeach
            </ul>

          </div>
          <div class="p-4 mb-5 bg-white border border-gray-200">
            <h2 class="text-2xl font-bold">Brand</h2>
            <div class="w-16 pb-2 mb-6 border-b border-rose-600"></div>
            <ul>
              @foreach ($brands as $brand)
              <li class="mb-4" wire:key="{{$brand->id}}">
                <label for="{{$brand->slug}}" class="flex items-center">
                  <input type="checkbox" wire:model.live="selected_brands" id="{{$brand->slug}}" value="{{$brand->id}}" class="w-4 h-4 mr-2">
                  <span class="text-lg">{{$brand->name}}</span>
                </label>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="p-4 mb-5 bg-white border border-gray-200">
            <h2 class="text-2xl font-bold">Status Produk</h2>
            <div class="w-16 pb-2 mb-6 border-b border-rose-600"></div>
            <ul>
              <li class="mb-4">
                <label for="featured" class="flex items-center">
                  <input type="checkbox" id="featured" wire:model.live="featured" value="1" class="w-4 h-4 mr-2">
                  <span class="text-lg">Produk Ungulan</span>
                </label>
              </li>
              <li class="mb-4">
                <label for="on_sale" class="flex items-center">
                  <input type="checkbox" id="on_sale" wire:model.live="on_sale" value="1" class="w-4 h-4 mr-2">
                  <span class="text-lg">Tersedia</span>
                </label>
              </li>
            </ul>
          </div>

          <div class="p-4 mb-5 bg-white border border-gray-200">
            <h2 class="text-2xl font-bold">Harga</h2>
            <div class="w-16 pb-2 mb-6 border-b border-rose-600"></div>
            <div>
              <div>{{ 'Rp ' . number_format($price_range, 0, ',', '.') }}</div>
              <input type="range" wire:model.live="price_range" class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer" max="500000" value="300000" step="1000">
              <div class="flex justify-between ">
                <span class="inline-block text-lg font-bold text-blue-400 ">{{ 'Rp ' . number_format(1000, 0, ',', '.') }}</span>
                <span class="inline-block text-lg font-bold text-blue-400 ">{{ 'Rp ' . number_format(500000, 0, ',', '.') }}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="w-full px-3 lg:w-3/4">
          <div class="px-3 mb-4">
            <!-- Sorting produk -->
            <div class="items-center justify-between hidden px-3 py-2 bg-gray-100 md:flex ">
              <div class="flex items-center justify-between">
                <select wire:model.live="sort" class="block w-full text-base bg-gray-100 cursor-pointer">
                  <option value="latest">Urutkan berdasarkan terbaru</option>
                  <option value="price">Urutkan berdasarkan harga</option>
                </select>
              </div>
              <!-- Pencarian produk -->
              <div class="relative">
                <input wire:model.live="search" type="text" class="w-full bg-transparent placeholder:text-slate-700 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Masukan nama produk..." />
              </div>
              
            </div>
          </div>
          <div class="flex flex-wrap items-center pt-8 ">

            @foreach ($products as $product)
            <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3" wire:key="{{$product->id}}">
                <div class="relative w-full max-w-xs overflow-hidden rounded-lg bg-gray-200 shadow-md mx-auto">
                    <a href="/products/{{$product->slug}}">
                        <img class="h-60 rounded-t-lg object-cover object-top object-center w-full transition-transform duration-1000 hover:scale-111" src="{{url('storage', $product->images[0]) }}" alt="{{$product->name}}" />
                    </a>

                    @if(isset($product->is_new) && $product->is_new) {{-- Asumsi ada properti is_on_sale --}}
                    <span class="absolute top-0 left-0 w-28 translate-y-4 -translate-x-6 -rotate-45 bg-blue-600 text-center text-sm text-white">Baru</span>
                    @elseif(isset($product->on_sale) && $product->on_sale) {{-- Asumsi ada properti on_sale --}}
                    <span class="absolute top-0 left-0 w-28 translate-y-4 -translate-x-6 -rotate-45 bg-red-600 text-center text-sm text-white">Sale</span>
                    @endif

                    <div class="mt-4 px-5 pb-5">
                        <a href="/products/{{$product->slug}}">
                            <h5 class="text-xl font-semibold tracking-tight text-slate-900 truncate">{{$product->name}}</h5>
                        </a>

                        <span class="text-gray-500 text-xs mt-1 block">
                            {{ $product->brand->name ?? 'N/A' }} 
                            @if($product->category) - {{ $product->category->name }} @endif
                        </span>

                        <div class="flex items-center justify-between mt-2.5 mb-2.5"> <p>
                                <span class="text-l font-bold text-slate-900">{{'Rp ' . number_format($product->price, 0, ',', '.')}}</span> @if(isset($product->old_price) && $product->old_price > $product->price)
                                <span class="text-sm text-slate-900 line-through ml-2">{{'Rp ' . number_format($product->old_price, 0, ',', '.')}}</span>
                                @endif
                            </p>
                            
                            <a href="/products/{{ $product->slug }}"
                                class="flex items-center rounded-md bg-slate-900 px-3 py-2 text-center text-sm font-medium text-white
                                      hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 transition-transform transform-gpu hover:-translate-y-1 hover:shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span>Lihat Detail</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

          </div>
          <!-- pagination start -->
          <div class="flex justify-end mt-6e">
            {{$products->links('vendor.pagination.tailwind')}}
          </div>
          <!-- pagination end -->
        </div>
      </div>
    </div>
  </section>

</div>