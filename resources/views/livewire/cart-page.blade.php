<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="container mx-auto px-4">
    <h1 class="text-2xl font-semibold mb-4">Keranjang Belanja</h1>
    <div class="flex flex-col md:flex-row gap-4">
      <div class="md:w-3/4">
        <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
          <table class="w-full">
            <thead>
              <tr>
                <th class="text-left font-semibold">Produk</th>
                <th class="text-left font-semibold">Warna</th>
                <th class="text-left font-semibold">Ukuran</th>
                <th class="text-left font-semibold">Harga</th>
                <th class="text-left font-semibold">Jumlah</th>
                <th class="text-left font-semibold">Total</th>
                <th class="text-left font-semibold">Hapus</th>
              </tr>
            </thead>
            <tbody>

              @forelse ($cart_items as $item)
              <tr wire:key="{{ $item['product_id'] }}">
                <td class="py-4">
                  <div class="flex items-center">
                    <img class="h-16 w-16 mr-4" src="{{ url('storage/', $item['image']) }}" alt="{{ $item['name'] }}">
                    <span class="font-semibold">{{ $item['name'] }}</span>
                  </div>
                </td>
                <td class="py-4">{{ $item['color'] }}</td>
                <td class="py-4">{{ $item['size'] }}</td>
                <td class="py-4">{{ 'Rp ' . number_format($item['unit_amount'], 0, ',', '.') }}</td>
                <td class="py-4">
                  <div class="flex items-center">
                    <button wire:click="decreaseQty({{ $item['product_id'] }})" class="border rounded-md py-2 px-4 mr-2">-</button>
                    <span class="text-center w-8">{{ $item['quantity'] }}</span>
                    <button wire:click="increaseQty({{ $item['product_id'] }})" class="border rounded-md py-2 px-4 ml-2">+</button>
                  </div>
                </td>
                <td class="py-4">{{ 'Rp ' . number_format($item['total_amount'], 0, ',', '.') }}</td>
                <td><button wire:click="removeItem({{ $item['product_id'] }})" class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700">
                  <span wire:loading.remove wire:target="removeItem({{ $item['product_id'] }})">Hapus</span>
                  <span wire:loading wire:target="removeItem({{ $item['product_id'] }})">Menghapus...</span>
                </button></td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="py-4 text-center text-4x1 font-semibold text-slate-500">Tidak ada produk di keranjang!</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="md:w-1/4">
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-lg font-semibold mb-4">Ringkasan</h2>
          <div class="flex justify-between mb-2">
            <span>Subtotal</span>
            <span>{{ 'Rp ' . number_format($grand_total, 0, ',', '.') }}</span>
          </div>
          <hr class="my-2">
          <div class="flex justify-between mb-2">
            <span class="font-semibold">Total</span>
            <span class="font-semibold">{{ 'Rp ' . number_format($grand_total, 0, ',', '.') }}</span>
          </div>
          @if ($cart_items)
            <button type="button" 
              wire:click="goToCheckout"
              wire:loading.attr="disabled"
              class="bg-blue-600 hover:bg-blue-700 disabled:bg-blue-400 text-white py-2 px-4 rounded-lg font-semibold transition-colors duration-200 flex items-center justify-center w-full mt-4">
              
              <span wire:loading.remove>Checkout</span>
              
              <span wire:loading class="flex items-center">
                <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Menuju Checkout...
              </span>
            </button>

          @endif
        </div>
      </div>
    </div>
  </div>
</div>