<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Buku
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">Form Edit Buku</h1>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-700 p-4 rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Kategori</label>
                        <select name="kategori_id" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}"
                                    {{ old('kategori_id', $buku->kategori_id) == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Judul Buku</label>
                        <input type="text" name="judul"
                               value="{{ old('judul', $buku->judul) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Pengarang</label>
                        <input type="text" name="pengarang"
                               value="{{ old('pengarang', $buku->pengarang) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Penerbit</label>
                        <input type="text" name="penerbit"
                               value="{{ old('penerbit', $buku->penerbit) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit"
                               value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                               min="1900" max="{{ date('Y') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">ISBN <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="isbn"
                               value="{{ old('isbn', $buku->isbn) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Stok Total</label>
                        <input type="number" name="stok_total"
                               value="{{ old('stok_total', $buku->stok_total) }}"
                               min="1"
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                        <p class="text-sm text-gray-500 mt-1">Stok tersedia saat ini: <strong>{{ $buku->stok_tersedia }}</strong></p>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Deskripsi <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <textarea name="deskripsi" rows="4"
                                  class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-2">Cover Buku</label>
                        @if($buku->cover_image)
                            <img src="{{ Storage::url($buku->cover_image) }}"
                                 alt="Cover saat ini"
                                 class="h-24 w-16 object-cover rounded mb-2">
                            <p class="text-sm text-gray-500 mb-2">Upload baru untuk mengganti cover</p>
                        @endif
                        <input type="file" name="cover_image"
                               accept="image/*"
                               class="w-full border-gray-300 rounded-lg shadow-sm">
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg">
                            Update
                        </button>
                        <a href="{{ route('buku.index') }}"
                           class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-lg">
                            Kembali
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>