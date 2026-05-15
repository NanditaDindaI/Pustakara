<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Carbon\Carbon;

class KatalogController extends Controller
{
    public function index(Request $request): View
    {
        $query = Buku::with('kategori');

        // Search
        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('judul', 'like', "%{$cari}%")
                  ->orWhere('pengarang', 'like', "%{$cari}%");
            });
        }

        // Filter kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $buku      = $query->latest()->paginate(12)->withQueryString();
        $kategoris = Kategori::all();

        return view('anggota.katalog.index', compact('buku', 'kategoris'));
    }

    public function show(Buku $buku): View
    {
        $buku->load('kategori');

        // Cek apakah anggota ini sudah punya peminjaman aktif untuk buku ini
        $anggota = auth()->user()->anggota;
        $sudahAjukan = false;
        if ($anggota) {
            $sudahAjukan = Peminjaman::where('anggota_id', $anggota->id)
                ->where('buku_id', $buku->id)
                ->whereIn('status', ['menunggu', 'dipinjam'])
                ->exists();
        }

        return view('anggota.katalog.show', compact('buku', 'sudahAjukan'));
    }

    public function ajukan(Request $request, Buku $buku): RedirectResponse
    {
        $anggota = auth()->user()->anggota;

        if (!$anggota) {
            return back()->with('error', 'Data anggota tidak ditemukan.');
        }

        if ($anggota->status !== 'aktif') {
            return back()->with('error', 'Akun anggota Anda tidak aktif.');
        }

        if ($buku->stok_tersedia <= 0) {
            return back()->with('error', 'Stok buku tidak tersedia.');
        }

        // Cek sudah ada pengajuan aktif
        $sudahAjukan = Peminjaman::where('anggota_id', $anggota->id)
            ->where('buku_id', $buku->id)
            ->whereIn('status', ['menunggu', 'dipinjam'])
            ->exists();

        if ($sudahAjukan) {
            return back()->with('error', 'Kamu sudah mengajukan atau sedang meminjam buku ini.');
        }

        Peminjaman::create([
            'anggota_id'          => $anggota->id,
            'buku_id'             => $buku->id,
            'admin_id'            => null,
            'tanggal_pinjam'      => Carbon::today(),
            'tanggal_jatuh_tempo' => Carbon::today()->addDays(7),
            'status'              => 'menunggu',
            'catatan'             => null,
        ]);

        return redirect()->route('anggota.riwayat.index')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim. Menunggu konfirmasi admin.');
    }
}