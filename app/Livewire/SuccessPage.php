<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Address;
use Livewire\Component;
use App\Models\OrderItem;
use Livewire\Attributes\Title;

#[Title('Success')]
class SuccessPage extends Component
{

    public $order_id;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function render()
    {
        $order_items = OrderItem::with('product')->where('order_id', $this->order_id)->get();
        $order = Order::where('id', $this->order_id)->first();
        $address = Address::where('order_id', $this->order_id)->first();

        switch ($order->payment_method) {
            case 'dana':
                $order->payment_method = 'DANA';
                break;
            case 'gopay':
                $order->payment_method = 'GoPay';
                break;
            case 'bri':
                $order->payment_method = 'BRI';
                break;
            case 'bni':
                $order->payment_method = 'BNI';
                break;
            default:
                $order->payment_method = 'Metode Pembayaran Tidak Dikenal';
                break;
        }

        switch ($order->shipping_method) {
            case 'jne':
                $order->shipping_method = 'JNE';
                break;
            case 'jnt':
                $order->shipping_method = 'J&T Express';
                break;
            default:
                $order->shipping_method = 'Metode Pengiriman Tidak Dikenal';
                break;
        }

        return view('livewire.success-page', [
            'order_items' => $order_items,
            'order' => $order,
            'address' => $address
        ]);
    }
}
