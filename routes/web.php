<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Produk;
use App\Http\Controllers\StrukController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/produk', App\Livewire\Produk::class)
    // ->middleware(['auth','role:admin'])
    ->middleware(['auth'])
    ->name('Produk');
Route::get('/menu', App\Livewire\Menu::class)
    // ->middleware(['auth','role:admin'])
    ->middleware(['auth'])
    ->name('Menu');
Route::get('/transaksi', App\Livewire\Transaksi::class)
    // ->middleware(['auth','role:admin'])
    ->middleware(['auth'])
    ->name('Transaksi');
Route::get('/discount', App\Livewire\Discount::class)
    // ->middleware(['auth','role:admin'])
    ->middleware(['auth'])
    ->name('Discount');
Route::get('/ppn', App\Livewire\Ppn::class)
    // ->middleware(['auth','role:admin'])
    ->middleware(['auth'])
    ->name('Ppn');
Route::get('/payment', App\Livewire\Payment::class)
    // ->middleware(['auth','role:admin'])
    ->middleware(['auth'])
    ->name('Payment');
Route::get('/customer', App\Livewire\Customer::class)
    // ->middleware(['auth','role:admin'])
    ->middleware(['auth'])
    ->name('Customer');
Route::get('/pos', App\Livewire\Pos::class)
    // ->middleware(['auth','role:admin'])
    ->middleware(['auth'])
    ->name('Pos');
Route::get('/kategori', App\Livewire\Kategori::class)
    ->middleware(['auth'])
    ->name('Kategori');

Route::get('struk/{batch_id?/customer_id?}', [StrukController::class,'show'])
    ->middleware(['auth'])
    ->name('Struk');

Route::get('deliveryOrder/{batch_id?/customer_id?}', [StrukController::class,'do'])
    ->middleware(['auth'])
    ->name('Do');




require __DIR__.'/auth.php';
