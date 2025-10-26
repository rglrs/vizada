<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Import Controller Admin
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

// Import Controller User
use App\Http\Controllers\User\OrderController as UserOrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Halaman Awal (dari Breeze)
Route::get('/', function () {
    return view('welcome');
});

// Rute Dashboard (Cerdas)
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        // Jika Admin, lempar ke kelola pesanan
        return redirect()->route('admin.orders.index');
    }
    
    // Jika User biasa, lempar ke riwayat pesanan
    return redirect()->route('user.orders.index');

})->middleware(['auth', 'verified'])->name('dashboard');


// =================================================================
// RUTE KHUSUS ADMIN
// =================================================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');
    Route::get('orders/download/{order}', [AdminOrderController::class, 'download'])->name('orders.download');
});


// =================================================================
// RUTE KHUSUS CUSTOMER (USER)
// =================================================================
Route::middleware(['auth', 'verified'])->name('user.')->group(function () {
    // Halaman Riwayat Pesanan Saya
    Route::get('pesanan-saya', [UserOrderController::class, 'index'])->name('orders.index');
    
    // Halaman Form Buat Pesanan
    Route::get('buat-pesanan', [UserOrderController::class, 'create'])->name('orders.create');

    // Aksi Menyimpan Pesanan
    Route::post('buat-pesanan', [UserOrderController::class, 'store'])->name('orders.store');

    // --- TAMBAHAN BARU UNTUK BATAL PESANAN ---
    Route::delete('pesanan-saya/{order}', [UserOrderController::class, 'destroy'])->name('orders.destroy');
});


// =================================================================
// RUTE PROFIL & AUTENTIKASI (dari Breeze)
// =================================================================

// Rute Profil (dari Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute Auth (dari Breeze)
require __DIR__.'/auth.php';