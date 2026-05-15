<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index(): View
    {
        $anggota = Anggota::with('user')->latest()->get();
        return view('admin.anggota.index', compact('anggota'));
    }

    public function trash(): View
    {
        $anggota = Anggota::onlyTrashed()->with('user')->latest()->get();
        return view('admin.anggota.trash', compact('anggota'));
    }

    public function create(): View
    {
        return view('admin.anggota.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nim'          => 'required|max:20|unique:anggota,nim',
            'nama_lengkap' => 'required|max:150',
            'email'        => 'required|email|max:150|unique:users,email',
            'telepon'      => 'nullable|max:20',
            'alamat'       => 'nullable',
            'password'     => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->nama_lengkap,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'anggota',
        ]);

        Anggota::create([
            'user_id'        => $user->id,
            'nim'            => $request->nim,
            'nama_lengkap'   => $request->nama_lengkap,
            'email'          => $request->email,
            'telepon'        => $request->telepon,
            'alamat'         => $request->alamat,
            'status'         => 'aktif',
            'tanggal_daftar' => now()->toDateString(),
        ]);

        return redirect()->route('anggota-admin.index')->with('success', 'Anggota berhasil didaftarkan');
    }

    public function show(Anggota $anggota): View
    {
        $anggota->load('user', 'peminjaman');
        return view('admin.anggota.show', compact('anggota'));
    }

    public function edit(Anggota $anggota): View
    {
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota): RedirectResponse
    {
        $request->validate([
            'nim'          => 'required|max:20|unique:anggota,nim,' . $anggota->id,
            'nama_lengkap' => 'required|max:150',
            'telepon'      => 'nullable|max:20',
            'alamat'       => 'nullable',
            'status'       => 'required|in:aktif,nonaktif',
        ]);

        $anggota->update([
            'nim'          => $request->nim,
            'nama_lengkap' => $request->nama_lengkap,
            'telepon'      => $request->telepon,
            'alamat'       => $request->alamat,
            'status'       => $request->status,
        ]);

        $anggota->user->update([
            'name' => $request->nama_lengkap,
        ]);

        return redirect()->route('anggota-admin.index')->with('success', 'Data anggota berhasil diupdate');
    }

    public function destroy(Anggota $anggota): RedirectResponse
    {
        $anggota->delete(); // soft delete
        return redirect()->route('anggota-admin.index')->with('success', 'Anggota dipindahkan ke trash');
    }

    public function restore(int $id): RedirectResponse
    {
        $anggota = Anggota::onlyTrashed()->findOrFail($id);
        $anggota->restore();
        return redirect()->route('anggota-admin.trash')->with('success', 'Anggota berhasil dipulihkan');
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $anggota = Anggota::onlyTrashed()->findOrFail($id);
        $anggota->user->delete();
        $anggota->forceDelete();
        return redirect()->route('anggota-admin.trash')->with('success', 'Anggota berhasil dihapus permanen');
    }
}