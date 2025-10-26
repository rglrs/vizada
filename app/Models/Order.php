<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    use HasFactory;

    // Izinkan kolom ini diisi oleh Customer/Admin
    protected $fillable = [
        'user_id',
        'product_id',
        'title',
        'details',
        'file_path',
        'status',
        'price', // <-- 1. TAMBAHKAN INI
    ];

    // Sertakan 'download_url' dan 'price' saat model diubah ke JSON (untuk modal Alpine.js)
    protected $appends = ['download_url']; // <-- 2. TAMBAHKAN 'price'

    // Relasi: Satu order dimiliki oleh satu User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Satu order merujuk ke satu Product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Accessor: Membuat atribut 'download_url' secara dinamis
    protected function downloadUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::url($this->file_path)
        );
    }
}