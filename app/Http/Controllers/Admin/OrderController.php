<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'product')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function update(Request $request, Order $order)
    {
        // 1. Validasi Input
        $request->validate([
            'status' => 'required|string|in:Menunggu Konfirmasi,Sedang Diproses,Selesai,Dibatalkan',
            'price' => 'nullable|integer|min:0',
        ]);

        // 2. Simpan status lama untuk pengecekan
        $oldStatus = $order->status;
        $newStatus = $request->status;

        // 3. LOGIKA PENGURANGAN STOK
        // Jika status berubah dari 'Menunggu Konfirmasi' ke 'Sedang Diproses'
        if ($oldStatus == 'Menunggu Konfirmasi' && $newStatus == 'Sedang Diproses') {
            $product = $order->product;

            // Cek stok tersedia
            if ($product && $product->stock > 0) {
                // Kurangi stok
                $product->decrement('stock');
            } else {
                // Jika stok habis, batalkan update dan beri pesan error
                return redirect()->back()->with('error', 'Gagal memproses pesanan. Stok produk habis!');
            }
        }

        // 4. Update data order
        $order->status = $newStatus;
        $order->price = $request->price ?? 0;
        $order->save();

        return redirect()->route('admin.orders.index')
                         ->with('success', 'Status pesanan diperbarui (Stok otomatis disesuaikan).');
    }
    
    public function show(Order $order)
    {
        return redirect()->route('admin.orders.index');
    }

    public function download(Order $order)
    {
        if (Storage::exists($order->file_path)) {
            return Storage::download($order->file_path);
        }
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}