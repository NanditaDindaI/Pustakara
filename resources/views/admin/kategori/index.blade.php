<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Kategori
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
                    <h1 class="text-2xl font-bold">Daftar Kategori</h1>
                    <a href="{{ route('kategori.create') }}"
                       style="background-color: #2980b9; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                        + Tambah Kategori
                    </a>
                </div>

                <table class="w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border">No</th>
                            <th class="p-3 border">Nama Kategori</th>
                            <th class="p-3 border">Deskripsi</th>
                            <th class="p-3 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategori as $item)
                            <tr>
                                <td class="p-3 border text-center">{{ $loop->iteration }}</td>
                                <td class="p-3 border">{{ $item->nama_kategori }}</td>
                                <td class="p-3 border">{{ $item->deskripsi }}</td>
                                <td class="p-3 border text-center">
                                    <a href="{{ route('kategori.edit', $item->id) }}"
                                       style="background-color: #f39c12; color: white; padding: 4px 10px; border-radius: 6px; text-decoration: none; margin-right: 4px;">
                                        Edit
                                    </a>
                                    <form action="{{ route('kategori.destroy', $item->id) }}"
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Yakin hapus kategori ini?')"
                                                style="background-color: #e74c3c; color: white; padding: 4px 10px; border-radius: 6px; border: none; cursor: pointer;">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-500">
                                    Belum ada data kategori
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>