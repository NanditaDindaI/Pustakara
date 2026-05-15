<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Trash Anggota
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
                    <h1 class="text-2xl font-bold">Anggota Terhapus</h1>
                    <a href="{{ route('anggota-admin.index') }}"
                       style="background-color: #7f8c8d; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                        ← Kembali
                    </a>
                </div>

                <table class="w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border">No</th>
                            <th class="p-3 border">NIM</th>
                            <th class="p-3 border">Nama Lengkap</th>
                            <th class="p-3 border">Email</th>
                            <th class="p-3 border">Dihapus Pada</th>
                            <th class="p-3 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($anggota as $item)
                            <tr>
                                <td class="p-3 border text-center">{{ $loop->iteration }}</td>
                                <td class="p-3 border">{{ $item->nim }}</td>
                                <td class="p-3 border">{{ $item->nama_lengkap }}</td>
                                <td class="p-3 border">{{ $item->email }}</td>
                                <td class="p-3 border text-center">
                                    {{ \Carbon\Carbon::parse($item->deleted_at)->format('d/m/Y H:i') }}
                                </td>
                                <td class="p-3 border text-center">
                                    <form action="{{ route('anggota-admin.restore', $item->id) }}"
                                          method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit"
                                                style="background-color: #27ae60; color: white; padding: 4px 10px; border-radius: 6px; border: none; cursor: pointer; margin-right: 4px;">
                                            Pulihkan
                                        </button>
                                    </form>
                                    <form action="{{ route('anggota-admin.force-delete', $item->id) }}"
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Hapus permanen? Data tidak bisa dikembalikan!')"
                                                style="background-color: #e74c3c; color: white; padding: 4px 10px; border-radius: 6px; border: none; cursor: pointer;">
                                            Hapus Permanen
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-gray-500">
                                    Tidak ada anggota di trash
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>