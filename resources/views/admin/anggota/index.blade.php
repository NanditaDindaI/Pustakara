<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Anggota
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                    <h1 class="text-2xl font-bold">Daftar Anggota</h1>

                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('anggota-admin.trash') }}"
                           style="background-color: #7f8c8d; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                            🗑 Trash
                        </a>

                        <a href="{{ route('anggota-admin.create') }}"
                           style="background-color: #2980b9; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                            + Tambah Anggota
                        </a>
                    </div>
                </div>

                <table class="w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border">No</th>
                            <th class="p-3 border">NIM</th>
                            <th class="p-3 border">Nama Lengkap</th>
                            <th class="p-3 border">Email</th>
                            <th class="p-3 border">Telepon</th>
                            <th class="p-3 border">Status</th>
                            <th class="p-3 border">Tgl Daftar</th>
                            <th class="p-3 border">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($anggota as $item)
                            <tr>
                                <td class="p-3 border text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="p-3 border">
                                    {{ $item->nim }}
                                </td>

                                <td class="p-3 border">
                                    {{ $item->nama_lengkap }}
                                </td>

                                <td class="p-3 border">
                                    {{ $item->email }}
                                </td>

                                <td class="p-3 border">
                                    {{ $item->telepon ?? '-' }}
                                </td>

                                <td class="p-3 border text-center">
                                    <span style="background-color: {{ $item->status === 'aktif' ? '#27ae60' : '#e74c3c' }}; color: white; padding: 2px 10px; border-radius: 12px; font-size: 13px;">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>

                                <td class="p-3 border text-center">
                                    {{ \Carbon\Carbon::parse($item->tanggal_daftar)->format('d/m/Y') }}
                                </td>

                                <td class="p-3 border text-center">
                                    <a href="{{ route('anggota-admin.show', $item->id) }}"
                                       style="background-color: #2980b9; color: white; padding: 4px 10px; border-radius: 6px; text-decoration: none; margin-right: 4px;">
                                        Detail
                                    </a>

                                    <a href="{{ route('anggota-admin.edit', $item->id) }}"
                                       style="background-color: #f39c12; color: white; padding: 4px 10px; border-radius: 6px; text-decoration: none; margin-right: 4px;">
                                        Edit
                                    </a>

                                    <form action="{{ route('anggota-admin.destroy', $item->id) }}"
                                          method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                onclick="return confirm('Yakin hapus anggota ini? Akun login-nya juga akan terhapus!')"
                                                style="background-color: #e74c3c; color: white; padding: 4px 10px; border-radius: 6px; border: none; cursor: pointer;">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-4 text-center text-gray-500">
                                    Belum ada data anggota
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>