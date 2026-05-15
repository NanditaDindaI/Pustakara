<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Peminjaman
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">Detail Peminjaman</h1>

                <table class="w-full mb-6">
                    <tr class="border-b">
                        <td class="py-2 font-medium text-gray-600 w-40">Anggota</td>
                        <td class="py-2">{{ $peminjaman->anggota->nama_lengkap ?? '-' }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-medium text-gray-600">NIM</td>
                        <td class="py-2">{{ $peminjaman->anggota->nim ?? '-' }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-medium text-gray-600">Buku</td>
                        <td class="py-2">{{ $peminjaman->buku->judul ?? '-' }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-medium text-gray-600">Dicatat oleh</td>
                        <td class="py-2">{{ $peminjaman->admin->name ?? '-' }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-medium text-gray-600">Tgl Pinjam</td>
                        <td class="py-2">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d/m/Y') }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-medium text-gray-600">Jatuh Tempo</td>
                        <td class="py-2">{{ \Carbon\Carbon::parse($peminjaman->tanggal_jatuh_tempo)->format('d/m/Y') }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-medium text-gray-600">Tgl Kembali</td>
                        <td class="py-2">{{ $peminjaman->tanggal_kembali ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d/m/Y') : '-' }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-medium text-gray-600">Status</td>
                        <td class="py-2">
                            @php
                                $statusColor = match($peminjaman->status) {
                                    'menunggu'  => '#f39c12',
                                    'dipinjam'  => '#2980b9',
                                    'dikembalikan' => '#27ae60',
                                    'ditolak'   => '#e74c3c',
                                    default     => '#7f8c8d',
                                };
                            @endphp
                            <span style="background-color: {{ $statusColor }}; color: white; padding: 2px 10px; border-radius: 12px; font-size: 13px;">
                                {{ ucfirst($peminjaman->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-medium text-gray-600">Catatan</td>
                        <td class="py-2">{{ $peminjaman->catatan ?? '-' }}</td>
                    </tr>
                </table>

                @if($peminjaman->denda)
                    <div style="background-color: #fff5f5; border: 1px solid #e74c3c; border-radius: 8px; padding: 16px; margin-bottom: 24px;">
                        <h2 class="text-lg font-bold mb-3" style="color: #e74c3c;">⚠️ Info Denda</h2>
                        <table class="w-full">
                            <tr class="border-b">
                                <td class="py-2 font-medium text-gray-600 w-40">Hari Telat</td>
                                <td class="py-2">{{ $peminjaman->denda->jumlah_hari }} hari</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium text-gray-600">Total Denda</td>
                                <td class="py-2">Rp {{ number_format($peminjaman->denda->total_denda, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 font-medium text-gray-600">Status Bayar</td>
                                <td class="py-2">
                                    <span style="background-color: {{ $peminjaman->denda->status_bayar === 'lunas' ? '#27ae60' : '#e74c3c' }}; color: white; padding: 2px 10px; border-radius: 12px; font-size: 13px;">
                                        {{ ucfirst($peminjaman->denda->status_bayar) }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                @endif

                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                    @if($peminjaman->status === 'menunggu')
                        <form action="{{ route('peminjaman.konfirmasi', $peminjaman->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    onclick="return confirm('Konfirmasi peminjaman ini?')"
                                    style="background-color: #27ae60; color: white; padding: 10px 24px; border-radius: 8px; border: none; cursor: pointer; font-size: 16px;">
                                ✓ Konfirmasi
                            </button>
                        </form>
                        <form action="{{ route('peminjaman.tolak', $peminjaman->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    onclick="return confirm('Tolak peminjaman ini?')"
                                    style="background-color: #e74c3c; color: white; padding: 10px 24px; border-radius: 8px; border: none; cursor: pointer; font-size: 16px;">
                                ✗ Tolak
                            </button>
                        </form>
                    @endif

                    @if($peminjaman->status === 'dipinjam')
                        <form action="{{ route('peminjaman.kembalikan', $peminjaman->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    onclick="return confirm('Konfirmasi pengembalian buku ini?')"
                                    style="background-color: #2980b9; color: white; padding: 10px 24px; border-radius: 8px; border: none; cursor: pointer; font-size: 16px;">
                                📚 Kembalikan Buku
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('peminjaman.index') }}"
                       style="background-color: #7f8c8d; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-size: 16px;">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>