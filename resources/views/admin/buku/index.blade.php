<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-[#2d1b12]">
                📚 Data Buku
            </h2>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f6f1eb] min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ALERT --}}
            @if(session('success'))
                <div
                    class="mb-6 p-4 rounded-2xl bg-green-100 border border-green-200 text-green-700 shadow-sm">

                    {{ session('success') }}

                </div>
            @endif

            {{-- CARD --}}
            <div class="bg-white rounded-3xl shadow-md border border-gray-100 p-8">

                {{-- HEADER --}}
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">

                    <div>

                        <h1 class="text-3xl font-bold text-[#2d1b12]">
                            Daftar Buku
                        </h1>

                        <p class="text-gray-500 mt-1">
                            Kelola koleksi buku perpustakaan Pustakara.
                        </p>

                    </div>

                    {{-- BUTTONS --}}
                    <div class="flex items-center gap-3">

                        {{-- TRASH --}}
                        <a href="{{ route('buku.trash') }}"
                            class="px-5 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-2xl font-semibold shadow transition duration-300">

                            🗑️ Trash

                        </a>

                        {{-- TAMBAH --}}
                        <a href="{{ route('buku.create') }}"
                            class="px-5 py-3 bg-[#5a3422] hover:bg-[#3b2217] text-white rounded-2xl font-semibold shadow transition duration-300">

                            + Tambah Buku

                        </a>

                    </div>

                </div>

                {{-- TABLE --}}
                <div class="overflow-x-auto rounded-2xl border border-gray-100">

                    <table class="w-full text-sm text-left">

                        {{-- HEAD --}}
                        <thead
                            class="bg-gradient-to-r from-[#3b2217] to-[#5a3422] text-white">

                            <tr>

                                <th class="px-6 py-4 font-semibold">
                                    No
                                </th>

                                <th class="px-6 py-4 font-semibold">
                                    Cover
                                </th>

                                <th class="px-6 py-4 font-semibold">
                                    Judul
                                </th>

                                <th class="px-6 py-4 font-semibold">
                                    Pengarang
                                </th>

                                <th class="px-6 py-4 font-semibold">
                                    Kategori
                                </th>

                                <th class="px-6 py-4 font-semibold text-center">
                                    Total
                                </th>

                                <th class="px-6 py-4 font-semibold text-center">
                                    Tersedia
                                </th>

                                <th class="px-6 py-4 font-semibold text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        {{-- BODY --}}
                        <tbody class="divide-y divide-gray-100">

                            @forelse($buku as $item)

                                <tr class="hover:bg-orange-50 transition duration-200">

                                    {{-- NO --}}
                                    <td class="px-6 py-5 text-gray-500 font-semibold">
                                        {{ $loop->iteration }}
                                    </td>

                                    {{-- COVER --}}
                                    <td class="px-6 py-5">

                                        @if($item->cover_image)

                                            <img src="{{ Storage::url($item->cover_image) }}"
                                                alt="Cover"
                                                class="h-20 w-14 object-cover rounded-xl shadow-md">

                                        @else

                                            <div
                                                class="h-20 w-14 rounded-xl bg-gray-100 flex items-center justify-center text-xs text-gray-400">

                                                No Image

                                            </div>

                                        @endif

                                    </td>

                                    {{-- JUDUL --}}
                                    <td class="px-6 py-5">

                                        <div class="font-semibold text-[#2d1b12]">
                                            {{ $item->judul }}
                                        </div>

                                    </td>

                                    {{-- PENGARANG --}}
                                    <td class="px-6 py-5 text-gray-600">

                                        {{ $item->pengarang }}

                                    </td>

                                    {{-- KATEGORI --}}
                                    <td class="px-6 py-5">

                                        <span
                                            class="inline-flex px-4 py-2 rounded-xl bg-orange-100 text-[#5a3422] font-semibold">

                                            {{ $item->kategori->nama_kategori ?? '-' }}

                                        </span>

                                    </td>

                                    {{-- STOK TOTAL --}}
                                    <td class="px-6 py-5 text-center font-semibold text-gray-700">

                                        {{ $item->stok_total }}

                                    </td>

                                    {{-- STOK TERSEDIA --}}
                                    <td class="px-6 py-5 text-center">

                                        @if($item->stok_tersedia > 0)

                                            <span
                                                class="px-4 py-2 rounded-xl bg-green-100 text-green-700 font-bold">

                                                {{ $item->stok_tersedia }}

                                            </span>

                                        @else

                                            <span
                                                class="px-4 py-2 rounded-xl bg-red-100 text-red-600 font-bold">

                                                Habis

                                            </span>

                                        @endif

                                    </td>

                                    {{-- AKSI --}}
                                    <td class="px-6 py-5">

                                        <div class="flex items-center justify-center gap-2">

                                            {{-- DETAIL --}}
                                            <a href="{{ route('buku.show', $item->id) }}"
                                                class="px-4 py-2 rounded-xl bg-blue-500 hover:bg-blue-600 text-white font-semibold transition">

                                                Detail

                                            </a>

                                            {{-- EDIT --}}
                                            <a href="{{ route('buku.edit', $item->id) }}"
                                                class="px-4 py-2 rounded-xl bg-amber-400 hover:bg-amber-500 text-white font-semibold transition">

                                                Edit

                                            </a>

                                            {{-- DELETE --}}
                                            <form action="{{ route('buku.destroy', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus buku ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="px-4 py-2 rounded-xl bg-red-500 hover:bg-red-600 text-white font-semibold transition">

                                                    Hapus

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="8"
                                        class="px-6 py-10 text-center text-gray-500">

                                        Belum ada data buku.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>