<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Address;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;

#[Title('Data Payment')]
class DataPayment extends Component
{
    public $buktiBayar, $order, $items, $address, $user, $selectedPaymentMethod;

    public function mount($order_id)
    {
        $this->order = Order::with(['items.product', 'user'])->findOrFail($order_id);
        $this->items = $this->order->items;
        $this->user = $this->order->user;
        $this->address = Address::where('order_id', $order_id)->first();
        $this->selectedPaymentMethod = $this->order->payment_method;

        switch ($this->order->payment_method) {
            case 'dana':
                $this->order->payment_method = 'DANA';
                break;
            case 'gopay':
                $this->order->payment_method = 'GoPay';
                break;
            case 'bri':
                $this->order->payment_method = 'BRI';
                break;
            case 'bni':
                $this->order->payment_method = 'BNI';
                break;
            default:
                $this->order->payment_method = 'Metode Pembayaran Tidak Dikenal';
                break;
        }

        switch ($this->order->shipping_method) {
            case 'jne':
                $this->order->shipping_method = 'JNE';
                break;
            case 'jnt':
                $this->order->shipping_method = 'J&T Express';
                break;
            default:
                $this->order->shipping_method = 'Metode Pengiriman Tidak Dikenal';
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
        $this->order->payment_status = 'paid';
        $this->order->save();

        session()->flash('message', 'Bukti pembayaran berhasil diupload.');
        return redirect()->route('order-success');
    }

    public function render()
    {
        return view('livewire.data-payment', [
            'order' => $this->order,
            'items' => $this->items,
            'address' => $this->address,
            'user' => $this->user,
        ]);
    }
}
