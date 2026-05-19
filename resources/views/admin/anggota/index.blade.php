<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-[#2d1b12]">
                👥 Data Anggota
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
                            Daftar Anggota
                        </h1>

                        <p class="text-gray-500 mt-1">
                            Kelola data anggota perpustakaan Pustakara.
                        </p>

                    </div>

                    {{-- BUTTON --}}
                    <div class="flex items-center gap-3">

                        {{-- TRASH --}}
                        <a href="{{ route('anggota-admin.trash') }}"
                            class="px-5 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-2xl font-semibold shadow transition duration-300">

                            🗑 Trash

                        </a>

                        {{-- TAMBAH --}}
                        <a href="{{ route('anggota-admin.create') }}"
                            class="px-5 py-3 bg-[#5a3422] hover:bg-[#3b2217] text-white rounded-2xl font-semibold shadow transition duration-300">

                            + Tambah Anggota

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
                                    NIM
                                </th>

                                <th class="px-6 py-4 font-semibold">
                                    Nama Lengkap
                                </th>

                                <th class="px-6 py-4 font-semibold">
                                    Email
                                </th>

                                <th class="px-6 py-4 font-semibold">
                                    Telepon
                                </th>

                                <th class="px-6 py-4 font-semibold text-center">
                                    Status
                                </th>

                                <th class="px-6 py-4 font-semibold text-center">
                                    Tgl Daftar
                                </th>

                                <th class="px-6 py-4 font-semibold text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        {{-- BODY --}}
                        <tbody class="divide-y divide-gray-100">

                            @forelse($anggota as $item)

                                <tr class="hover:bg-orange-50 transition duration-200">

                                    {{-- NO --}}
                                    <td class="px-6 py-5 text-gray-500 font-semibold">
                                        {{ $loop->iteration }}
                                    </td>

                                    {{-- NIM --}}
                                    <td class="px-6 py-5">

                                        <span
                                            class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 font-semibold">

                                            {{ $item->nim }}

                                        </span>

                                    </td>

                                    {{-- NAMA --}}
                                    <td class="px-6 py-5">

                                        <div class="font-semibold text-[#2d1b12]">
                                            {{ $item->nama_lengkap }}
                                        </div>

                                    </td>

                                    {{-- EMAIL --}}
                                    <td class="px-6 py-5 text-gray-600">

                                        {{ $item->email }}

                                    </td>

                                    {{-- TELEPON --}}
                                    <td class="px-6 py-5 text-gray-600">

                                        {{ $item->telepon ?? '-' }}

                                    </td>

                                    {{-- STATUS --}}
                                    <td class="px-6 py-5 text-center">

                                        @if($item->status === 'aktif')

                                            <span
                                                class="px-4 py-2 rounded-xl bg-green-100 text-green-700 font-bold">

                                                Aktif

                                            </span>

                                        @else

                                            <span
                                                class="px-4 py-2 rounded-xl bg-red-100 text-red-600 font-bold">

                                                Nonaktif

                                            </span>

                                        @endif

                                    </td>

                                    {{-- TANGGAL --}}
                                    <td class="px-6 py-5 text-center text-gray-600">

                                        {{ \Carbon\Carbon::parse($item->tanggal_daftar)->format('d M Y') }}

                                    </td>

                                    {{-- AKSI --}}
                                    <td class="px-6 py-5">

                                        <div class="flex items-center justify-center gap-2">

                                            {{-- DETAIL --}}
                                            <a href="{{ route('anggota-admin.show', $item->id) }}"
                                                class="px-4 py-2 rounded-xl bg-blue-500 hover:bg-blue-600 text-white font-semibold transition">

                                                Detail

                                            </a>

                                            {{-- EDIT --}}
                                            <a href="{{ route('anggota-admin.edit', $item->id) }}"
                                                class="px-4 py-2 rounded-xl bg-amber-400 hover:bg-amber-500 text-white font-semibold transition">

                                                Edit

                                            </a>

                                            {{-- DELETE --}}
                                            <form action="{{ route('anggota-admin.destroy', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin hapus anggota ini? Akun login juga akan terhapus.')">

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

                                        Belum ada data anggota.

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