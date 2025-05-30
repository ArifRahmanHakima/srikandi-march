<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Address;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Helpers\CartManagement;

class DataPayment extends Component
{
    use WithFileUploads;

    public $buktiBayar;
    public $order;
    public $orders;
    public $user;
    public $address;
    public $items;
    public $selectedPaymentMethod;

    public function mount($order)
    {
        
        $this->order = Order::with('items.product')->findOrFail($order);
        $this->selectedPaymentMethod = $this->order->payment_method;

        if ($this->order->user_id) {
            $this->user = (object) [
                'email' => $this->order->user->email ?? null,
            ];
        } 

        $addressModel = Address::where('order_id', $this->order->id)->first();
        if ($addressModel) {
            $this->address = (object) [
                'first_name' => $addressModel->first_name ?? null,
                'last_name' => $addressModel->last_name ?? null,
                'phone' => $addressModel->phone ?? null,
                'address' => $addressModel->street_address ?? null,
                'city' => $addressModel->city ?? null,
                'state' => $addressModel->state ?? null,
            ];
        }

        $this->orders = (object) [
            'id' => $this->order->id,
            'total' => $this->order->grand_total,
            'ongkir' => $this->order->shipping_amount,
            'payment_method' => $this->order->payment_method,
            'shipping_method' => $this->order->shipping_method,
            'created_at' => $this->order->created_at->format('d M Y H:i'),
        ];

        switch ($this->orders->payment_method) {
            case 'dana':
                $this->orders->payment_method = 'DANA';
                break;
            case 'gopay':
                $this->orders->payment_method = 'GoPay';
                break;
            case 'bri':
                $this->orders->payment_method = 'BRI';
                break;
            case 'bni':
                $this->orders->payment_method = 'BNI';
                break;
            default:
                $this->orders->payment_method = 'Metode Pembayaran Tidak Dikenal';
                break;
        }

        switch ($this->orders->shipping_method) {
            case 'jne':
                $this->orders->shipping_method = 'JNE';
                break;
            case 'jte':
                $this->orders->shipping_method = 'J&T Express';
                break;
            default:
                $this->orders->shipping_method = 'Metode Pengiriman Tidak Dikenal';
                break;
        }
    }

   public function simpanBuktiBayar()
    {
        $this->validate([
            'buktiBayar' => 'required|image|max:2048',
        ]);

        $filename = $this->buktiBayar->store('bukti_pembayaran', 'public');

        $this->order->bukti_pembayaran = $filename;
        $this->order->save();

        session()->flash('message', 'Bukti pembayaran berhasil diupload.');
    }

    public function konfirmasiPembayaran()
    {
        if (!$this->order->bukti_pembayaran) {
            session()->flash('message', 'Harap upload bukti pembayaran terlebih dahulu.');
            return;
        }

        return redirect()->route('order-success', ['order' => $this->order->id]);
    }

    public function render()
    {
        return view('livewire.data-payment');
    }
}
