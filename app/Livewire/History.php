<?php

namespace App\Livewire;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;


class History extends Component
{
    use WithPagination;
    
    public function render()
    {
        $my_orders = Order::where('user_id', auth()->id())->latest()->paginate(5);
        return view('livewire.history', [
            'orders' => $my_orders,
        ]);
    }
    
}
