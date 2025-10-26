<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada

class OrderController extends Controller
{
    /**
     * Menampilkan riwayat pesanan milik user yang sedang login.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id()) // Hanya ambil milik user ini
                        ->with('product') // Ambil relasi produk
                        ->latest() // Urutkan dari terbaru
                        ->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    /**
     * Menampilkan form untuk membuat pesanan baru.
     */
    public function create()
    {
        // Kita butuh daftar produk untuk ditampilkan di dropdown
        $products = Product::orderBy('name', 'asc')->get();
        return view('user.orders.create', compact('products'));
    }

    /**
     * Menyimpan pesanan baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'title' => 'required|string|max:255',
            'details' => 'required|string|max:5000',
            'file_desain' => 'required|file|mimes:jpg,jpeg,png,pdf,cdr,ai,psd,zip,rar|max:20480', // Maks 20MB
        ], [
            'file_desain.required' => 'Anda wajib meng-upload file desain.',
            'file_desain.mimes' => 'Format file harus: jpg, png, pdf, cdr, ai, psd, zip, atau rar.',
            'file_desain.max' => 'Ukuran file maksimal 20 MB.',
        ]);

        // 2. Simpan file yang di-upload
        $filePath = $request->file('file_desain')->store('public/desain');

        // 3. Simpan data pesanan ke database
        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'title' => $request->title,
            'details' => $request->details,
            'file_path' => $filePath, // Simpan path file
            'status' => 'Menunggu Konfirmasi', // Status default
            'price' => 0, // Harga awal selalu 0, diisi Admin
        ]);

        // 4. Redirect ke halaman riwayat pesanan dengan pesan sukses
        return redirect()->route('user.orders.index')
                         ->with('success', 'Pesanan Anda berhasil dibuat dan sedang menunggu konfirmasi admin.');
    }

    /**
     * Membatalkan (menghapus) pesanan.
     * FUNGSI BARU
     */
    public function destroy(Order $order)
    {
        // 1. Cek Kepemilikan (Authorization)
        // Pastikan user hanya bisa hapus order miliknya sendiri
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        // 2. Cek Status
        // Hanya bisa batal jika status 'Menunggu Konfirmasi'
        if ($order->status !== 'Menunggu Konfirmasi') {
            return redirect()->route('user.orders.index')
                             ->with('error', 'Pesanan ini tidak dapat dibatalkan karena sudah diproses.');
        }

        try {
            // 3. Hapus File Desain dari Storage
            if (Storage::exists($order->file_path)) {
                Storage::delete($order->file_path);
            }

            // 4. Hapus Pesanan dari Database
            $order->delete();

            return redirect()->route('user.orders.index')
                             ->with('success', 'Pesanan berhasil dibatalkan.');

        } catch (\Exception $e) {
            // Tangkap jika ada error
            return redirect()->route('user.orders.index')
                             ->with('error', 'Terjadi kesalahan saat membatalkan pesanan.');
        }
    }
}