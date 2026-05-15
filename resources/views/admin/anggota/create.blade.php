<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Anggota
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">Form Registrasi Anggota</h1>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-700 p-4 rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('anggota-admin.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-2">NIM</label>
                        <input type="text" name="nim" value="{{ old('nim') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Telepon <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="telepon" value="{{ old('telepon') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Alamat <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <textarea name="alamat" rows="3"
                                  class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('alamat') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Password</label>
                        <input type="password" name="password"
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>

                    <div style="margin-top: 20px; display: flex; gap: 12px;">
                        <button type="submit"
                                style="background-color: #c0392b; color: white; padding: 10px 24px; border-radius: 8px; border: none; cursor: pointer; font-size: 16px;">
                            Daftarkan Anggota
                        </button>
                        <a href="{{ route('anggota-admin.index') }}"
                           style="background-color: #7f8c8d; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-size: 16px;">
                            Kembali
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>