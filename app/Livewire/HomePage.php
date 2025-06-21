<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Banner;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;

#[Title ('Home Page - SrikandiMarch')]
class HomePage extends Component
{
    public function addToCart($product_id) {
        $total_count = CartManagement::addItemToCart($product_id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);
    }
    public function render()
    {
        $brands = Brand::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)->get();
        $banners = Banner::where('is_active', 1)->get();

        $newProducts = \App\Models\Product::where('is_active', 1)
            ->where('is_new', 1)
            ->where('in_stock', 1)
            ->with(['category', 'brand'])
            ->latest()
            ->take(8)
            ->get();
            
        return view('livewire.home-page', [
            'brands' => $brands,
            'categories' => $categories,
            'newProducts' => $newProducts,
            'banners' => $banners
        ]);
    }
}
