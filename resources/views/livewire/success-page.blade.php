<section class="flex items-center font-poppins white:bg-gray-800 pt-20 mb-20">
  <div class="justify-center flex-1 max-w-6xl sm:px-6 lg:px-8 mx-auto px-4 py-4 mx-auto bg-white border rounded-md dark:border-gray-300 white:bg-gray-900 md:py-10 md:px-10">
    <div>
      <h1 class="px-4 mb-8 text-2xl font-semibold tracking-wide text-gray-700 dark:text-black ">
        Terima Kasih. Pesanan Anda Telah Diterima. </h1>
      <div class="flex border-b border-gray-200 dark:border-gray-700 items-stretch justify-start w-full h-full px-4 mb-8 md:flex-row xl:flex-col md:space-x-6 lg:space-x-8 xl:space-x-0">
        <div class="flex items-start justify-start flex-shrink-0">
          <div class="flex items-center justify-center w-full pb-6 space-x-4 md:justify-start">
            <div class="flex flex-col items-start justify-start space-y-2">
              <p class="text-lg font-semibold leading-4 text-left text-black dark:text-black">
                {{ $address->name }}</p>
              <p class="text-sm leading-4 text-black dark:text-black">{{ $address->province }}, {{ $address->city }}, {{ $address->subdistrict }}, {{ $address->street_address }}</p>
              <p class="text-sm leading-4 text-black dark:text-black">Kode Pos : {{ $address->zip_code }}</p>
              <p class="text-sm leading-4 cursor-pointer dark:text-black">No. Telepon : {{ $address->phone }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="flex flex-wrap items-center pb-4 mb-10 border-b border-gray-200 dark:border-gray-700">
        <div class="w-full px-4 mb-4 md:w-1/4">
          <p class="mb-2 text-sm leading-5 text-black dark:text-black ">
            Nomor Pesanan : </p>
          <p class="text-base font-semibold leading-4 text-black dark:text-black">
            {{ $order->id }}</p>
        </div>
        <div class="w-full px-4 mb-4 md:w-1/4">
          <p class="mb-2 text-sm leading-5 text-black dark:text-black ">
            Tanggal Pesanan : </p>
          <p class="text-base font-semibold leading-4 text-black dark:text-black">
            {{ $order->created_at->format('d-m-Y') }}</p>
        </div>
        <div class="w-full px-4 mb-4 md:w-1/4">
          <p class="mb-2 text-sm leading-5 text-black dark:text-black ">
            Metode Pembayaran : </p>
          <p class="text-base font-semibold leading-4 text-blue-600 dark:text-black">
            {{ $order->payment_method }}</p>
        </div>
        <div class="w-full px-4 mb-4 md:w-1/4">
          <p class="mb-2 text-sm leading-5 text-black dark:text-black ">
            Metode Pengiriman : </p>
          <p class="text-base font-semibold leading-4 text-black dark:text-black ">
            {{ $order->shipping_method }}</p>
        </div>
      </div>
      <div class="px-4 mb-10">
        <div class="flex flex-col items-stretch justify-center w-full space-y-4 md:flex-row md:space-y-0 md:space-x-8">
          <div class="flex flex-col w-full space-y-6 ">
            <h2 class="mb-2 text-xl font-semibold text-gray-700 dark:text-black">Rincian Pesanan</h2>
            <div class="overflow-x-auto">
              <table class="w-full text-sm text-left text-gray-500 dark:text-black">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 gray:bg-gray-700 dark:text-black">
                  <tr>
                    <th scope="col" class="px-6 py-3">Produk</th>
                    <th scope="col" class="px-6 py-3">Harga</th>
                    <th scope="col" class="px-6 py-3">Jumlah</th>
                    <th scope="col" class="px-6 py-3">Total</th>
                  </tr>
                </thead>
                <tbody class="border-b">
                  @foreach ($order->items as $item)
                    <tr wire:key="{{ $item->id }}">
                      <td class="py-4 px-6">
                        <div class="flex items-center">
                          <img class="h-14 w-14 mr-4" src="{{ url('storage/', $item->product->images[0]) }}" alt="{{ $item->product->name }}">
                          <span class="font-semibold">{{ $item->product->name }}</span>
                        </div>
                      </td>
                      <td class="px-6 py-4">{{ 'Rp ' . number_format($item->product->price, 0, ',', '.') }}</td>
                      <td class="px-6 py-4">{{ $item->quantity }}</td>
                      <td class="px-6 py-4">{{ 'Rp ' . number_format($item->total_amount, 0, ',', '.') }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="flex flex-col items-center justify-center w-full pb-4 space-y-4 border-b border-gray-200 dark:border-gray-700">
              
              <div class="flex justify-between w-full">
                <p class="text-base leading-4 text-black dark:text-black">Subtotal</p>
                <p class="text-base leading-4 text-black dark:text-black">{{ 'Rp ' . number_format($order->grand_total - $order->shipping_amount, 0, ',', '.') }}</p>
              </div>
              <div class="flex items-center justify-between w-full">
                <p class="text-base leading-4 text-black dark:text-black">Biaya Pengiriman</p>
                <p class="text-base leading-4 text-black dark:text-black">{{ 'Rp ' . number_format($order->shipping_amount, 0, ',', '.') }}</p>
              </div>
            </div>
            <div class="flex items-center justify-between w-full">
              <p class="text-base font-semibold leading-4 text-black dark:text-black">Total</p>
              <p class="text-base font-semibold leading-4 text-black dark:text-black">{{ 'Rp ' . number_format($order->grand_total, 0, ',', '.') }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="flex items-center justify-start gap-4 px-4 mt-6>">
        <a href="/products" class="w-full text-center px-4 py-2 text-blue-500 border border-blue-500 rounded-md md:w-auto hover:text-white hover:bg-blue-600 dark:border-gray-400 dark:text-black">
          Belanja Lagi
        </a>
        <a href="/my-orders" class="w-full text-center px-4 py-2 bg-blue-500 rounded-md text-white md:w-auto hover:bg-blue-600">
          Lihat Pesanan Saya
        </a>
      </div>
    </div>
  </div>
</section>