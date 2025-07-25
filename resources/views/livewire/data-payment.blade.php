<div class="container mx-auto p-6 bg-gray-100 min-h-screen">
  <!-- Grid -->
  <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Informasi Pesanan -->
    <div class="md:col-span-2 bg-white p-6 border border-gray-200 rounded self-start space-y-4">
      <h2 class="text-2xl font-bold text-gray-800">Terima Kasih. Pesanan Anda Telah Diterima.</h2>

      <div class="grid grid-cols-3 text-base gap-y-2">
        <div class="font-semibold text-gray-700">Nama</div>
        <div class="col-span-2 text-gray-800">: {{ $address->full_name }}</div>

        <div class="font-semibold text-gray-700">Email</div>
        <div class="col-span-2 text-gray-800">: {{ $user->email }}</div>

        <div class="font-semibold text-gray-700">Alamat</div>
        <div class="col-span-2 text-gray-800">: {{ $address->province }}, {{ $address->city }}, {{ $address->subdistrict }}</div>

        <div class="font-semibold text-gray-700">Jalan</div>
        <div class="col-span-2 text-gray-800">: {{ $address->street_address }}</div>
      </div>

      <hr class="my-4 border-gray-300">

      <div class="grid grid-cols-3 text-base gap-y-2">
        <div class="font-semibold text-gray-700">Nomor Pesanan</div>
        <div class="col-span-2 text-gray-800">: {{ $order->id }}</div>

        <div class="font-semibold text-gray-700">Tanggal</div>
        <div class="col-span-2 text-gray-800">: {{ $order->created_at->format('d-m-Y') }}</div>

        <div class="font-semibold text-gray-700">Metode Pembayaran</div>
        <div class="col-span-2 text-gray-800">: {{ $order->payment_method }}</div>

        <div class="font-semibold text-gray-700">Layanan Pengiriman</div>
        <div class="col-span-2 text-gray-800">: {{ $order->shipping_method }}</div>
      </div>

      <hr class="my-4 border-gray-300">

      <h3 class="font-semibold text-lg text-gray-800">Detail Pembayaran</h3>
      <div class="space-y-1">
        <div class="flex justify-between">
          <span>Subtotal</span>
          <span>{{ 'Rp ' . number_format($order->grand_total - $order->shipping_amount, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between">
          <span>Biaya Pengiriman</span>
          <span>{{ 'Rp ' . number_format($order->shipping_amount, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between font-bold">
          <span>Total</span>
          <span>{{ 'Rp ' . number_format($order->grand_total, 0, ',', '.') }}</span>
        </div>
      </div>
    </div>

    <div class="bg-white p-6 border border-gray-200 rounded space-y-4">
        <div>
            <div class="text-xl font-bold underline text-gray-700 grey:text-white mb-2">
                Rincian Pesanan
            </div>
            <ul class="divide-y divide-gray-200 grey:divide-gray-700" role="list">
                @foreach($order->items as $item)
                <li class="py-3 sm:py-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-16 w-16 mr-4 rounded-full" src="{{ url('storage/', $item->product->images[0]) }}" alt="{{ $item->product->name }}">
                        </div>
                        <div class="flex-1 min-w-0 ms-4">
                            <p class="text-sm font-medium text-gray-900 truncate grey:text-white">
                                {{ $item->product->name }}
                            </p>
                            <p class="text-sm text-gray-500 truncate grey:text-gray-400">
                                Jumlah	: {{ $item->quantity }}
                            </p>
                            @if(isset($item->size))
                                <p class="text-sm text-gray-500 truncate grey:text-gray-400">
                                    Ukuran: {{ $item->size }}
                                </p>
                            @endif
                            @if(isset($item->color))
                                <p class="text-sm text-gray-500 truncate grey:text-gray-400">
                                    Warna: {{ $item->color }}
                                </p>
                            @endif
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900 grey:text-white">
                            {{ 'Rp ' . number_format($item->total_amount, 0, ',', '.') }}
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        @if ($selectedPaymentMethod === 'dana' || $selectedPaymentMethod === 'gopay')
            <div class="bg-green-600 text-white text-center text-2xl font-bold py-2 rounded">
                Nomor E-Wallet : <br> 085234333123
            </div>
        @elseif ($selectedPaymentMethod === 'bri' || $selectedPaymentMethod === 'bni')
            <div class="bg-green-600 text-white text-center text-2xl font-bold py-2 rounded">
                Nomor Rekening : <br>
                @if ($selectedPaymentMethod === 'bri')
                    BRI: 809764321
                @elseif ($selectedPaymentMethod === 'bni')
                    BNI: 12231231231
                @endif
            </div>
        @else
            <div class="text-center text-gray-500 py-2">
                Pilih metode pembayaran terlebih dahulu.
            </div>
        @endif

        <div class="flex flex-col gap-2">
            {{-- Tombol Custom untuk Memicu Upload --}}
            <div class="relative">
                <button type="button" onclick="document.getElementById('buktiBayar').click();" class="w-full mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center justify-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2" />
                        <path d="M12 16V4" />
                        <path d="M6 10l6-6 6 6" />
                    </svg>
                    <span>Upload Bukti Pembayaran <span class="text-red-500">*</span></span>
                </button>

                <input type="file" id="buktiBayar" wire:model="buktiBayar" class="hidden">
            </div>

            {{-- Preview dan Validasi --}}
            @error('buktiBayar') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror

            <div wire:loading wire:target="buktiBayar" class="text-blue-500 text-sm mt-2">Mengunggah...</div>

            @if ($buktiBayar)
                <div class="mt-4">
                    <img src="{{ $buktiBayar->temporaryUrl() }}" class="w-32 h-32 object-cover rounded border">
                </div>

                <button type="submit" wire:click="simpanBuktiBayar" class="mt-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Simpan Bukti Pembayaran
                </button>
            @endif

            @if (session()->has('message'))
                <div class="mt-4 text-green-600 text-sm">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <div class="text-l text-blue-700 bg-blue-100 p-2 rounded flex items-start">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
            </svg>
            <span>Silakan lakukan transfer pada nomor Rekening/e-wallet di atas dan upload bukti pembayaran anda di sini.</span>
        </div>
        </div>
    <!-- End Grid -->
</div>