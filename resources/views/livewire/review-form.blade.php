<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto flex justify-center">
    <div class="bg-white shadow-md rounded-lg w-full max-w-3xl p-8">
        <h2 class="text-xl font-bold mb-6">Beri Ulasan untuk Pesanan #{{ $order->id }}</h2>

        @if (session()->has('message'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="submit">
            @foreach ($order->items as $item)
                @php $product = $item->product; @endphp
                <div class="mb-8 border-b pb-6">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="{{ url('storage', $product->images[0]) }}" alt="{{ $product->name }}"
                            class="w-16 h-16 object-cover object-top object-center rounded">
                        <div>
                            <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                            <span class="text-gray-500 text-sm">{{ $order->created_at->format('d M Y') }}</span>
                        </div>
                    </div>

                    <p class="block text-sm font-medium text-gray-700 mb-2">Rating Anda?</p>
                    
                    <div class="flex space-x-2 mb-3">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" class="text-gray-300 hover:text-yellow-400 focus:text-yellow-400 transition-colors" wire:click="setRating({{ $product->id }}, {{ $i }})">
                                <svg class="w-8 h-8 fill-current {{ $reviews[$product->id]['rating'] >= $i ? 'text-yellow-400' : 'text-gray-300' }}"
                                    viewBox="0 0 24 24">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                </svg>
                            </button>
                        @endfor
                    </div>
                    @error("reviews.{$product->id}.rating")
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    <label class="block text-sm font-medium mt-2">Komentar</label>
                    <textarea rows="4" wire:model.defer="reviews.{{ $product->id }}.comment"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Bagikan pengalaman Anda dengan produk ini..."></textarea>
                    @error("reviews.{$product->id}.comment")
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            @endforeach

            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                KIRIM SEMUA ULASAN
            </button>
        </form>
    </div>
</div>
