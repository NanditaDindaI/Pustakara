<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-[#2d1b12]">
                📚 Data Kategori
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
                <div class="flex items-center justify-between mb-8">

                    <div>

                        <h1 class="text-3xl font-bold text-[#2d1b12]">
                            Daftar Kategori
                        </h1>

                        <p class="text-gray-500 mt-1">
                            Kelola kategori buku perpustakaan Pustakara.
                        </p>

                    </div>

                    {{-- BUTTON --}}
                    <a href="{{ route('kategori.create') }}"
                        class="px-5 py-3 bg-[#5a3422] hover:bg-[#3b2217] text-white rounded-2xl font-semibold shadow transition duration-300">

                        + Tambah Kategori

                    </a>

                </div>

                {{-- TABLE --}}
                <div class="overflow-x-auto rounded-2xl border border-gray-100">

                    <table class="w-full text-sm text-left">

                        {{-- TABLE HEAD --}}
                        <thead
                            class="bg-gradient-to-r from-[#3b2217] to-[#5a3422] text-white">

                            <tr>

                                <th class="px-6 py-4 font-semibold w-20">
                                    No
                                </th>

                                <th class="px-6 py-4 font-semibold">
                                    Nama Kategori
                                </th>

                                <th class="px-6 py-4 font-semibold">
                                    Deskripsi
                                </th>

                                <th class="px-6 py-4 font-semibold text-center w-48">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        {{-- TABLE BODY --}}
                        <tbody class="divide-y divide-gray-100">

                            @forelse($kategori as $item)

                                <tr class="hover:bg-orange-50 transition duration-200">

                                    {{-- NO --}}
                                    <td class="px-6 py-5 text-gray-500 font-semibold">
                                        {{ $loop->iteration }}
                                    </td>

                                    {{-- NAMA --}}
                                    <td class="px-6 py-5">

                                        <div
                                            class="inline-flex px-4 py-2 rounded-xl bg-orange-100 text-[#5a3422] font-semibold">

                                            {{ $item->nama_kategori }}

                                        </div>

                                    </td>

                                    {{-- DESKRIPSI --}}
                                    <td class="px-6 py-5 text-gray-600 leading-relaxed">

                                        {{ \Illuminate\Support\Str::limit($item->deskripsi, 120) }}

                                    </td>

                                    {{-- AKSI --}}
                                    <td class="px-6 py-5">

                                        <div class="flex items-center justify-center gap-3">

                                            {{-- EDIT --}}
                                            <a href="{{ route('kategori.edit', $item->id) }}"
                                                class="px-4 py-2 rounded-xl bg-amber-400 hover:bg-amber-500 text-white font-semibold transition">

                                                Edit

                                            </a>

                                            {{-- DELETE --}}
                                            <form action="{{ route('kategori.destroy', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

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

                                    <td colspan="4"
                                        class="px-6 py-10 text-center text-gray-500">

                                        Belum ada data kategori.

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