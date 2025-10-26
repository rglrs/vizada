<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pesanan: ') . $order->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded shadow-sm sm:rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-4">Informasi Pesanan</h3>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Pelanggan</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $order->user->name }} ({{ $order->user->email }})</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Produk</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $order->product->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Tanggal Pesan</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $order->created_at->format('d M Y, H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Detail / Catatan</dt>
                                <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $order->details }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">File Desain</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <x-primary-button tag="a" :href="Storage::url($order->file_path)" target="_blank">
                                        Download File
                                    </x-primary-button>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="md:col-span-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-4">Update Status</h3>
                        
                        <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div>
                                <x-input-label for="status" :value="__('Status Saat Ini: ') . $order->status" />
                                <select id="status" name="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="Menunggu Konfirmasi" {{ $order->status == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                    <option value="Sedang Diproses" {{ $order->status == 'Sedang Diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                    <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Dibatalkan" {{ $order->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-primary-button type="submit" class="w-full justify-center">
                                    Update Status
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>