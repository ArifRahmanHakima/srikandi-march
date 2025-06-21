<?php

namespace App\Livewire;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;


class History extends Component
{
    public function render()
    {
        $my_orders = Order::where('user_id', auth()->id())
                          ->where('status', 'delivered')
                          ->latest()
                          ->paginate(5);
        return view('livewire.history', [
            'orders' => $my_orders,
        ]);
    }
    
}
