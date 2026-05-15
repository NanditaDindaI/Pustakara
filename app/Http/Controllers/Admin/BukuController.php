<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(): View
    {
        $buku = Buku::with('kategori')->latest()->get();
        return view('admin.buku.index', compact('buku'));
    }

    public function create(): View
    {
        $kategori = Kategori::all();
        return view('admin.buku.create', compact('kategori'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'kategori_id'  => 'required|exists:kategori,id',
            'judul'        => 'required|max:200',
            'pengarang'    => 'required|max:150',
            'penerbit'     => 'required|max:100',
            'tahun_terbit' => 'required|digits:4|integer',
            'isbn'         => 'nullable|max:20|unique:buku,isbn',
            'stok_total'   => 'required|integer|min:1',
            'deskripsi'    => 'nullable',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $coverPath = null;

        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('covers', 'public');
        }

        Buku::create([
            'kategori_id'   => $request->kategori_id,
            'judul'         => $request->judul,
            'pengarang'     => $request->pengarang,
            'penerbit'      => $request->penerbit,
            'tahun_terbit'  => $request->tahun_terbit,
            'isbn'          => $request->isbn,
            'stok_total'    => $request->stok_total,
            'stok_tersedia' => $request->stok_total,
            'deskripsi'     => $request->deskripsi,
            'cover_image'   => $coverPath,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function show(Buku $buku): View
    {
        $buku->load('kategori');
        return view('admin.buku.show', compact('buku'));
    }

    public function edit(Buku $buku): View
    {
        $kategori = Kategori::all();
        return view('admin.buku.edit', compact('buku', 'kategori'));
    }

    public function update(Request $request, Buku $buku): RedirectResponse
    {
        $request->validate([
            'kategori_id'  => 'required|exists:kategori,id',
            'judul'        => 'required|max:200',
            'pengarang'    => 'required|max:150',
            'penerbit'     => 'required|max:100',
            'tahun_terbit' => 'required|digits:4|integer',
            'isbn'         => 'nullable|max:20|unique:buku,isbn,' . $buku->id,
            'stok_total'   => 'required|integer|min:1',
            'deskripsi'    => 'nullable',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $coverPath = $buku->cover_image;

        if ($request->hasFile('cover_image')) {
            if ($buku->cover_image) {
                Storage::disk('public')->delete($buku->cover_image);
            }
            $coverPath = $request->file('cover_image')->store('covers', 'public');
        }

        $selisih = $request->stok_total - $buku->stok_total;
        $stokTersediaBaru = $buku->stok_tersedia + $selisih;

        $buku->update([
            'kategori_id'   => $request->kategori_id,
            'judul'         => $request->judul,
            'pengarang'     => $request->pengarang,
            'penerbit'      => $request->penerbit,
            'tahun_terbit'  => $request->tahun_terbit,
            'isbn'          => $request->isbn,
            'stok_total'    => $request->stok_total,
            'stok_tersedia' => max(0, $stokTersediaBaru),
            'deskripsi'     => $request->deskripsi,
            'cover_image'   => $coverPath,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diupdate');
    }

    public function destroy(Buku $buku): RedirectResponse
    {
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku dipindahkan ke trash');
    }

    // ================= TRASH SYSTEM =================

    public function trash(): View
    {
        $buku = Buku::onlyTrashed()->with('kategori')->latest()->get();
        return view('admin.buku.trash', compact('buku'));
    }

    public function restore($id): RedirectResponse
    {
        Buku::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('buku.trash')->with('success', 'Buku berhasil direstore');
    }

    public function forceDelete($id): RedirectResponse
    {
        $buku = Buku::onlyTrashed()->findOrFail($id);

        if ($buku->cover_image) {
            Storage::disk('public')->delete($buku->cover_image);
        }

        $buku->forceDelete();

        return redirect()->route('buku.trash')->with('success', 'Buku berhasil dihapus permanen');
    }
}