<div class="container mx-auto p-6 bg-gray-100 min-h-screen">
    <div class="bg-white shadow-md rounded-lg p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="md:col-span-2 bg-white p-6 border border-gray-200 rounded">
            <h2 class="text-xl font-bold mb-4">Thank you. Your order has been received.</h2>
            <div class="grid grid-cols-3 text-sm gap-y-1">
                <div class="font-semibold">Nama</div>
                <div class="col-span-2">: Singgih Romadhoni</div>

                <div class="font-semibold">Alamat</div>
                <div class="col-span-2">: Kore</div>

                <div class="font-semibold">No. HP</div>
                <div class="col-span-2">: 0882-6903-6400</div>

                <div class="font-semibold">Jalan</div>
                <div class="col-span-2">: Kalimo Sodo, Tamanan Kulon</div>
            </div>
            <div class="text-sm space-y-1">
            <hr class="my-2 border-gray-300">

            <div class="grid grid-cols-3 text-sm gap-y-1">
                <div class="font-semibold">Nomor Pesanan</div>
                <div class="col-span-2">: 20</div>

                <div class="font-semibold">Tgl</div>
                <div class="col-span-2">: 17-02-2025</div>

                <div class="font-semibold">Metode Pembayaran</div>
                <div class="col-span-2">: E-Wallet (DANA)</div>

                <div class="font-semibold">Layanan Pengiriman</div>
                <div class="col-span-2">: JNT</div>
            </div>
            
                <hr class="my-2 border-gray-300">
                <h3 class="font-semibold">Detail Pesanan</h3>
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span>IDR 14,000.00</span>
                </div>
                <div class="flex justify-between">
                    <span>Discount</span>
                    <span>00</span>
                </div>
                <div class="flex justify-between">
                    <span>Shipping</span>
                    <span>00</span>
                </div>
                <hr class="my-2 border-gray-300">
                <div class="flex justify-between font-bold text-lg mt-2">
                    <span>Total</span>
                    <span>IDR 14,000.00</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 border border-gray-200 rounded space-y-4">
            <div>
                <h3 class="font-semibold text-lg mb-2">Rincian Pesanan</h3>
                @for ($i = 0; $i < 3; $i++)
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <img src="https://via.placeholder.com/40" alt="Iphone 15" class="rounded w-10 h-10 object-cover">
                            <div>
                                <p class="text-sm font-medium">Iphone 15 PRO MAX</p>
                                <p class="text-xs text-gray-600">Jumlah: 1</p>
                            </div>
                        </div>
                        <p class="text-sm font-semibold">IDR 13JT</p>
                    </div>
                    <hr class="my-2 border-gray-300 mb-4">
                @endfor
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
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center justify-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2" />
                        <path d="M12 16V4" />
                        <path d="M6 10l6-6 6 6" />
                    </svg>
                    Upload Bukti Pembayaran
                    <span class="text-red-500">*</span>
                </button>

                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Konfirmasi Pembayaran
                </button>
            </div>



            <div class="text-xs text-blue-700 bg-blue-100 p-2 rounded">
                Silakan lakukan transfer pada nomor Rekening/e-wallet di atas dan upload bukti pembayaran anda.
            </div>
        </div>

    </div>
</div>
