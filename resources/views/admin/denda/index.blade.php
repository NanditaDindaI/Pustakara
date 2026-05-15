<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Denda
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('warning'))
                <div class="mb-4 p-4 bg-yellow-100 text-yellow-700 rounded-lg">
                    {{ session('warning') }}
                </div>
            @endif

            @if(session('info'))
                <div class="mb-4 p-4 bg-blue-100 text-blue-700 rounded-lg">
                    {{ session('info') }}
                </div>
            @endif

            {{-- RINGKASAN --}}
            <div style="display: flex; gap: 16px; margin-bottom: 24px;">
                <div class="bg-white shadow-sm sm:rounded-lg p-5" style="flex: 1;">
                    <p style="color: #7f8c8d; font-size: 14px; margin-bottom: 4px;">Total Belum Bayar</p>
                    <p style="font-size: 22px; font-weight: bold; color: #e74c3c;">
                        Rp {{ number_format($totalBelumBayar, 0, ',', '.') }}
                    </p>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-5" style="flex: 1;">
                    <p style="color: #7f8c8d; font-size: 14px; margin-bottom: 4px;">Total Sudah Bayar</p>
                    <p style="font-size: 22px; font-weight: bold; color: #27ae60;">
                        Rp {{ number_format($totalSudahBayar, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                    <h1 class="text-2xl font-bold">Daftar Denda</h1>
                </div>

                <table class="w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border">No</th>
                            <th class="p-3 border">Anggota</th>
                            <th class="p-3 border">Buku</th>
                            <th class="p-3 border">Hari Terlambat</th>
                            <th class="p-3 border">Denda/Hari</th>
                            <th class="p-3 border">Total Denda</th>
                            <th class="p-3 border">Status</th>
                            <th class="p-3 border">Tgl Bayar</th>
                            <th class="p-3 border">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($dendas as $denda)
                            <tr>
                                <td class="p-3 border text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="p-3 border">
                                    {{ $denda->peminjaman->anggota->nama_lengkap ?? '-' }}
                                </td>

                                <td class="p-3 border">
                                    {{ $denda->peminjaman->buku->judul ?? '-' }}
                                </td>

                                <td class="p-3 border text-center">
                                    {{ $denda->jumlah_hari }} hari
                                </td>

                                <td class="p-3 border text-center">
                                    Rp {{ number_format($denda->nominal_per_hari, 0, ',', '.') }}
                                </td>

                                <td class="p-3 border text-center"
                                    style="font-weight: bold; color: #e74c3c;">
                                    Rp {{ number_format($denda->total_denda, 0, ',', '.') }}
                                </td>

                                <td class="p-3 border text-center">
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

                                <td class="p-3 border text-center">
                                    {{ $denda->tanggal_bayar
                                        ? \Carbon\Carbon::parse($denda->tanggal_bayar)->format('d/m/Y')
                                        : '-' }}
                                </td>

                                <td class="p-3 border text-center">

                                    <a href="{{ route('denda.show', $denda->id) }}"
                                       style="background-color: #2980b9; color: white; padding: 4px 10px; border-radius: 6px; text-decoration: none; margin-right: 4px;">
                                        Detail
                                    </a>

                                    @if($denda->status_bayar === 'belum_bayar')
                                        <form action="{{ route('denda.update', $denda->id) }}"
                                              method="POST"
                                              style="display: inline;">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                    onclick="return confirm('Tandai denda ini sudah dibayar?')"
                                                    style="background-color: #27ae60; color: white; padding: 4px 10px; border-radius: 6px; border: none; cursor: pointer;">
                                                Tandai Bayar
                                            </button>
                                        </form>
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9"
                                    class="p-4 text-center text-gray-500">
                                    Belum ada data denda
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $dendas->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>