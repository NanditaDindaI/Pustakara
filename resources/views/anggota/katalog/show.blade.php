<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Buku
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">{{ session('error') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div style="display: flex; gap: 24px;">
                    {{-- Cover --}}
                    <div style="flex-shrink: 0;">
                        @if($buku->cover_image)
                            <img src="{{ Storage::url($buku->cover_image) }}"
                                 alt="Cover"
                                 style="width: 150px; height: 210px; object-fit: cover; border-radius: 8px; border: 1px solid #e5e7eb;">
                        @else
                            <div style="width: 150px; height: 210px; background-color: #f3f4f6; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 13px;">
                                Tidak ada cover
                            </div>
                        @endif
                    </div>

                    {{-- Info Buku --}}
                    <div style="flex: 1;">
                        <h1 class="text-2xl font-bold mb-2">{{ $buku->judul }}</h1>
                        <table class="w-full text-sm">
                            <tr>
                                <td style="color: #7f8c8d; padding: 4px 0; width: 130px;">Pengarang</td>
                                <td>{{ $buku->pengarang }}</td>
                            </tr>
                            <tr>
                                <td style="color: #7f8c8d; padding: 4px 0;">Kategori</td>
                                <td>{{ $buku->kategori->nama_kategori ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td style="color: #7f8c8d; padding: 4px 0;">Stok Tersedia</td>
                                <td style="font-weight: bold; color: {{ $buku->stok_tersedia > 0 ? '#27ae60' : '#e74c3c' }};">
                                    {{ $buku->stok_tersedia > 0 ? $buku->stok_tersedia . ' buku' : 'Tidak tersedia' }}
                                </td>
                            </tr>
                        </table>

                        @if($buku->deskripsi ?? false)
                            <p style="margin-top: 12px; color: #4b5563; font-size: 14px; line-height: 1.6;">
                                {{ $buku->deskripsi }}
                            </p>
                        @endif

                        {{-- Tombol Ajukan --}}
                        <div style="margin-top: 20px;">
                            @if($sudahAjukan)
                                <span style="background-color: #f3f4f6; color: #7f8c8d; padding: 10px 20px; border-radius: 8px; font-size: 14px;">
                                    ✓ Sudah diajukan / sedang dipinjam
                                </span>
                            @elseif($buku->stok_tersedia <= 0)
                                <span style="background-color: #fdecea; color: #e74c3c; padding: 10px 20px; border-radius: 8px; font-size: 14px;">
                                    Stok habis
                                </span>
                            @else
                                <form action="{{ route('anggota.katalog.ajukan', $buku->id) }}" method="POST"
                                      onsubmit="return confirm('Ajukan peminjaman buku ini?')">
                                    @csrf
                                    <button type="submit"
                                            style="background-color: #27ae60; color: white; padding: 10px 24px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px;">
                                        📚 Ajukan Peminjaman
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                </div>

                <div style="margin-top: 24px;">
                    <a href="{{ route('anggota.katalog.index') }}"
                       style="color: #7f8c8d; text-decoration: none; font-size: 14px;">
                        ← Kembali ke Katalog
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>