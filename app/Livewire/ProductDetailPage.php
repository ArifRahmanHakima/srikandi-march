<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;

#[Title('Product Detail - SrikandiMarch')]
class ProductDetailPage extends Component
{
    public $slug;
    public $quantity = 1;
    public $selectedColor;
    public $selectedSize;
    public $product;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->product = Product::where('slug', $this->slug)->firstOrFail();

        // Fallback eksplisit jika casting model masih bermasalah
        // Karena dd() Anda menunjukkan masih string, ini penting
        $colors_array = is_string($this->product->color) ? explode(',', $this->product->color) : ($this->product->color ?? []);
        $sizes_array = is_string($this->product->size) ? explode(',', $this->product->size) : ($this->product->size ?? []);

        // Bersihkan spasi dan hapus elemen kosong
        $colors_array = array_filter(array_map('trim', $colors_array));
        $sizes_array = array_filter(array_map('trim', $sizes_array));

        // Inisialisasi pilihan default (opsi pertama jika ada)
        // Gunakan array yang sudah diproses dan difilter
        if (count($colors_array) > 0) {
            $this->selectedColor = $colors_array[0];
        } else {
            $this->selectedColor = null; // Penting jika tidak ada warna
        }

        if (count($sizes_array) > 0) {
            $this->selectedSize = $sizes_array[0];
        } else {
            $this->selectedSize = null; // Penting jika tidak ada ukuran
        }
    }

    public function increaseQty() {
        $this->quantity++;
    }

    public function decreaseQty() {
        if($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function selectColor($color) {
        $this->selectedColor = $color;
    }

    public function selectSize($size) {
        $this->selectedSize = $size;
    }

    public function addToCart($product_id) {
        // Validasi apakah warna dan ukuran sudah dipilih
        if (!$this->selectedColor && !empty($this->product->color)) { // Cek apakah memang ada pilihan warna yang harus dipilih
            session()->flash('error', 'Mohon pilih warna produk.');
            return;
        }
        if (!$this->selectedSize && !empty($this->product->size)) { // Cek apakah memang ada pilihan ukuran yang harus dipilih
            session()->flash('error', 'Mohon pilih ukuran produk.');
            return;
        }

        // Panggil CartManagement dengan menyertakan warna dan ukuran yang dipilih
        $total_count = CartManagement::addItemToCartWithQty(
            $this->product->id,
            $this->quantity,
            [
                'color' => $this->selectedColor,
                'size' => $this->selectedSize
            ]
        );

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);
        session()->flash('message', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => $this->product
        ]);
    }
}