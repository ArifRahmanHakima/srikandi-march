<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use App\Helpers\CartManagement;

class DataPayment extends Component
{

    public $orderId;
    public $order;
    public $selectedPaymentMethod;

    public function mount($order)
    {
        $this->orderId = $order;
        // Jika Anda perlu mengambil informasi order dari database:
        $this->order = Order::findOrFail($order);
        $this->selectedPaymentMethod = $this->order->payment_method;
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        
        return view('livewire.data-payment', [
            'cart_items' => $cart_items,
        ]);
    }
}
