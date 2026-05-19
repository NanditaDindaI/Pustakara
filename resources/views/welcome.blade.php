<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pustakara</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f6f1eb] text-gray-800 overflow-x-hidden">

    {{-- BACKGROUND GLOW --}}
    <div
        class="fixed top-[-120px] right-[-120px] w-[420px] h-[420px] bg-orange-300/20 rounded-full blur-3xl">
    </div>

    <div
        class="fixed bottom-[-120px] left-[-120px] w-[380px] h-[380px] bg-[#5a3422]/20 rounded-full blur-3xl">
    </div>

    {{-- NAVBAR --}}
    <nav class="relative z-20 w-full px-8 lg:px-16 py-6">

        <div class="max-w-7xl mx-auto flex items-center justify-between">

            {{-- LOGO --}}
            <div class="flex items-center gap-4">

                <div
                    class="w-14 h-14 rounded-[1.3rem] bg-gradient-to-br from-orange-500 to-[#5a3422] flex items-center justify-center text-white text-2xl shadow-xl">

                    📚

                </div>

                <div>

                    <h1 class="text-3xl font-black text-[#2d1b12]">
                        Pustakara
                    </h1>

                    <p class="text-sm text-gray-500">
                        Smart Digital Library
                    </p>

                </div>

            </div>

            {{-- BUTTON --}}
            <div>

                @auth

                    <a href="{{ url('/dashboard') }}"
                        class="px-6 py-3 rounded-2xl bg-[#5a3422] hover:bg-[#3b2217] text-white font-bold shadow-xl transition duration-300">

                        Dashboard

                    </a>

                @else

                    <a href="{{ route('login') }}"
                        class="px-6 py-3 rounded-2xl bg-gradient-to-r from-[#5a3422] to-[#7a4a2d] hover:scale-105 text-white font-bold shadow-xl transition duration-300">

                        Login

                    </a>

                @endauth

            </div>

        </div>

    </nav>

    {{-- HERO --}}
    <section class="relative z-10 max-w-7xl mx-auto px-8 lg:px-16 py-16 lg:py-24">

        <div class="grid lg:grid-cols-2 gap-14 items-center">

            {{-- LEFT --}}
            <div>

                <div
                    class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-orange-100 text-orange-700 text-sm font-bold mb-8 shadow-sm">

                    ✨ Modern Library Management System

                </div>

                <h1
                    class="text-5xl lg:text-7xl font-black leading-tight text-[#2d1b12] mb-8">

                    Kelola
                    <span class="bg-gradient-to-r from-orange-500 to-[#7a4a2d] bg-clip-text text-transparent">
                        Perpustakaan
                    </span>
                    Dengan Lebih Modern
                </h1>

                <p class="text-xl text-gray-600 leading-relaxed mb-10 max-w-2xl">

                    Pustakara membantu pengelolaan buku,
                    anggota, peminjaman, pengembalian,
                    dan denda dalam satu platform terintegrasi.

                </p>

                {{-- INFO CARD --}}
                <div
                    class="mb-10 bg-white/80 backdrop-blur-xl border border-orange-100 rounded-[2rem] p-6 shadow-xl">

                    <h3 class="font-bold text-[#2d1b12] text-lg mb-3">
                        ℹ️ Informasi Akses Akun
                    </h3>

                    <p class="text-gray-600 leading-relaxed">

                        Akun anggota perpustakaan dibuat langsung oleh admin.
                        Jika belum memiliki akun, silakan hubungi petugas/admin perpustakaan.

                    </p>

                </div>

                {{-- BUTTON --}}
                <div class="flex flex-wrap gap-4">

                    <a href="{{ route('login') }}"
                        class="px-8 py-4 rounded-2xl bg-gradient-to-r from-[#5a3422] to-[#7a4a2d] hover:scale-105 text-white font-bold shadow-2xl transition duration-300">

                        Login Sekarang

                    </a>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="relative">

                {{-- MAIN CARD --}}
                <div
                    class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-[#3b2217] via-[#5a3422] to-[#7a4a2d] p-8 shadow-2xl">

                    {{-- GLOW --}}
                    <div
                        class="absolute -top-20 -right-20 w-72 h-72 bg-orange-300/20 rounded-full blur-3xl">
                    </div>

                    <div class="relative z-10">

                        {{-- TOP --}}
                        <div class="mb-8">

                            <div
                                class="w-20 h-20 rounded-[2rem] bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-4xl text-white mb-6">

                                📚

                            </div>

                            <h2 class="text-4xl font-black text-white mb-3">
                                Pustakara
                            </h2>

                            <p class="text-orange-100 leading-relaxed">
                                Platform perpustakaan modern untuk pengalaman
                                manajemen yang lebih efisien dan terintegrasi.
                            </p>

                        </div>

                        {{-- FEATURES --}}
                        <div class="space-y-5">

                            <div
                                class="bg-white/10 backdrop-blur-md rounded-2xl p-5 border border-white/10 flex items-center gap-4">

                                <div
                                    class="w-14 h-14 rounded-2xl bg-orange-400/20 flex items-center justify-center text-2xl text-white">
                                    📖
                                </div>

                                <div>

                                    <h3 class="font-bold text-white">
                                        Manajemen Buku
                                    </h3>

                                    <p class="text-sm text-orange-100">
                                        Kelola koleksi buku secara efisien
                                    </p>

                                </div>

                            </div>

                            <div
                                class="bg-white/10 backdrop-blur-md rounded-2xl p-5 border border-white/10 flex items-center gap-4">

                                <div
                                    class="w-14 h-14 rounded-2xl bg-green-400/20 flex items-center justify-center text-2xl text-white">
                                    👥
                                </div>

                                <div>

                                    <h3 class="font-bold text-white">
                                        Data Anggota
                                    </h3>

                                    <p class="text-sm text-orange-100">
                                        Monitoring anggota perpustakaan
                                    </p>

                                </div>

                            </div>

                            <div
                                class="bg-white/10 backdrop-blur-md rounded-2xl p-5 border border-white/10 flex items-center gap-4">

                                <div
                                    class="w-14 h-14 rounded-2xl bg-red-400/20 flex items-center justify-center text-2xl text-white">
                                    💰
                                </div>

                                <div>

                                    <h3 class="font-bold text-white">
                                        Denda & Peminjaman
                                    </h3>

                                    <p class="text-sm text-orange-100">
                                        Pantau transaksi secara real-time
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</body>

</html>

