<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Pesanan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('user.orders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="product_id" :value="__('Pilih Produk/Layanan')" />
                            <select id="product_id" name="product_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="" disabled selected>-- Pilih salah satu --</option>
                                @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="title" :value="__('Judul Pesanan')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required placeholder="Misal: Banner untuk Warung Makan" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="details" :value="__('Detail & Spesifikasi')" />
                            <textarea id="details" name="details" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required placeholder="Misal: Ukuran 2x1 meter, bahan Flexi, finishing mata ayam 4 sudut.">{{ old('details') }}</textarea>
                            <x-input-error :messages="$errors->get('details')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="file_desain" :value="__('Upload File Desain (Max 20MB)')" />
                            <input id="file_desain" name="file_desain" type="file" class="block mt-1 w-full" required>
                            <div class="mt-1 text-sm text-gray-600">Format: PDF, JPG, PNG, CDR, AI, PSD, ZIP, RAR</div>
                            <x-input-error :messages="$errors->get('file_desain')" class="mt-2" />
                        </div>


                        <div class="flex items-center justify-end mt-6">
                            <x-secondary-button tag="a" :href="route('user.orders.index')">Batal</x-secondary-button>
                            <x-primary-button class="ms-4">
                                {{ __('Kirim Pesanan') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>