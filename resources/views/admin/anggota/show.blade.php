<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Anggota
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">Detail Anggota</h1>

                <table class="w-full mb-6">
                    <tr class="border-b">
                        <td class="py-2 font-medium text-gray-600 w-36">NIM</td>
                        <td class="py-2">{{ $anggota->nim }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-medium text-gray-600">Nama Lengkap</td>
                        <td class="py-2">{{ $anggota->nama_lengkap }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-medium text-gray-600">Email</td>
                        <td class="py-2">{{ $anggota->email }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-medium text-gray-600">Telepon</td>
                        <td class="py-2">{{ $anggota->telepon ?? '-' }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-medium text-gray-600">Alamat</td>
                        <td class="py-2">{{ $anggota->alamat ?? '-' }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-medium text-gray-600">Status</td>
                        <td class="py-2">
                            <span style="background-color: {{ $anggota->status === 'aktif' ? '#27ae60' : '#e74c3c' }}; color: white; padding: 2px 10px; border-radius: 12px; font-size: 13px;">
                                {{ ucfirst($anggota->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 font-medium text-gray-600">Tgl Daftar</td>
                        <td class="py-2">{{ \Carbon\Carbon::parse($anggota->tanggal_daftar)->format('d/m/Y') }}</td>
                    </tr>
                </table>

                <h2 class="text-lg font-bold mb-3">Riwayat Peminjaman</h2>
                @if($anggota->peminjaman->count() > 0)
                    <table class="w-full border border-gray-200 mb-6">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-2 border">Buku</th>
                                <th class="p-2 border">Tgl Pinjam</th>
                                <th class="p-2 border">Tgl Jatuh Tempo</th>
                                <th class="p-2 border">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($anggota->peminjaman as $pinjam)
                                <tr>
                                    <td class="p-2 border">{{ $pinjam->buku->judul ?? '-' }}</td>
                                    <td class="p-2 border text-center">{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d/m/Y') }}</td>
                                    <td class="p-2 border text-center">{{ \Carbon\Carbon::parse($pinjam->tanggal_jatuh_tempo)->format('d/m/Y') }}</td>
                                    <td class="p-2 border text-center">{{ $pinjam->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500 mb-6">Belum ada riwayat peminjaman</p>
                @endif

                <div style="display: flex; gap: 12px;">
                    <a href="{{ route('anggota-admin.edit', $anggota->id) }}"
                       style="background-color: #f39c12; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none;">
                        Edit
                    </a>
                    <a href="{{ route('anggota-admin.index') }}"
                       style="background-color: #7f8c8d; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none;">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>