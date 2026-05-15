<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(auth()->user()->role == 'administrator')
                {{-- Menu Admin --}}
                <div class="grid grid-cols-2 gap-4 md:grid-cols-4 mb-6">
                    <a href="/books" class="bg-blue-500 text-white p-6 rounded-lg shadow text-center hover:bg-blue-600">
                        📚 Kelola Buku
                    </a>
                    <a href="/members" class="bg-green-500 text-white p-6 rounded-lg shadow text-center hover:bg-green-600">
                        👤 Kelola Anggota
                    </a>
                    <a href="/borrowings" class="bg-yellow-500 text-white p-6 rounded-lg shadow text-center hover:bg-yellow-600">
                        📋 Data Peminjaman
                    </a>
                    <a href="/returns" class="bg-red-500 text-white p-6 rounded-lg shadow text-center hover:bg-red-600">
                        🔄 Pengembalian
                    </a>
                </div>
            @else
                <div class="bg-white p-6 rounded-lg shadow">
                    <p>Selamat datang, {{ auth()->user()->name }}!</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>