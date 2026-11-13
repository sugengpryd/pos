<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Produk;
use App\Http\Controllers\StrukController;
use App\Http\Controllers\createdbController;
use App\Http\Controllers\downloadPdfController;


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

Route::get('strukprint/{batch_id?/customer_id?}', [StrukController::class,'show'])
    ->middleware(['auth'])
    ->name('Strukprint');

Route::post('/struk', [StrukController::class, 'show'])
    ->name('Struk');

Route::get('deliveryOrder/{batch_id?/customer_id?}', [StrukController::class,'do'])
    ->middleware(['auth'])
    ->name('Do');

Route::get('/createdDb', [createdbController::class,'create'])
    ->middleware(['auth'])
    ->name('CreatedbPage');

Route::get('/createdDB/{dbname}', [createdbController::class, 'createdDB'])
    ->name('createdDB');


Route::get('/companyprofile', App\Livewire\CompanyProfiles::class)
    ->middleware(['auth'])
    ->name('companyProfile');

Route::get('/settings', App\Livewire\Settings::class)
    ->middleware(['auth'])
    ->name('settings');

Route::get('/downloadpdf', [downloadPdfController::class,'create'])
    ->middleware(['auth'])
    ->name('downloadPdf');


Route::get('/adminpage', App\Livewire\AdminPage::class)
    ->middleware(['auth'])
    ->name('adminPage');

Route::get('/debug-signature', function (Request $request) {
    return response()->json([
        'valid_signature' => URL::hasValidSignature($request),
        'valid_relative' => URL::hasValidSignature(
            $request,
            absolute: false
        ),
        'request_scheme' => $request->getScheme(),
        'request_host' => $request->getHost(),
        'app_url' => config('app.url'),
    ]);
});

Route::get('/test-query', function () {
    return response()->json([
        'url' => request()->fullUrl(),
        'query' => request()->query(),
        'query_string' => $_SERVER['QUERY_STRING'] ?? null,
        'request_uri' => $_SERVER['REQUEST_URI'] ?? null,
    ]);
});









require __DIR__.'/auth.php';
