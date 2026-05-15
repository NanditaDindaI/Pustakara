<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Catat Peminjaman
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">Form Catat Peminjaman</h1>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-700 p-4 rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Anggota</label>
                        <select name="anggota_id" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                            <option value="">-- Pilih Anggota --</option>
                            @foreach($anggota as $ang)
                                <option value="{{ $ang->id }}"
                                    {{ old('anggota_id') == $ang->id ? 'selected' : '' }}>
                                    {{ $ang->nim }} - {{ $ang->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Buku</label>
                        <select name="buku_id" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                            <option value="">-- Pilih Buku --</option>
                            @foreach($buku as $b)
                                <option value="{{ $b->id }}"
                                    {{ old('buku_id') == $b->id ? 'selected' : '' }}>
                                    {{ $b->judul }} (Stok: {{ $b->stok_tersedia }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Jatuh Tempo</label>
                        <input type="text"
                               value="{{ \Carbon\Carbon::today()->addDays(7)->format('d/m/Y') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100"
                               disabled>
                        <p class="text-sm text-gray-400 mt-1">Otomatis 7 hari dari hari ini</p>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-2">Catatan <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <textarea name="catatan" rows="3"
                                  class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('catatan') }}</textarea>
                    </div>

                    <div style="margin-top: 20px; display: flex; gap: 12px;">
                        <button type="submit"
                                style="background-color: #c0392b; color: white; padding: 10px 24px; border-radius: 8px; border: none; cursor: pointer; font-size: 16px;">
                            Simpan
                        </button>
                        <a href="{{ route('peminjaman.index') }}"
                           style="background-color: #7f8c8d; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-size: 16px;">
                            Kembali
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>