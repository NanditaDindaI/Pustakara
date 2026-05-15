<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Peminjaman
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">{{ session('success') }}</div>
            @endif

            {{-- Info Denda --}}
            @if($totalDendaBelumBayar > 0)
                <div class="mb-4 p-4 rounded-lg" style="background-color: #fdecea; color: #e74c3c;">
                    ⚠️ Kamu memiliki denda belum bayar sebesar
                    <strong>Rp {{ number_format($totalDendaBelumBayar, 0, ',', '.') }}</strong>.
                    Segera hubungi admin perpustakaan.
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-4">Riwayat Peminjaman</h1>

                <table class="w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border">No</th>
                            <th class="p-3 border">Buku</th>
                            <th class="p-3 border">Tgl Pinjam</th>
                            <th class="p-3 border">Jatuh Tempo</th>
                            <th class="p-3 border">Tgl Kembali</th>
                            <th class="p-3 border">Status</th>
                            <th class="p-3 border">Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjaman as $item)
                            <tr>
                                <td class="p-3 border text-center">{{ $loop->iteration }}</td>
                                <td class="p-3 border">{{ $item->buku->judul ?? '-' }}</td>
                                <td class="p-3 border text-center">
                                    {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d/m/Y') }}
                                </td>
                                <td class="p-3 border text-center">
                                    {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d/m/Y') }}
                                </td>
                                <td class="p-3 border text-center">
                                    {{ $item->tanggal_kembali
                                        ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d/m/Y')
                                        : '-' }}
                                </td>
                                <td class="p-3 border text-center">
                                    @php
                                        $statusStyle = match($item->status) {
                                            'menunggu'    => 'background-color:#fef9e7;color:#f39c12;',
                                            'dipinjam'    => 'background-color:#eaf4fb;color:#2980b9;',
                                            'dikembalikan'=> 'background-color:#d5f5e3;color:#27ae60;',
                                            'ditolak'     => 'background-color:#fdecea;color:#e74c3c;',
                                            default       => 'background-color:#f3f4f6;color:#7f8c8d;',
                                        };
                                        $statusLabel = match($item->status) {
                                            'menunggu'    => 'Menunggu',
                                            'dipinjam'    => 'Dipinjam',
                                            'dikembalikan'=> 'Dikembalikan',
                                            'ditolak'     => 'Ditolak',
                                            default       => $item->status,
                                        };
                                    @endphp
                                    <span style="{{ $statusStyle }} padding: 3px 10px; border-radius: 12px; font-size: 13px; font-weight: 600;">
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="p-3 border text-center">
                                    @if($item->denda)
                                        <span style="color: #e74c3c; font-weight: bold; font-size: 13px;">
                                            Rp {{ number_format($item->denda->total_denda, 0, ',', '.') }}
                                        </span>
                                        <br>
                                        <span style="font-size: 11px; color: {{ $item->denda->status_bayar === 'sudah_bayar' ? '#27ae60' : '#e74c3c' }};">
                                            {{ $item->denda->status_bayar === 'sudah_bayar' ? 'Sudah Bayar' : 'Belum Bayar' }}
                                        </span>
                                    @else
                                        <span style="color: #7f8c8d; font-size: 13px;">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-4 text-center text-gray-500">
                                    Belum ada riwayat peminjaman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $peminjaman->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>