<?php

use App\Models\Order;
use App\Mail\OrderPlaced;
use App\Livewire\CartPage;
use App\Livewire\HomePage;
use App\Livewire\AboutPage;
use App\Livewire\ContactUs;
use App\Livewire\CancelPage;
use App\Livewire\DataPayment;
use App\Livewire\NotFound404;
use App\Livewire\ProfilePage;
use App\Livewire\SuccessPage;
use App\Livewire\CheckoutPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\ProductsPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\CategoriesPage;
use App\Livewire\History;
use App\Livewire\OrderSuccessPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\ProductDetailPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\Auth\ForgotPasswordPage;
use Filament\Notifications\Auth\ResetPassword;

/*Router Navbar*/
Route::get('/', HomePage::class);
Route::get('/categories', CategoriesPage::class);
Route::get('/products', ProductsPage::class);
Route::get('/cart', CartPage::class);
Route::get('/products/{slug}', ProductDetailPage::class);
Route::get('/contact-us', ContactUs::class);
Route::get('/about-us', AboutPage::class);

Route::middleware('guest')->group(function () {
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class);
    Route::get('/forgot', ForgotPasswordPage::class)->name('password.request');
    Route::get('/reset-password/{token}', ResetPasswordPage::class)->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', function () {
        Auth::logout();

        return redirect('/');
    });
    Route::get('/profile', ProfilePage::class)->name('profile');
    Route::get('/checkout', CheckoutPage::class);
    Route::get('/my-orders', MyOrdersPage::class);
    Route::get('/my-orders/{order_id}', MyOrderDetailPage::class)->name('my-order.show');
    Route::get('/success/{order_id}', SuccessPage::class)->name('success');
    Route::get('/cancel', CancelPage::class)->name('cancel');
    Route::get('/data-payment/{order_id}', DataPayment::class)->name('data-payment');
    Route::get('/order-success', OrderSuccessPage::class)->name('order-success');
    Route::get('/history', History::class);
});

Route::fallback(NotFound404::class);

