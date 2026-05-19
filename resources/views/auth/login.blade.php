<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pustakara - Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#f6f1eb] overflow-hidden">

    {{-- BACKGROUND GLOW --}}
    <div
        class="absolute top-[-120px] right-[-120px] w-[400px] h-[400px] bg-orange-300/20 rounded-full blur-3xl">
    </div>

    <div
        class="absolute bottom-[-120px] left-[-120px] w-[350px] h-[350px] bg-[#5a3422]/20 rounded-full blur-3xl">
    </div>

    <div class="min-h-screen flex items-center justify-center px-6 relative z-10">

        <div class="w-full max-w-6xl grid lg:grid-cols-2 gap-10 items-center">

            {{-- LEFT SIDE --}}
            <div class="hidden lg:block">

                <div
                    class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-[#3b2217] via-[#5a3422] to-[#7a4a2d] p-14 shadow-2xl text-white">

                    <div class="relative z-10">

                        <div
                            class="w-24 h-24 rounded-[2rem] bg-white/10 backdrop-blur-md flex items-center justify-center text-5xl mb-8 border border-white/20">

                            📚

                        </div>

                        <h1 class="text-6xl font-black leading-tight mb-6">
                            Pustakara
                        </h1>

                        <p class="text-orange-100 text-lg leading-relaxed max-w-lg">
                            Sistem Informasi Perpustakaan modern untuk mengelola
                            buku, anggota, peminjaman, dan denda dalam satu platform.
                        </p>

                        <div class="mt-10 space-y-4">

                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">
                                    📖
                                </div>

                                <span class="text-orange-100">
                                    Manajemen buku & kategori
                                </span>
                            </div>

                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">
                                    👥
                                </div>

                                <span class="text-orange-100">
                                    Pengelolaan anggota perpustakaan
                                </span>
                            </div>

                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">
                                    💰
                                </div>

                                <span class="text-orange-100">
                                    Monitoring peminjaman & denda
                                </span>
                            </div>

                        </div>

                    </div>

                    <div
                        class="absolute -top-20 -right-20 w-72 h-72 bg-orange-300/20 rounded-full blur-3xl">
                    </div>

                </div>

            </div>

            {{-- RIGHT SIDE --}}
            <div>

                {{-- MOBILE LOGO --}}
                <div class="lg:hidden text-center mb-8">

                    <div
                        class="w-24 h-24 mx-auto rounded-[2rem] bg-gradient-to-br from-orange-500 to-[#5a3422] flex items-center justify-center text-white text-5xl shadow-2xl mb-5">

                        📚

                    </div>

                    <h1 class="text-5xl font-extrabold text-[#2d1b12] mb-2">
                        Pustakara
                    </h1>

                </div>

                {{-- LOGIN CARD --}}
                <div
                    class="bg-white/90 backdrop-blur-xl rounded-[2.5rem] shadow-2xl border border-orange-100 p-10">

                    <div class="mb-8">

                        <h2 class="text-4xl font-black text-[#2d1b12] mb-3">
                            Welcome Back 👋
                        </h2>

                        <p class="text-gray-500 leading-relaxed">
                            Login untuk mengakses sistem perpustakaan Pustakara.
                        </p>

                    </div>

                    {{-- INFO --}}
                    <div
                        class="mb-6 p-5 rounded-2xl bg-orange-50 border border-orange-100">

                        <p class="text-sm text-gray-600 leading-relaxed">

                            ℹ️ Akun anggota dibuat langsung oleh admin perpustakaan.

                        </p>

                    </div>

                    <x-auth-session-status
                        class="mb-4"
                        :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">

                        @csrf

                        {{-- EMAIL --}}
                        <div class="mb-5">

                            <label
                                for="email"
                                class="block mb-2 text-sm font-semibold text-[#2d1b12]">

                                Email

                            </label>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus

                                class="w-full rounded-2xl border border-orange-100 focus:border-orange-400 focus:ring-orange-300 px-5 py-4 shadow-sm bg-white">

                            <x-input-error
                                :messages="$errors->get('email')"
                                class="mt-2" />

                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-5">

                            <label
                                for="password"
                                class="block mb-2 text-sm font-semibold text-[#2d1b12]">

                                Password

                            </label>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required

                                class="w-full rounded-2xl border border-orange-100 focus:border-orange-400 focus:ring-orange-300 px-5 py-4 shadow-sm bg-white">

                            <x-input-error
                                :messages="$errors->get('password')"
                                class="mt-2" />

                        </div>

                        {{-- REMEMBER --}}
                        <div class="flex items-center mb-8">

                            <input
                                id="remember_me"
                                type="checkbox"
                                class="rounded border-gray-300 text-orange-500 shadow-sm focus:ring-orange-400"
                                name="remember">

                            <label
                                for="remember_me"
                                class="ml-2 text-sm text-gray-600">

                                Remember me

                            </label>

                        </div>

                        {{-- ACTION --}}
                        <div class="flex items-center justify-between">

                            @if (Route::has('password.request'))

                                <a
                                    class="text-sm text-gray-500 hover:text-orange-500 transition"
                                    href="{{ route('password.request') }}">

                                    Forgot Password?

                                </a>

                            @endif

                            <button
                                type="submit"
                                class="px-8 py-4 rounded-2xl bg-gradient-to-r from-[#5a3422] to-[#7a4a2d] hover:scale-105 text-white font-bold shadow-xl transition duration-300">

                                Login

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>

</html>