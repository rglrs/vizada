<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Percetakan Vizada - Cepat & Berkualitas</title>
        
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="bg-gray-50 text-black/50">
            <div class="relative min-h-screen flex flex-col selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-screen-xl mx-auto px-6 lg:px-8">
                    
                    <header class="flex items-center justify-between py-10">
                        <div class="flex items-center">
                            <svg class="h-10 w-auto text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5l3 2.25-3 2.25m3 0l3 2.25-3 2.25m3-11.25l3 2.25-3 2.25m3 0l3 2.25-3 2.25M6.75 7.5h.008v.008H6.75V7.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <span class="ml-3 text-2xl font-semibold text-gray-900">Percetakan Vizada</span>
                        </div>
                        
                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                        Login
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </header>

                    <main class="mt-10">
                        <div class="text-center py-16">
                            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                                Selamat Datang di Percetakan Vizada
                            </h1>
                            <p class="mt-6 text-lg leading-8 text-gray-600">
                                Solusi cetak cepat, murah, dan berkualitas untuk semua kebutuhan Anda.
                            </p>
                            <div class="mt-10 flex items-center justify-center gap-x-6">
                                <a href="{{ route('register') }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    Daftar Sekarang
                                </a>
                                <a href="#layanan" class="text-sm font-semibold leading-6 text-gray-900">
                                    Lihat Layanan <span aria-hidden="true">→</span>
                                </a>
                            </div>
                        </div>

                        <div class="mt-20 py-16 sm:py-24 bg-white shadow-sm rounded-lg">
                            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                                <div class="mx-auto max-w-2xl lg:text-center">
                                    <h2 class="text-base font-semibold leading-7 text-indigo-600">Alur Pemesanan</h2>
                                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                                        Cara Mudah Memesan di Vizada
                                    </p>
                                    <p class="mt-6 text-lg leading-8 text-gray-600">
                                        Kami menggunakan sistem berbasis akun untuk melacak semua pesanan dan file desain Anda agar tetap aman dan terorganisir.
                                    </p>
                                </div>
                                <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
                                    <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                                        
                                        <div class="relative ps-16">
                                            <dt class="text-base font-semibold leading-7 text-gray-900">
                                                <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                                    <span class="font-bold text-white">1</span>
                                                </div>
                                                Buat Akun Anda
                                            </dt>
                                            <dd class="mt-2 text-base leading-7 text-gray-600">
                                                Untuk memulai pemesanan, Anda <strong>wajib mendaftar akun</strong> terlebih dahulu. Klik tombol "Register" di pojok kanan atas.
                                            </dd>
                                        </div>

                                        <div class="relative ps-16">
                                            <dt class="text-base font-semibold leading-7 text-gray-900">
                                                <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                                    <span class="font-bold text-white">2</span>
                                                </div>
                                                Login ke Dashboard
                                            </dt>
                                            <dd class="mt-2 text-base leading-7 text-gray-600">
                                                Setelah mendaftar, silakan "Login" untuk masuk ke dashboard pribadi Anda.
                                            </dd>
                                        </div>

                                        <div class="relative ps-16">
                                            <dt class="text-base font-semibold leading-7 text-gray-900">
                                                <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                                    <span class="font-bold text-white">3</span>
                                                </div>
                                                Buat Pesanan Baru
                                            </dt>
                                            <dd class="mt-2 text-base leading-7 text-gray-600">
                                                Di dalam dashboard, Anda akan menemukan tombol "Buat Pesanan Baru". Isi form dan upload file desain Anda.
                                            </dd>
                                        </div>

                                        <div class="relative ps-16">
                                            <dt class="text-base font-semibold leading-7 text-gray-900">
                                                <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                                    <span class="font-bold text-white">4</span>
                                                </div>
                                                Konfirmasi & Pembayaran
                                            </dt>
                                            <dd class="mt-2 text-base leading-7 text-gray-600">
                                                Admin kami akan me-review pesanan Anda, menetapkan harga, dan mengubah status. Anda bisa membayar secara tunai (cash) saat mengambil pesanan.
                                            </dd>
                                        </div>

                                    </dl>
                                </div>
                            </div>
                        </div>

                        <div id="layanan" class="mt-20 py-16 sm:py-24">
                            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                                <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Layanan Kami</h2>
                                <p class="text-center mt-4 text-lg text-gray-600">Kami melayani berbagai kebutuhan cetak, di antaranya:</p>
                                
                                <div class="mt-16 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                                    <div class="flex flex-col items-center p-8 bg-white shadow-sm rounded-lg border border-gray-100">
                                        <h3 class="text-xl font-semibold text-gray-900">Cetak Stiker</h3>
                                        <p class="mt-2 text-base text-gray-600 text-center">Stiker vinyl, bontaq, transparan, dan label kustom untuk produk Anda. Tahan air dan berkualitas tinggi.</p>
                                    </div>
                                    <div class="flex flex-col items-center p-8 bg-white shadow-sm rounded-lg border border-gray-100">
                                        <h3 class="text-xl font-semibold text-gray-900">Banner & Spanduk</h3>
                                        <p class="mt-2 text-base text-gray-600 text-center">Cetak banner, spanduk, X-Banner, dan Roll Banner dengan bahan Flexi berkualitas untuk promosi outdoor & indoor.</p>
                                    </div>
                                    <div class="flex flex-col items-center p-8 bg-white shadow-sm rounded-lg border border-gray-100">
                                        <h3 class="text-xl font-semibold text-gray-900">Kartu Nama & Brosur</h3>
                                        <p class="mt-2 text-base text-gray-600 text-center">Cetak kartu nama, brosur, poster, dan ID Card dengan berbagai pilihan bahan kertas dan finishing.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </main>

                    <footer class="py-16 text-center text-sm text-black/50">
                        © 2025 Percetakan Vizada. All rights reserved.
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>