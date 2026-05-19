<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-[#2d1b12]">
                📚 Admin Dashboard
            </h2>

            <div class="text-sm text-gray-500">
                Welcome back, Admin 👋
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f6f1eb] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- HERO --}}
            <div
                class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#3b2217] via-[#5a3422] to-[#7a4a2d] p-10 shadow-2xl mb-8">

                <div class="relative z-10">

                    <h1 class="text-4xl font-extrabold text-white mb-3">
                        Selamat Datang, Admin 👑
                    </h1>

                    <p class="text-orange-100 text-lg max-w-2xl">
                        Kelola seluruh sistem perpustakaan Pustakara dengan mudah,
                        mulai dari buku, anggota, hingga transaksi peminjaman.
                    </p>

                </div>

                <div
                    class="absolute -right-10 -top-10 w-60 h-60 bg-orange-300/20 rounded-full blur-3xl">
                </div>

            </div>

            {{-- STATS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                {{-- TOTAL BUKU --}}
                <div
                    class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition border border-orange-100">

                    <div class="mb-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-orange-100 flex items-center justify-center text-2xl">
                            📚
                        </div>
                    </div>

                    <p class="text-gray-500 text-sm">
                        Total Buku
                    </p>

                    <h3 class="text-3xl font-bold text-[#2d1b12] mt-1">
                        {{ $totalBuku }}
                    </h3>

                </div>

                {{-- TOTAL ANGGOTA --}}
                <div
                    class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition border border-green-100">

                    <div class="mb-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-2xl">
                            👥
                        </div>
                    </div>

                    <p class="text-gray-500 text-sm">
                        Anggota Aktif
                    </p>

                    <h3 class="text-3xl font-bold text-[#2d1b12] mt-1">
                        {{ $totalAnggota }}
                    </h3>

                </div>

                {{-- SEDANG DIPINJAM --}}
                <div
                    class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition border border-yellow-100">

                    <div class="mb-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center text-2xl">
                            📖
                        </div>
                    </div>

                    <p class="text-gray-500 text-sm">
                        Sedang Dipinjam
                    </p>

                    <h3 class="text-3xl font-bold text-[#2d1b12] mt-1">
                        {{ $sedangDipinjam }}
                    </h3>

                </div>

                {{-- MENUNGGU --}}
                <div
                    class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition border border-red-100">

                    <div class="mb-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center text-2xl">
                            ⚠️
                        </div>
                    </div>

                    <p class="text-gray-500 text-sm">
                        Menunggu Konfirmasi
                    </p>

                    <h3 class="text-3xl font-bold text-red-600 mt-1">
                        {{ $menungguKonfirmasi }}
                    </h3>

                </div>

            </div>

            {{-- BOTTOM --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- AKTIVITAS --}}
                <div class="bg-white rounded-3xl p-8 shadow-md border border-gray-100">

                    <h3 class="text-xl font-bold text-[#2d1b12] mb-6">
                        🟢 Aktivitas Terbaru
                    </h3>

                    <div class="space-y-4">

                        @forelse ($aktivitasTerbaru as $aktivitas)

                            <div class="flex items-start gap-4">

                                <div
                                    class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">
                                    📚
                                </div>

                                <div>

                                    <p class="font-semibold text-gray-800">
                                        {{ $aktivitas->anggota->nama ?? 'Anggota' }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        Meminjam buku
                                        "{{ $aktivitas->buku->judul ?? 'Buku' }}"
                                    </p>

                                </div>

                            </div>

                        @empty

                            <p class="text-gray-500 text-sm">
                                Belum ada aktivitas terbaru.
                            </p>

                        @endforelse

                    </div>

                </div>

                {{-- LOG --}}
                <div class="bg-white rounded-3xl p-8 shadow-md border border-gray-100">

                    <h3 class="text-xl font-bold text-[#2d1b12] mb-6">
                        💰 Log Sistem
                    </h3>

                    <div class="space-y-5">

                        <div class="p-5 rounded-2xl bg-orange-50 border border-orange-100">

                            <p class="text-sm text-gray-600 mb-2">
                                Sistem peminjaman perpustakaan aktif dan berjalan normal.
                            </p>

                            <h3 class="text-2xl font-bold text-[#5a3422]">
                                Semua Sistem Stabil ✅
                            </h3>

                        </div>

                        <div class="p-4 rounded-2xl bg-red-50 border border-red-100">

                            <p class="text-sm text-gray-700">
                                Ada
                                <span class="font-bold text-red-600">
                                    {{ $menungguKonfirmasi }}
                                </span>
                                transaksi yang menunggu konfirmasi admin.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>