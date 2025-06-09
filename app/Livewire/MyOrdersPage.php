<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('My Orders')]
class MyOrdersPage extends Component
{
    use WithPagination;
    
    public function render()
    {
        $my_orders = Order::where('user_id', auth()->id())
                          ->whereIn('status', ['new', 'processing', 'shipped'])
                          ->latest()
                          ->paginate(5);
                          
        return view('livewire.my-orders-page', [
            'orders' => $my_orders,
        ]);
    }
}
