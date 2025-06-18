<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;

#[Title('Products - SrikandiMarch')]
class ProductsPage extends Component
{
    #[Url]
    public $selected_categories = [];

    #[Url]
    public $selected_brands = [];

    #[Url]
    public $featured;

    #[Url]
    public $on_sale;

    #[Url]
    public $min_price = 0;

    #[Url]
    public $max_price = 500000;

    #[Url]
    public $sort = 'latest';

    #[Url]
    public $search = '';

    public function addToCart($product_id) {
        $total_count = CartManagement::addItemToCart($product_id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);
    }

    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);

        if(!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        if(!empty($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }

        if($this->featured) {
            $productQuery->where('is_featured', 1);
        }

        if($this->on_sale) {
            $productQuery->where('on_sale', 1);
        }

        if (!is_null($this->min_price) && !is_null($this->max_price)) {
            $productQuery->whereBetween('price', [$this->min_price, $this->max_price]);
        }

        if ($this->min_price > $this->max_price) {
            [$this->min_price, $this->max_price] = [$this->max_price, $this->min_price];
        }

        if (!empty($this->search)) {
            $productQuery->where(function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhereHas('brand', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('category', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });

            });
        }

        if($this->sort == 'latest') {
            $productQuery->latest();
        } 
        
        if($this->sort == 'price') {
            $productQuery->orderBy('price');
        }

        return view('livewire.products-page', [
            'products' => $productQuery->paginate(9),
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
