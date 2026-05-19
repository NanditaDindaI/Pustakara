<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-[#2d1b12]">
                📖 Data Peminjaman
            </h2>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f6f1eb] min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- SUCCESS --}}
            @if(session('success'))
                <div
                    class="mb-6 p-4 rounded-2xl bg-green-100 border border-green-200 text-green-700 shadow-sm">

                    {{ session('success') }}

                </div>
            @endif

            {{-- ERROR --}}
            @if(session('error'))
                <div
                    class="mb-6 p-4 rounded-2xl bg-red-100 border border-red-200 text-red-700 shadow-sm">

                    {{ session('error') }}

                </div>
            @endif

            {{-- CARD --}}
            <div class="bg-white rounded-3xl shadow-md border border-gray-100 p-8">

                {{-- HEADER --}}
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">

                    <div>

                        <h1 class="text-3xl font-bold text-[#2d1b12]">
                            Daftar Peminjaman
                        </h1>

                        <p class="text-gray-500 mt-1">
                            Kelola transaksi peminjaman buku perpustakaan.
                        </p>

                    </div>

                    {{-- BUTTON --}}
                    <a href="{{ route('peminjaman.create') }}"
                        class="px-5 py-3 bg-[#5a3422] hover:bg-[#3b2217] text-white rounded-2xl font-semibold shadow transition duration-300">

                        + Catat Peminjaman

                    </a>

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
                                    Anggota
                                </th>

                                <th class="px-6 py-4 font-semibold">
                                    Buku
                                </th>

                                <th class="px-6 py-4 font-semibold text-center">
                                    Tgl Pinjam
                                </th>

                                <th class="px-6 py-4 font-semibold text-center">
                                    Jatuh Tempo
                                </th>

                                <th class="px-6 py-4 font-semibold text-center">
                                    Tgl Kembali
                                </th>

                                <th class="px-6 py-4 font-semibold text-center">
                                    Status
                                </th>

                                <th class="px-6 py-4 font-semibold text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        {{-- BODY --}}
                        <tbody class="divide-y divide-gray-100">

                            @forelse($peminjaman as $item)

                                @php
                                    $telat =
                                        $item->status === 'dipinjam' &&
                                        \Carbon\Carbon::today()->gt($item->tanggal_jatuh_tempo);
                                @endphp

                                <tr
                                    class="hover:bg-orange-50 transition duration-200 {{ $telat ? 'bg-red-50' : '' }}">

                                    {{-- NO --}}
                                    <td class="px-6 py-5 text-gray-500 font-semibold">
                                        {{ $loop->iteration }}
                                    </td>

                                    {{-- ANGGOTA --}}
                                    <td class="px-6 py-5">

                                        <div class="font-semibold text-[#2d1b12]">
                                            {{ $item->anggota->nama_lengkap ?? '-' }}
                                        </div>

                                    </td>

                                    {{-- BUKU --}}
                                    <td class="px-6 py-5">

                                        <span
                                            class="inline-flex px-4 py-2 rounded-xl bg-orange-100 text-[#5a3422] font-semibold">

                                            {{ $item->buku->judul ?? '-' }}

                                        </span>

                                    </td>

                                    {{-- TGL PINJAM --}}
                                    <td class="px-6 py-5 text-center text-gray-600">

                                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}

                                    </td>

                                    {{-- JATUH TEMPO --}}
                                    <td class="px-6 py-5 text-center">

                                        <span
                                            class="{{ $telat ? 'text-red-600 font-bold' : 'text-gray-600' }}">

                                            {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}

                                        </span>

                                    </td>

                                    {{-- TGL KEMBALI --}}
                                    <td class="px-6 py-5 text-center text-gray-600">

                                        @if($item->tanggal_kembali)

                                            {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}

                                        @else

                                            -

                                        @endif

                                    </td>

                                    {{-- STATUS --}}
                                    <td class="px-6 py-5 text-center">

                                        @if($item->status === 'dipinjam' && $telat)

                                            <span
                                                class="px-4 py-2 rounded-xl bg-red-100 text-red-600 font-bold">

                                                Telat

                                            </span>

                                        @elseif($item->status === 'dipinjam')

                                            <span
                                                class="px-4 py-2 rounded-xl bg-yellow-100 text-yellow-700 font-bold">

                                                Dipinjam

                                            </span>

                                        @elseif($item->status === 'dikembalikan')

                                            <span
                                                class="px-4 py-2 rounded-xl bg-green-100 text-green-700 font-bold">

                                                Dikembalikan

                                            </span>

                                        @else

                                            <span
                                                class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 font-bold">

                                                {{ ucfirst($item->status) }}

                                            </span>

                                        @endif

                                    </td>

                                    {{-- AKSI --}}
                                    <td class="px-6 py-5">

                                        <div class="flex items-center justify-center gap-2 flex-wrap">

                                            {{-- DETAIL --}}
                                            <a href="{{ route('peminjaman.show', $item->id) }}"
                                                class="px-4 py-2 rounded-xl bg-blue-500 hover:bg-blue-600 text-white font-semibold transition">

                                                Detail

                                            </a>

                                            {{-- KEMBALIKAN --}}
                                            @if($item->status === 'dipinjam')

                                                <form action="{{ route('peminjaman.kembalikan', $item->id) }}"
                                                    method="POST">

                                                    @csrf

                                                    <button type="submit"
                                                        onclick="return confirm('Konfirmasi pengembalian buku ini?')"
                                                        class="px-4 py-2 rounded-xl bg-green-500 hover:bg-green-600 text-white font-semibold transition">

                                                        Kembalikan

                                                    </button>

                                                </form>

                                            @endif

                                            {{-- DELETE --}}
                                            <form action="{{ route('peminjaman.destroy', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data peminjaman ini?')">

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

                                        Belum ada data peminjaman.

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