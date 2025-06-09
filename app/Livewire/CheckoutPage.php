<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Address;
use Livewire\Component;
use App\Mail\OrderPlaced;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use Illuminate\Support\Facades\Mail;

#[Title('Checkout')]
class CheckoutPage extends Component
{

    public $full_name;
    public $phone;
    public $street_address;
    public $province;
    public $city;
    public $subdistrict;
    public $zip_code;
    public $payment_method;
    public $shipping_method;

    public function mount(){
        $cart_items = CartManagement::getCartItemsFromCookie();
        if(count($cart_items) == 0){
            return redirect('/products');
        }
    }

    protected $messages = [
        'full_name.required' => 'Nama lengkap wajib diisi.',
        'phone.required' => 'Nomor telepon wajib diisi.',
        'street_address.required' => 'Alamat lengkap wajib diisi.',
        'province.required' => 'Provinsi wajib diisi.',
        'city.required' => 'Kabupaten/Kota wajib diisi.',
        'subdistrict.required' => 'Kecamatan wajib diisi.',
        'zip_code.required' => 'Kode pos wajib diisi.',
        'payment_method.required' => 'Metode pembayaran wajib dipilih.',
        'shipping_method.required' => 'Metode pengiriman wajib dipilih.',
    ];

    public function placeOrder()
    {
        $this->validate([
            'full_name' => 'required',
            'phone' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'subdistrict' => 'required',
            'zip_code' => 'required',
            'payment_method' => 'required',
            'shipping_method' => 'required',
        ]);

        $cart_items = CartManagement::getCartItemsFromCookie();

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->grand_total = CartManagement::calculateGrandTotal($cart_items);
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->currency = 'rp';
        $order->shipping_amount = 0; // Assuming no shipping for simplicity
        $order->shipping_method = $this->shipping_method;
        $order->notes = 'Order placed by ' . auth()->user()->name;
        $order->save();

        $address = new Address();
        $address->order_id = $order->id;
        $address->full_name = $this->full_name;
        $address->phone = $this->phone;
        $address->street_address = $this->street_address;
        $address->province = $this->province;
        $address->city = $this->city;
        $address->subdistrict = $this->subdistrict;
        $address->zip_code = $this->zip_code;
        $address->save();

        // 💡 Format ulang item agar cocok untuk tabel order_items
        $order_items = [];

        foreach ($cart_items as $item) {
            $order_items[] = [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_amount' => $item['unit_amount'],
                'total_amount' => $item['unit_amount'] * $item['quantity'], 
                'size' => $item['size'] ?? null,
                'color' => $item['color'] ?? null,
            ];
        }

        $order->items()->createMany($order_items);

        CartManagement::clearCartItems();

        Mail::to('3srikandimerchofficial@gmail.com')->send(new OrderPlaced($order));

        $redirect_url = route('success', ['order_id' => $order->id]);
        return redirect($redirect_url);
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total
        ]);
    }
}
