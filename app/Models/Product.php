<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    // Tambahkan 'stock' agar bisa diisi (mass assignment)
    protected $fillable = ['name', 'description', 'stock'];

    // Relasi: Satu produk bisa ada di banyak order
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}