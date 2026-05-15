<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Buku
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">Form Tambah Buku</h1>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-700 p-4 rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Kategori</label>
                        <select name="kategori_id" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}"
                                    {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Judul Buku</label>
                        <input type="text" name="judul"
                               value="{{ old('judul') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Pengarang</label>
                        <input type="text" name="pengarang"
                               value="{{ old('pengarang') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Penerbit</label>
                        <input type="text" name="penerbit"
                               value="{{ old('penerbit') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit"
                               value="{{ old('tahun_terbit') }}"
                               min="1900" max="{{ date('Y') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">ISBN <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="isbn"
                               value="{{ old('isbn') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Stok Total</label>
                        <input type="number" name="stok_total"
                               value="{{ old('stok_total') }}"
                               min="1"
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Deskripsi <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <textarea name="deskripsi" rows="4"
                                  class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-2">Cover Buku <span class="text-gray-400 font-normal">(opsional, maks 2MB)</span></label>
                        <input type="file" name="cover_image"
                               accept="image/*"
                               class="w-full border-gray-300 rounded-lg shadow-sm">
                    </div>

                    <div style="margin-top: 20px; display: flex; gap: 12px;">
                        <button type="submit"
                                style="background-color: #c0392b; color: white; padding: 10px 24px; border-radius: 8px; border: none; cursor: pointer; font-size: 16px;">
                            Simpan
                        </button>
                        <a href="{{ route('buku.index') }}"
                           style="background-color: #7f8c8d; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-size: 16px;">
                            Kembali
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>