<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Kategori
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">Form Tambah Kategori</h1>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-700 p-4 rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Nama Kategori</label>
                        <input type="text"
                               name="nama_kategori"
                               value="{{ old('nama_kategori') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm"
                               required>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-2">Deskripsi</label>
                        <textarea name="deskripsi"
                                  rows="4"
                                  class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div style="margin-top: 20px; display: flex; gap: 12px;">
                        <button type="submit"
                                style="background-color: #c0392b; color: white; padding: 10px 24px; border-radius: 8px; border: none; cursor: pointer; font-size: 16px;">
                            Simpan
                        </button>
                        <a href="{{ route('kategori.index') }}"
                           style="background-color: #7f8c8d; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-size: 16px;">
                            Kembali
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>