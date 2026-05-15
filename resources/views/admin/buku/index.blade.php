<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Buku
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

                <!-- HEADER + BUTTON -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                    <h1 class="text-2xl font-bold">Daftar Buku</h1>

                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('buku.trash') }}"
                           style="background-color: #7f8c8d; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                            🗑️ Trash
                        </a>

                        <a href="{{ route('buku.create') }}"
                           style="background-color: #2980b9; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                            + Tambah Buku
                        </a>
                    </div>
                </div>

                <!-- TABLE -->
                <table class="w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border">No</th>
                            <th class="p-3 border">Cover</th>
                            <th class="p-3 border">Judul</th>
                            <th class="p-3 border">Pengarang</th>
                            <th class="p-3 border">Kategori</th>
                            <th class="p-3 border">Stok Total</th>
                            <th class="p-3 border">Stok Tersedia</th>
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

                                <td class="p-3 border text-center">{{ $item->stok_total }}</td>

                                <td class="p-3 border text-center">
                                    <span style="color: {{ $item->stok_tersedia > 0 ? 'green' : 'red' }}; font-weight: bold;">
                                        {{ $item->stok_tersedia }}
                                    </span>
                                </td>

                                <td class="p-3 border text-center">

                                    <a href="{{ route('buku.show', $item->id) }}"
                                       style="background-color: #2980b9; color: white; padding: 4px 10px; border-radius: 6px; text-decoration: none; margin-right: 4px;">
                                        Detail
                                    </a>

                                    <a href="{{ route('buku.edit', $item->id) }}"
                                       style="background-color: #f39c12; color: white; padding: 4px 10px; border-radius: 6px; text-decoration: none; margin-right: 4px;">
                                        Edit
                                    </a>

                                    <form action="{{ route('buku.destroy', $item->id) }}"
                                          method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                onclick="return confirm('Yakin hapus buku ini?')"
                                                style="background-color: #e74c3c; color: white; padding: 4px 10px; border-radius: 6px; border: none; cursor: pointer;">
                                            Hapus
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-4 text-center text-gray-500">
                                    Belum ada data buku
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>