<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Katalog Buku
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">{{ session('error') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-4">Katalog Buku</h1>

                {{-- Form Pencarian --}}
                <form method="GET" action="{{ route('anggota.katalog.index') }}"
                      style="display: flex; gap: 10px; margin-bottom: 24px; flex-wrap: wrap;">
                    <input type="text" name="cari" value="{{ request('cari') }}"
                           placeholder="Cari judul atau pengarang..."
                           style="flex: 1; min-width: 200px; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 8px;">

                    <select name="kategori_id"
                            style="padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 8px;">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}"
                                {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                            style="background-color: #2980b9; color: white; padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer;">
                        Cari
                    </button>

                    @if(request('cari') || request('kategori_id'))
                        <a href="{{ route('anggota.katalog.index') }}"
                           style="background-color: #7f8c8d; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                            Reset
                        </a>
                    @endif
                </form>

                {{-- Grid Buku --}}
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
                    @forelse($buku as $item)
                        <div style="border: 1px solid #e5e7eb; border-radius: 10px; overflow: hidden;">
                            @if($item->cover_image)
                                <img src="{{ Storage::url($item->cover_image) }}"
                                     alt="Cover"
                                     style="width: 100%; height: 200px; object-fit: cover;">
                            @else
                                <div style="width: 100%; height: 200px; background-color: #f3f4f6; display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 13px;">
                                    Tidak ada cover
                                </div>
                            @endif

                            <div style="padding: 12px;">
                                <p style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">
                                    {{ Str::limit($item->judul, 40) }}
                                </p>
                                <p style="color: #7f8c8d; font-size: 12px; margin-bottom: 4px;">
                                    {{ $item->pengarang }}
                                </p>
                                <p style="font-size: 12px; margin-bottom: 8px;">
                                    Stok:
                                    <span style="font-weight: bold; color: {{ $item->stok_tersedia > 0 ? '#27ae60' : '#e74c3c' }};">
                                        {{ $item->stok_tersedia > 0 ? $item->stok_tersedia . ' tersedia' : 'Habis' }}
                                    </span>
                                </p>
                                <a href="{{ route('anggota.katalog.show', $item->id) }}"
                                   style="display: block; text-align: center; background-color: #2980b9; color: white; padding: 6px; border-radius: 6px; text-decoration: none; font-size: 13px;">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500" style="grid-column: 1/-1; text-align: center; padding: 40px 0;">
                            Tidak ada buku yang ditemukan.
                        </p>
                    @endforelse
                </div>

                <div class="mt-6">
                    {{ $buku->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>