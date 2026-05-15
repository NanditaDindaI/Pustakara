<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kategori
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">
                    Form Edit Kategori
                </h1>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-700 p-4 rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kategori.update', $kategori->id) }}"
                      method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Nama Kategori
                        </label>

                        <input type="text"
                               name="nama_kategori"
                               value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm"
                               required>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-2">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi"
                                  rows="4"
                                  class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg">
                            Update
                        </button>

                        <a href="{{ route('kategori.index') }}"
                           class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-lg">
                            Kembali
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>