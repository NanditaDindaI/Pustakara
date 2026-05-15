<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Denda
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('info'))
                <div class="mb-4 p-4 bg-blue-100 text-blue-700 rounded-lg">
                    {{ session('info') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6"
                    style="border-bottom: 1px solid #e5e7eb; padding-bottom: 12px;">
                    Informasi Denda
                </h1>

                <table class="w-full border border-gray-200 mb-6">
                    <tbody>

                        <tr>
                            <td class="p-3 border bg-gray-50 font-semibold"
                                style="width: 35%;">
                                Anggota
                            </td>

                            <td class="p-3 border">
                                {{ $denda->peminjaman->anggota->nama_lengkap ?? '-' }}
                            </td>
                        </tr>

                        <tr>
                            <td class="p-3 border bg-gray-50 font-semibold">
                                Buku
                            </td>

                            <td class="p-3 border">
                                {{ $denda->peminjaman->buku->judul ?? '-' }}
                            </td>
                        </tr>

                        <tr>
                            <td class="p-3 border bg-gray-50 font-semibold">
                                Tanggal Pinjam
                            </td>

                            <td class="p-3 border">
                                {{ \Carbon\Carbon::parse($denda->peminjaman->tanggal_pinjam)->format('d/m/Y') }}
                            </td>
                        </tr>

                        <tr>
                            <td class="p-3 border bg-gray-50 font-semibold">
                                Jatuh Tempo
                            </td>

                            <td class="p-3 border">
                                {{ \Carbon\Carbon::parse($denda->peminjaman->tanggal_jatuh_tempo)->format('d/m/Y') }}
                            </td>
                        </tr>

                        <tr>
                            <td class="p-3 border bg-gray-50 font-semibold">
                                Tanggal Dikembalikan
                            </td>

                            <td class="p-3 border">
                                {{ $denda->peminjaman->tanggal_kembali
                                    ? \Carbon\Carbon::parse($denda->peminjaman->tanggal_kembali)->format('d/m/Y')
                                    : '-' }}
                            </td>
                        </tr>

                        <tr>
                            <td class="p-3 border bg-gray-50 font-semibold">
                                Hari Terlambat
                            </td>

                            <td class="p-3 border"
                                style="color: #e74c3c; font-weight: bold;">
                                {{ $denda->jumlah_hari }} hari
                            </td>
                        </tr>

                        <tr>
                            <td class="p-3 border bg-gray-50 font-semibold">
                                Denda per Hari
                            </td>

                            <td class="p-3 border">
                                Rp {{ number_format($denda->nominal_per_hari, 0, ',', '.') }}
                            </td>
                        </tr>

                        <tr>
                            <td class="p-3 border bg-gray-50 font-semibold">
                                Total Denda
                            </td>

                            <td class="p-3 border"
                                style="color: #e74c3c; font-weight: bold; font-size: 16px;">
                                Rp {{ number_format($denda->total_denda, 0, ',', '.') }}
                            </td>
                        </tr>

                        <tr>
                            <td class="p-3 border bg-gray-50 font-semibold">
                                Status
                            </td>

                            <td class="p-3 border">
                                @if($denda->status_bayar === 'sudah_bayar')
                                    <span style="background-color: #d5f5e3; color: #27ae60; padding: 3px 10px; border-radius: 12px; font-size: 13px; font-weight: 600;">
                                        Sudah Bayar
                                    </span>
                                @else
                                    <span style="background-color: #fdecea; color: #e74c3c; padding: 3px 10px; border-radius: 12px; font-size: 13px; font-weight: 600;">
                                        Belum Bayar
                                    </span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td class="p-3 border bg-gray-50 font-semibold">
                                Tanggal Bayar
                            </td>

                            <td class="p-3 border">
                                {{ $denda->tanggal_bayar
                                    ? \Carbon\Carbon::parse($denda->tanggal_bayar)->format('d/m/Y')
                                    : '-' }}
                            </td>
                        </tr>

                    </tbody>
                </table>

                {{-- TOMBOL AKSI --}}
                <div style="display: flex; gap: 8px;">

                    @if($denda->status_bayar === 'belum_bayar')
                        <form action="{{ route('denda.update', $denda->id) }}"
                              method="POST"
                              style="display: inline;">

                            @csrf
                            @method('PATCH')

                            <button type="submit"
                                    onclick="return confirm('Tandai denda ini sudah dibayar?')"
                                    style="background-color: #27ae60; color: white; padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer;">
                                ✓ Tandai Sudah Bayar
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('denda.index') }}"
                       style="background-color: #7f8c8d; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                        ← Kembali
                    </a>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>