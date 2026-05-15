<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Buku
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">Detail Buku</h1>

                <div class="flex gap-6 mb-6">
                    @if($buku->cover_image)
                        <img src="{{ Storage::url($buku->cover_image) }}"
                             alt="Cover"
                             class="h-40 w-28 object-cover rounded shadow">
                    @else
                        <div class="h-40 w-28 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-sm">
                            No Cover
                        </div>
                    @endif

                    <div class="flex-1">
                        <table class="w-full">
                            <tr class="border-b">
                                <td class="py-2 font-medium text-gray-600 w-36">Judul</td>
                                <td class="py-2">{{ $buku->judul }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium text-gray-600">Pengarang</td>
                                <td class="py-2">{{ $buku->pengarang }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium text-gray-600">Penerbit</td>
                                <td class="py-2">{{ $buku->penerbit }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium text-gray-600">Tahun Terbit</td>
                                <td class="py-2">{{ $buku->tahun_terbit }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium text-gray-600">ISBN</td>
                                <td class="py-2">{{ $buku->isbn ?? '-' }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium text-gray-600">Kategori</td>
                                <td class="py-2">{{ $buku->kategori->nama_kategori ?? '-' }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium text-gray-600">Stok Total</td>
                                <td class="py-2">{{ $buku->stok_total }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium text-gray-600">Stok Tersedia</td>
                                <td class="py-2">
                                    <span class="{{ $buku->stok_tersedia > 0 ? 'text-green-600' : 'text-red-500' }} font-semibold">
                                        {{ $buku->stok_tersedia }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($buku->deskripsi)
                    <div class="mb-6">
                        <h2 class="font-medium text-gray-600 mb-2">Deskripsi</h2>
                        <p class="text-gray-800">{{ $buku->deskripsi }}</p>
                    </div>
                @endif

                <div class="flex gap-3">
                    <a href="{{ route('buku.edit', $buku->id) }}"
                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-5 py-2 rounded-lg">
                        Edit
                    </a>
                    <a href="{{ route('buku.index') }}"
                       class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-lg">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>