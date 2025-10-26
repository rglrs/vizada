<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ambil ID acak dari User (yang BUKAN admin)
        $user = User::where('role', 'user')->inRandomOrder()->first();
        
        // Ambil ID acak dari Product
        $product = Product::inRandomOrder()->first();

        $statuses = ['Menunggu Konfirmasi', 'Sedang Diproses', 'Selesai', 'Dibatalkan'];

        return [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'title' => 'Pesanan ' . $product->name . ' untuk ' . $this->faker->company(),
            'details' => $this->faker->paragraph(2),
            'file_path' => 'public/desain/dummy_file.pdf', // Path palsu
            'status' => $statuses[array_rand($statuses)], // Ambil status acak
            
            // --- INI TAMBAHANNYA ---
            'price' => $this->faker->numberBetween(2, 50) * 10000, // Harga acak antara 20.000 - 500.000
            // ------------------------

            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'), // Waktu acak 3 bulan terakhir
            'updated_at' => now(),
        ];
    }
}