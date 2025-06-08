@php
    $shipping_method = '';
    if ($order->shipping_method === 'jnt') {
        $shipping_method = 'J&T Express';
    } elseif ($order->shipping_method === 'jne') {
        $shipping_method = 'JNE';
    } else {
        $shipping_method = 'Tidak Diketahui';
    }

    $payment_method = '';
    if ($order->payment_method === 'dana') {
        $payment_method = 'DANA';
    } elseif ($order->payment_method === 'gopay') {
        $payment_method = 'GoPay';
    } elseif ($order->payment_method === 'bri') {
        $payment_method = 'BRI';
    } elseif ($order->payment_method === 'bni') {
        $payment_method = 'BNI';
    } else {
        $payment_method = 'Tidak Diketahui';
    }
@endphp

<x-mail::message>
# 🎉 Pesanan Terbaru Diterima

Pesanan Terbaru dari **{{ $order->user->name }}**!

Nomor Pesanan       : **#{{ $order->id }}**  
Tanggal Pemesanan   : **{{ $order->created_at->format('d M Y, H:i') }}**

---

### 🧾 Ringkasan Pesanan

- **Total**: Rp{{ number_format($order->grand_total, 0, ',', '.') }}
- **Payment Method**: {{ $payment_method }}
- **Shipping Method**: {{ $shipping_method }}

<x-mail::button :url="$url" color="blue">
Lihat Pesanan
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
