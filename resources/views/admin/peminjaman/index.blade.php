<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Peminjaman
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                    <h1 class="text-2xl font-bold">Daftar Peminjaman</h1>
                    <a href="{{ route('peminjaman.create') }}"
                       style="background-color: #2980b9; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                        + Catat Peminjaman
                    </a>
                </div>

                <table class="w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border">No</th>
                            <th class="p-3 border">Anggota</th>
                            <th class="p-3 border">Buku</th>
                            <th class="p-3 border">Tgl Pinjam</th>
                            <th class="p-3 border">Jatuh Tempo</th>
                            <th class="p-3 border">Tgl Kembali</th>
                            <th class="p-3 border">Status</th>
                            <th class="p-3 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjaman as $item)
                            @php
                                $telat = $item->status === 'dipinjam' && \Carbon\Carbon::today()->gt($item->tanggal_jatuh_tempo);
                            @endphp
                            <tr style="{{ $telat ? 'background-color: #fff5f5;' : '' }}">
                                <td class="p-3 border text-center">{{ $loop->iteration }}</td>
                                <td class="p-3 border">{{ $item->anggota->nama_lengkap ?? '-' }}</td>
                                <td class="p-3 border">{{ $item->buku->judul ?? '-' }}</td>
                                <td class="p-3 border text-center">
                                    {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d/m/Y') }}
                                </td>
                                <td class="p-3 border text-center">
                                    <span style="{{ $telat ? 'color: #e74c3c; font-weight: bold;' : '' }}">
                                        {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td class="p-3 border text-center">
                                    {{ $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="p-3 border text-center">
                                    @if($item->status === 'dipinjam' && $telat)
                                        <span style="background-color: #e74c3c; color: white; padding: 2px 10px; border-radius: 12px; font-size: 13px;">
                                            Telat
                                        </span>
                                    @elseif($item->status === 'dipinjam')
                                        <span style="background-color: #f39c12; color: white; padding: 2px 10px; border-radius: 12px; font-size: 13px;">
                                            Dipinjam
                                        </span>
                                    @elseif($item->status === 'dikembalikan')
                                        <span style="background-color: #27ae60; color: white; padding: 2px 10px; border-radius: 12px; font-size: 13px;">
                                            Dikembalikan
                                        </span>
                                    @else
                                        <span style="background-color: #95a5a6; color: white; padding: 2px 10px; border-radius: 12px; font-size: 13px;">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-3 border text-center">
                                    <a href="{{ route('peminjaman.show', $item->id) }}"
                                       style="background-color: #2980b9; color: white; padding: 4px 10px; border-radius: 6px; text-decoration: none; margin-right: 4px;">
                                        Detail
                                    </a>
                                    @if($item->status === 'dipinjam')
                                        <form action="{{ route('peminjaman.kembalikan', $item->id) }}"
                                              method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit"
                                                    onclick="return confirm('Konfirmasi pengembalian buku ini?')"
                                                    style="background-color: #27ae60; color: white; padding: 4px 10px; border-radius: 6px; border: none; cursor: pointer; margin-right: 4px;">
                                                Kembalikan
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('peminjaman.destroy', $item->id) }}"
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Yakin hapus data peminjaman ini?')"
                                                style="background-color: #e74c3c; color: white; padding: 4px 10px; border-radius: 6px; border: none; cursor: pointer;">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-4 text-center text-gray-500">
                                    Belum ada data peminjaman
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>