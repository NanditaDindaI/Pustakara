<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Anggota
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">Form Edit Anggota</h1>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-700 p-4 rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('anggota-admin.update', $anggota->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-2">NIM</label>
                        <input type="text" name="nim" value="{{ old('nim', $anggota->nim) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Email</label>
                        <input type="email" value="{{ $anggota->email }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100" disabled>
                        <p class="text-sm text-gray-400 mt-1">Email tidak bisa diubah</p>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Telepon</label>
                        <input type="text" name="telepon" value="{{ old('telepon', $anggota->telepon) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Alamat</label>
                        <textarea name="alamat" rows="3"
                                  class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('alamat', $anggota->alamat) }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-2">Status</label>
                        <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                            <option value="aktif" {{ old('status', $anggota->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $anggota->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>

                    <div style="margin-top: 20px; display: flex; gap: 12px;">
                        <button type="submit"
                                style="background-color: #f39c12; color: white; padding: 10px 24px; border-radius: 8px; border: none; cursor: pointer; font-size: 16px;">
                            Update
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