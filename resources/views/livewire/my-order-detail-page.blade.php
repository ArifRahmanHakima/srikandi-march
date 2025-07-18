<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <h1 class="text-4xl font-bold text-slate-500">Detail Pesanan</h1>

  @php
    $status = '';
    if ($order->status === 'new') {
        $status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Diproses</span>';
    } elseif ($order->status === 'processing') {
        $status = '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Dikemas</span>';
    } elseif ($order->status === 'shipped') {
        $status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Dikirim</span>';
    } elseif ($order->status === 'delivered') {
        $status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Diterima</span>';
    } else {
        $status = 'Tidak Diketahui';
    }

    $payment_status = '';
    if ($order->payment_status === 'paid') {  
        $payment_status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Dibayar</span>';
    } elseif ($order->payment_status === 'pending') {
        $payment_status = '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Tertunda</span>';
    } elseif ($order->payment_status === 'failed') {
        $payment_status = '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Gagal</span>';
    } else {
        $payment_status = 'Tidak Diketahui';
    }
  @endphp
  <!-- Grid -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-5">
    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl grey:bg-slate-900 dark:border-gray-400">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg grey:bg-gray-800">
          <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
          </svg>
        </div>

        <div class="grow">
          <div class="flex items-center gap-x-2">
            <p class="text-xs uppercase tracking-wide text-gray-500">
              Pelanggan
            </p>
          </div>
          <div class="mt-1 flex items-center gap-x-2">
            <div>{{ $address->full_name }}</div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl grey:bg-slate-900 dark:border-gray-400">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg grey:bg-gray-800">
          <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 22h14" />
            <path d="M5 2h14" />
            <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />
            <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />
          </svg>
        </div>

        <div class="grow">
          <div class="flex items-center gap-x-2">
            <p class="text-xs uppercase tracking-wide text-gray-500">
              Tanggal Pesanan
            </p>
          </div>
          <div class="mt-1 flex items-center gap-x-2">
            <h3 class="text-xl font-medium text-gray-800 dark:text-gray-500">
              {{ $order_items[0]->created_at->format('d-m-Y') }}
            </h3>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl grey:bg-slate-900 dark:border-gray-400">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg grey:bg-gray-800">
          <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6" />
            <path d="m12 12 4 10 1.7-4.3L22 16Z" />
          </svg>
        </div>

        <div class="grow">
          <div class="flex items-center gap-x-2">
            <p class="text-xs uppercase tracking-wide text-gray-500">
              Status Pesanan
            </p>
          </div>
          <div class="mt-1 flex items-center gap-x-2">{!! $status !!}</div>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl grey:bg-slate-900 dark:border-gray-400">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg grey:bg-gray-800">
          <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12s2.545-5 7-5c4.454 0 7 5 7 5s-2.546 5-7 5c-4.455 0-7-5-7-5z" />
            <path d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
            <path d="M21 17v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2" />
            <path d="M21 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2" />
          </svg>
        </div>

        <div class="grow">
          <div class="flex items-center gap-x-2">
            <p class="text-xs uppercase tracking-wide text-gray-500">
              Status Pembayaran
            </p>
          </div>
          <div class="mt-1 flex items-center gap-x-2">{!! $payment_status !!}</div>
        </div>
      </div>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Grid -->

  @if ($order->payment_status === 'pending')
    @if ($order->shipping_amount == 0)
      <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg mt-4">
        <p class="font-semibold">Pesanan Anda Sedang dicek biaya pengiriman</p>
        <p>Harap menunggu, biaya pengiriman akan segera diproses.</p>
      </div>
    @elseif ($order->shipping_amount > 0)
      <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg mt-4">
        <p class="font-semibold">Pembayaran Belum Dilakukan</p>
        <p>Silakan melakukan pembayaran dan unggah bukti pembayaran Anda agar pesanan dapat diproses.</p>
        <p class="mt-2"></p>
        <a href="{{ route('data-payment', ['order_id' => $order->id]) }}"
            class="bg-blue-500 mt-6 py-1 px-3 rounded text-white shadow">
            Klik Disini!!
        </a>
      </div>
    @endif
  @endif

  <div class="flex flex-col md:flex-row gap-4 mt-4">
    <div class="md:w-3/4">
      <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
        <table class="w-full">
          <thead>
            <tr>
              <th class="text-left font-semibold">Produk</th>
              <th class="text-left font-semibold">Harga</th>
              <th class="text-left font-semibold">Jumlah</th>
              <th class="text-left font-semibold">Total</th>
            </tr>
          </thead>
          <tbody>

            <!--[if BLOCK]><![endif]-->
            @foreach ($order_items as $item)
              <tr wire:key="{{ $item->id }}">
                <td class="py-4">
                  <div class="flex items-center">
                    <img class="h-16 w-16 mr-4" src="{{ url('storage/', $item->product->images[0]) }}" alt="{{ $item->product->name }}">
                    <span class="font-semibold">{{ $item->product->name }}</span>
                  </div>
                </td>
                <td class="py-4">{{ 'Rp ' . number_format($item->product->price, 0, ',', '.') }}</td>
                <td class="py-4">
                  <span class="text-center w-8">{{ $item->quantity }}</span>
                </td>
                <td class="py-4">{{ 'Rp ' . number_format($order->grand_total, 0, ',', '.') }}</td>
              </tr>
            @endforeach
            <!--[if ENDBLOCK]><![endif]-->

          </tbody>
        </table>
      </div>

      <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
        <h1 class="font-3xl font-bold text-slate-500 mb-3">Alamat Pengiriman</h1>
        <div class="flex justify-between items-center">
          <div>
            <p>{{ $address->province }}, {{ $address->city }}, {{ $address->subdistrict }}, {{ $address->street_address }}</p>
          </div>
          <div>
            <p class="font-semibold">Nomor Telepon:</p>
            <p>{{ $address->phone }}</p>
          </div>
        </div>
      </div>

    </div>
    <div class="md:w-1/4">
       <div class="flex flex-col gap-4">
          <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold mb-4">Ringkasan</h2>
            <div class="flex justify-between mb-2">
              <span>Subtotal</span>
              <span>{{ 'Rp ' . number_format($order->grand_total - $order->shipping_amount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between mb-2">
              <span>Biaya Pengiriman</span>
              <span>{{ 'Rp ' . number_format($order->shipping_amount, 0, ',', '.') }}</span>
            </div>
            <hr class="my-2">
            <div class="flex justify-between mb-2">
              <span class="font-semibold">Total</span>
              <span class="font-semibold">{{ 'Rp ' . number_format($order->grand_total, 0, ',', '.') }}</span>
            </div>
          </div>
  
          @if ($order->no_resi)
            <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold mb-2 text-slate-700">Cek Resi</h2>
            <hr class="my-2 mb-2">

            <div class="flex flex-col space-y-4 text-slate-600">
              <!-- No. Resi -->
              <div>
                <p class="font-semibold">No. Resi:</p>
                <p id="resiText"
                  class="cursor-pointer text-blue-600 hover:underline"
                  onclick="copyToClipboard('resiText')"
                  title="Klik untuk salin">
                  {{ $order->no_resi }}
                </p>
                <p id="copyMessage" class="text-sm text-green-600 mt-1 hidden">Disalin ke clipboard!</p>
              </div>

              <!-- Ekspedisi -->
              <div>
                <p class="font-semibold">Metode Pengiriman :</p>
                <p>{{ $order->shipping_method }}</p>
              </div>

              <!-- Tombol Cek Resi -->
              <div>
                <a href="https://cekresi.com/?noresi={{ $order->no_resi }}"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="w-full flex justify-center items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-all shadow">
                  Cek Resi Online
                </a>
              </div>
            </div>
          </div>

          <script>
            function copyToClipboard(elementId) {
              const text = document.getElementById(elementId).innerText;
              navigator.clipboard.writeText(text).then(() => {
                const msg = document.getElementById('copyMessage');
                msg.classList.remove('hidden');
                setTimeout(() => msg.classList.add('hidden'), 2000);
              });
            }
          </script>
          @endif

    </div>
  </div>
</div>