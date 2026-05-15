<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Trash Buku
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
                    <h1 class="text-2xl font-bold">🗑️ Trash Buku</h1>
                    <a href="{{ route('buku.index') }}"
                       style="background-color: #7f8c8d; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                        ← Kembali ke Daftar Buku
                    </a>
                </div>

                <table class="w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border">No</th>
                            <th class="p-3 border">Cover</th>
                            <th class="p-3 border">Judul</th>
                            <th class="p-3 border">Pengarang</th>
                            <th class="p-3 border">Kategori</th>
                            <th class="p-3 border">Dihapus Pada</th>
                            <th class="p-3 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($buku as $item)
                            <tr>
                                <td class="p-3 border text-center">{{ $loop->iteration }}</td>
                                <td class="p-3 border text-center">
                                    @if($item->cover_image)
                                        <img src="{{ Storage::url($item->cover_image) }}"
                                             alt="Cover"
                                             class="h-16 w-12 object-cover mx-auto rounded">
                                    @else
                                        <span class="text-gray-400 text-sm">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="p-3 border">{{ $item->judul }}</td>
                                <td class="p-3 border">{{ $item->pengarang }}</td>
                                <td class="p-3 border">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                <td class="p-3 border text-center">{{ $item->deleted_at->format('d/m/Y H:i') }}</td>
                                <td class="p-3 border text-center">
                                    <form action="{{ route('buku.restore', $item->id) }}"
                                          method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit"
                                                style="background-color: #27ae60; color: white; padding: 4px 10px; border-radius: 6px; border: none; cursor: pointer; margin-right: 4px;">
                                            Restore
                                        </button>
                                    </form>
                                    <form action="{{ route('buku.force-delete', $item->id) }}"
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Hapus permanen? Data tidak bisa dikembalikan!')"
                                                style="background-color: #c0392b; color: white; padding: 4px 10px; border-radius: 6px; border: none; cursor: pointer;">
                                            Hapus Permanen
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-4 text-center text-gray-500">
                                    Trash kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>