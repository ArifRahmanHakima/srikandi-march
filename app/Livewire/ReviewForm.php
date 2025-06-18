<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

#[Title('Review Products')]
class ReviewForm extends Component
{
    public $order;
    public $reviews = [];

    public function mount(Order $order_id)
    {
        abort_if($order_id->user_id !== Auth::id(), 403);
        $this->order = $order_id;

        foreach ($order_id->items as $item) {
            $this->reviews[$item->product_id] = [
                'rating' => null,
                'comment' => '',
            ];
        }
    }

    public function setRating($product_id, $value)
    {
        $this->reviews[$product_id]['rating'] = $value;
    }

    public function submit()
    {
        foreach ($this->reviews as $product_id => $review) {
            $validated = Validator::make($review, [
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'required|string',
            ])->validate();

            Review::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                ],
                [
                    'user_name' => Auth::user()->name,
                    'rating' => $review['rating'],
                    'comment' => $review['comment'],
                ]
            );

            $product = \App\Models\Product::find($product_id);
            $product->average_rating = round($product->reviews()->avg('rating'), 2);
            $product->save();
        }

        session()->flash('message', 'Ulasan berhasil dikirim!');
        return redirect()->route('history');
    }

    public function render()
    {
        return view('livewire.review-form');
    }
}
