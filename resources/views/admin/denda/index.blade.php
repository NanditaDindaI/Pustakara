<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-[#2d1b12]">
                💰 Data Denda
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

            {{-- WARNING --}}
            @if(session('warning'))
                <div
                    class="mb-6 p-4 rounded-2xl bg-yellow-100 border border-yellow-200 text-yellow-700 shadow-sm">

                    {{ session('warning') }}

                </div>
            @endif

            {{-- INFO --}}
            @if(session('info'))
                <div
                    class="mb-6 p-4 rounded-2xl bg-blue-100 border border-blue-200 text-blue-700 shadow-sm">

                    {{ session('info') }}

                </div>
            @endif

            {{-- SUMMARY --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                {{-- BELUM BAYAR --}}
                <div
                    class="bg-white rounded-3xl shadow-md border border-red-100 p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500 mb-2">
                                Total Belum Bayar
                            </p>

                            <h3 class="text-3xl font-bold text-red-600">
                                Rp {{ number_format($totalBelumBayar, 0, ',', '.') }}
                            </h3>

                        </div>

                        <div
                            class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center text-3xl">

                            ⚠️

                        </div>

                    </div>

                </div>

                {{-- SUDAH BAYAR --}}
                <div
                    class="bg-white rounded-3xl shadow-md border border-green-100 p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500 mb-2">
                                Total Sudah Bayar
                            </p>

                            <h3 class="text-3xl font-bold text-green-600">
                                Rp {{ number_format($totalSudahBayar, 0, ',', '.') }}
                            </h3>

                        </div>

                        <div
                            class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center text-3xl">

                            💵

                        </div>

                    </div>

                </div>

            </div>

            {{-- MAIN CARD --}}
            <div class="bg-white rounded-3xl shadow-md border border-gray-100 p-8">

                {{-- HEADER --}}
                <div class="mb-8">

                    <h1 class="text-3xl font-bold text-[#2d1b12]">
                        Daftar Denda
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Pantau seluruh riwayat denda keterlambatan anggota.
                    </p>

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
                                    Hari Terlambat
                                </th>

                                <th class="px-6 py-4 font-semibold text-center">
                                    Denda/Hari
                                </th>

                                <th class="px-6 py-4 font-semibold text-center">
                                    Total Denda
                                </th>

                                <th class="px-6 py-4 font-semibold text-center">
                                    Status
                                </th>

                                <th class="px-6 py-4 font-semibold text-center">
                                    Tgl Bayar
                                </th>

                                <th class="px-6 py-4 font-semibold text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        {{-- BODY --}}
                        <tbody class="divide-y divide-gray-100">

                            @forelse($dendas as $denda)

                                <tr class="hover:bg-orange-50 transition duration-200">

                                    {{-- NO --}}
                                    <td class="px-6 py-5 text-gray-500 font-semibold">
                                        {{ $loop->iteration }}
                                    </td>

                                    {{-- ANGGOTA --}}
                                    <td class="px-6 py-5">

                                        <div class="font-semibold text-[#2d1b12]">
                                            {{ $denda->peminjaman->anggota->nama_lengkap ?? '-' }}
                                        </div>

                                    </td>

                                    {{-- BUKU --}}
                                    <td class="px-6 py-5">

                                        <span
                                            class="inline-flex px-4 py-2 rounded-xl bg-orange-100 text-[#5a3422] font-semibold">

                                            {{ $denda->peminjaman->buku->judul ?? '-' }}

                                        </span>

                                    </td>

                                    {{-- HARI --}}
                                    <td class="px-6 py-5 text-center text-gray-700 font-semibold">

                                        {{ $denda->jumlah_hari }} hari

                                    </td>

                                    {{-- DENDA/HARI --}}
                                    <td class="px-6 py-5 text-center text-gray-600">

                                        Rp {{ number_format($denda->nominal_per_hari, 0, ',', '.') }}

                                    </td>

                                    {{-- TOTAL --}}
                                    <td class="px-6 py-5 text-center">

                                        <span
                                            class="px-4 py-2 rounded-xl bg-red-100 text-red-600 font-bold">

                                            Rp {{ number_format($denda->total_denda, 0, ',', '.') }}

                                        </span>

                                    </td>

                                    {{-- STATUS --}}
                                    <td class="px-6 py-5 text-center">

                                        @if($denda->status_bayar === 'sudah_bayar')

                                            <span
                                                class="px-4 py-2 rounded-xl bg-green-100 text-green-700 font-bold">

                                                Sudah Bayar

                                            </span>

                                        @else

                                            <span
                                                class="px-4 py-2 rounded-xl bg-red-100 text-red-600 font-bold">

                                                Belum Bayar

                                            </span>

                                        @endif

                                    </td>

                                    {{-- TANGGAL --}}
                                    <td class="px-6 py-5 text-center text-gray-600">

                                        @if($denda->tanggal_bayar)

                                            {{ \Carbon\Carbon::parse($denda->tanggal_bayar)->format('d M Y') }}

                                        @else

                                            -

                                        @endif

                                    </td>

                                    {{-- AKSI --}}
                                    <td class="px-6 py-5">

                                        <div class="flex items-center justify-center gap-2 flex-wrap">

                                            {{-- DETAIL --}}
                                            <a href="{{ route('denda.show', $denda->id) }}"
                                                class="px-4 py-2 rounded-xl bg-blue-500 hover:bg-blue-600 text-white font-semibold transition">

                                                Detail

                                            </a>

                                            {{-- BAYAR --}}
                                            @if($denda->status_bayar === 'belum_bayar')

                                                <form action="{{ route('denda.update', $denda->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit"
                                                        onclick="return confirm('Tandai denda ini sudah dibayar?')"
                                                        class="px-4 py-2 rounded-xl bg-green-500 hover:bg-green-600 text-white font-semibold transition">

                                                        Tandai Bayar

                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="9"
                                        class="px-6 py-10 text-center text-gray-500">

                                        Belum ada data denda.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- PAGINATION --}}
                <div class="mt-6">

                    {{ $dendas->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>