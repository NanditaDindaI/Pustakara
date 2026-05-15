<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Anggota
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">{{ session('success') }}</div>
            @endif

            {{-- Salam --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <h1 class="text-2xl font-bold">Halo, {{ $anggota->nama_lengkap }} 👋</h1>
                <p style="color: #7f8c8d; margin-top: 4px;">NIM: {{ $anggota->nim }}</p>
            </div>

            {{-- Statistik --}}
            <div style="display: flex; gap: 16px; margin-bottom: 24px;">
                <div class="bg-white shadow-sm sm:rounded-lg p-5" style="flex: 1; text-align: center;">
                    <p style="color: #7f8c8d; font-size: 13px;">Total Peminjaman</p>
                    <p style="font-size: 28px; font-weight: bold; color: #2980b9;">{{ $totalPinjam }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5" style="flex: 1; text-align: center;">
                    <p style="color: #7f8c8d; font-size: 13px;">Sedang Dipinjam</p>
                    <p style="font-size: 28px; font-weight: bold; color: #27ae60;">{{ $sedangDipinjam }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5" style="flex: 1; text-align: center;">
                    <p style="color: #7f8c8d; font-size: 13px;">Menunggu Konfirmasi</p>
                    <p style="font-size: 28px; font-weight: bold; color: #f39c12;">{{ $menungguKonfirmasi }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5" style="flex: 1; text-align: center;">
                    <p style="color: #7f8c8d; font-size: 13px;">Denda Belum Bayar</p>
                    <p style="font-size: 22px; font-weight: bold; color: #e74c3c;">
                        Rp {{ number_format($totalDenda, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            {{-- Peminjaman Aktif --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <h2 class="text-xl font-bold">Peminjaman Aktif</h2>
                    <a href="{{ route('anggota.katalog.index') }}"
                       style="background-color: #2980b9; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                        + Cari Buku
                    </a>
                </div>

                <table class="w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border">No</th>
                            <th class="p-3 border">Buku</th>
                            <th class="p-3 border">Tgl Pinjam</th>
                            <th class="p-3 border">Jatuh Tempo</th>
                            <th class="p-3 border">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjamanAktif as $item)
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
                                    @if($item->status === 'menunggu')
                                        <span style="background-color: #fef9e7; color: #f39c12; padding: 3px 10px; border-radius: 12px; font-size: 13px; font-weight: 600;">Menunggu</span>
                                    @elseif($item->status === 'dipinjam')
                                        <span style="background-color: #eaf4fb; color: #2980b9; padding: 3px 10px; border-radius: 12px; font-size: 13px; font-weight: 600;">Dipinjam</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-500">
                                    Tidak ada peminjaman aktif.
                                    <a href="{{ route('anggota.katalog.index') }}" style="color: #2980b9;">Cari buku sekarang →</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    <a href="{{ route('anggota.riwayat.index') }}" style="color: #2980b9;">
                        Lihat semua riwayat peminjaman →
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>