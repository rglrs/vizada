<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'product')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function update(Request $request, Order $order)
    {
        // TAMBAHKAN VALIDASI HARGA
        $request->validate([
            'status' => 'required|string|in:Menunggu Konfirmasi,Sedang Diproses,Selesai,Dibatalkan',
            'price' => 'nullable|integer|min:0', // <-- TAMBAHKAN INI
        ]);

        $order->status = $request->status;
        $order->price = $request->price ?? 0; // <-- TAMBAHKAN INI (Simpan harga, jika kosong isi 0)
        $order->save();

        return redirect()->route('admin.orders.index')
                         ->with('success', 'Status dan harga pesanan berhasil diperbarui.');
    }
    
    public function show(Order $order)
    {
        // Fungsi ini tidak dipakai (diganti modal), biarkan saja
        return redirect()->route('admin.orders.index');
    }

    /**
     * Menangani download file pesanan.
     */
    public function download(Order $order)
    {
        // Cek apakah file ada di 'gudang' (storage/app/public/...)
        if (Storage::exists($order->file_path)) {
            // Jika ada, paksa browser untuk download
            return Storage::download($order->file_path);
        }

        // Jika tidak ada, kembali dengan error
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}