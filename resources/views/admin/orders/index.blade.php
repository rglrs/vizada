<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Pesanan Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ open: false, selectedOrder: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded shadow-sm sm:rounded-lg">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded shadow-sm sm:rounded-lg">
                {{ session('error') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Pesanan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Aksi</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($orders as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $order->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $order->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $order->product->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if ($order->status == 'Menunggu Konfirmasi') bg-yellow-100 text-yellow-800
                                                @elseif ($order->status == 'Sedang Diproses') bg-blue-100 text-blue-800
                                                @elseif ($order->status == 'Selesai') bg-green-100 text-green-800
                                                @else bg-red-100 text-red-800 @endif">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <x-primary-button
                                            type="button"
                                            @click="selectedOrder = {{ $order->toJson() }}; open = true">
                                            Lihat Detail
                                        </x-primary-button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                        Belum ada pesanan masuk.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>

                </div>
            </div>
        </div>

        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4"
            style="display: none;">

            <div @click="open = false" class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>

            <div
                x-show="open"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
                class="relative w-full max-w-2xl bg-white rounded-lg shadow-xl"
                @click.outside="open = false">

                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-900" x-text="'Detail Pesanan: ' + (selectedOrder ? selectedOrder.title : '')">
                        Detail Pesanan
                    </h3>
                    <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div x-if="selectedOrder">
                    <form :action="'/admin/orders/' + selectedOrder.id" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <dl class="space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Pelanggan</dt>
                                    <dd class="mt-1 text-sm text-gray-900" x-text="selectedOrder.user.name + ' (' + selectedOrder.user.email + ')'"></dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Produk</dt>
                                    <dd class="mt-1 text-sm text-gray-900" x-text="selectedOrder.product.name"></dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Detail / Catatan</dt>
                                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line" x-text="selectedOrder.details"></dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">File Desain</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <a x-bind:href="'/admin/orders/download/' + selectedOrder.id"
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Download File
                                        </a>
                                    </dd>
                                </div>
                            </dl>

                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="price" value="Harga (Rp)" />
                                    <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" x-bind:value="selectedOrder.price" placeholder="0" />
                                </div>

                                <div>
                                    <x-input-label for="status" value="Ubah Status" />
                                    <select id="status" name="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        
                                        <option value="Menunggu Konfirmasi" 
                                                x-show="selectedOrder.status == 'Menunggu Konfirmasi'"
                                                x-bind:selected="selectedOrder.status == 'Menunggu Konfirmasi'">
                                            Menunggu Konfirmasi
                                        </option>

                                        <option value="Sedang Diproses" 
                                                x-show="['Menunggu Konfirmasi', 'Sedang Diproses'].includes(selectedOrder.status)"
                                                x-bind:selected="selectedOrder.status == 'Sedang Diproses'">
                                            Sedang Diproses
                                        </option>

                                        <option value="Selesai" 
                                                x-show="selectedOrder.status != 'Dibatalkan' && selectedOrder.status != 'Menunggu Konfirmasi'"
                                                x-bind:selected="selectedOrder.status == 'Selesai'">
                                            Selesai
                                        </option>

                                        <option value="Dibatalkan" 
                                                x-show="selectedOrder.status != 'Selesai'"
                                                x-bind:selected="selectedOrder.status == 'Dibatalkan'">
                                            Dibatalkan
                                        </option>
                                    </select>
                                    <p class="text-xs text-gray-500 mt-1" x-show="selectedOrder.status == 'Sedang Diproses'">
                                        *Mengubah ke 'Selesai' akan menutup pesanan.
                                    </p>
                                    <p class="text-xs text-blue-500 mt-1" x-show="selectedOrder.status == 'Menunggu Konfirmasi'">
                                        *Mengubah ke 'Sedang Diproses' akan mengurangi stok otomatis.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end p-4 bg-gray-50 border-t rounded-b-lg">
                            <x-secondary-button @click="open = false" type="button">Tutup</x-secondary-button>
                            <x-primary-button class="ms-3" type="submit">Update Data</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>