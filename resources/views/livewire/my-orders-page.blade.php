<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <h1 class="text-4xl font-bold text-slate-700">Pesanan Saya</h1>
  <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="overflow-hidden">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
              <tr>
                <th scope="col" class="px-6 py-3 text-start text-l font-medium text-gray-500 uppercase">No</th>
                <th scope="col" class="px-6 py-3 text-start text-l font-medium text-gray-500 uppercase">Tanggal</th>
                <th scope="col" class="px-6 py-3 text-start text-l font-medium text-gray-500 uppercase">Status Pesanan</th>
                <th scope="col" class="px-6 py-3 text-start text-l font-medium text-gray-500 uppercase">Status Pembayaran</th>
                <th scope="col" class="px-6 py-3 text-start text-l font-medium text-gray-500 uppercase">Jumlah Pembayaran</th>
                <th scope="col" class="px-6 py-3 text-center text-l font-medium text-gray-500 uppercase">Aksi</th>
              </tr>
            </thead>
            <tbody>
              
              @forelse ($orders as $order)
                @php
                  $status = '';
                  if ($order->status === 'new') {
                      $status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Diproses</span>';
                  } elseif ($order->status === 'processing') {
                      $status = '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Dikemas</span>';
                  } elseif ($order->status === 'shipped') {
                      $status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Dikirim</span>';
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
                <tr class="odd:bg-white even:bg-gray-100 white:odd:bg-slate-900" wire:key="{{ $order->id }}">
                  <td class="px-6 py-4 whitespace-nowrap text-l font-medium text-gray-600 white:text-gray-200">{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-l text-gray-800 white:text-gray-200">{{ $order->created_at->format('d-m-Y') }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-l text-gray-800 white:text-gray-200">{!! $status !!}</span></td>
                  <td class="px-6 py-4 whitespace-nowrap text-l text-gray-800 white:text-gray-200">{!! $payment_status !!}</span></td>
                  <td class="px-6 py-4 whitespace-nowrap text-l text-gray-800 white:text-gray-200">{{ 'Rp ' . number_format($order->grand_total, 0, ',', '.') }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-center text-l font-medium">
                    <a href="/my-orders/{{ $order->id }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Lihat Detail</a>
                  </td>
                </tr>
              @empty
              <tr>
                <td colspan="5" class="py-4 text-center text-4x1 font-semibold text-slate-500">Kamu belum memiliki pesanan saat ini.</td>
              </tr>
              @endforelse

            </tbody>
          </table>
        </div>
      </div>
        {{ $orders->links('vendor.pagination.tailwind') }}
    </div>
  </div>
</div>