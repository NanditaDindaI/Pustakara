<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Denda;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index(): View
    {
        $peminjaman = Peminjaman::with(['anggota', 'buku', 'admin'])->latest()->get();
        return view('admin.peminjaman.index', compact('peminjaman'));
    }

    public function create(): View
    {
        $anggota = Anggota::where('status', 'aktif')->get();
        $buku    = Buku::where('stok_tersedia', '>', 0)->get();
        return view('admin.peminjaman.create', compact('anggota', 'buku'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'buku_id'    => 'required|exists:buku,id',
            'catatan'    => 'nullable|string',
        ]);

        $tanggalPinjam     = Carbon::today();
        $tanggalJatuhTempo = Carbon::today()->addDays(7);

        Peminjaman::create([
            'anggota_id'          => $request->anggota_id,
            'buku_id'             => $request->buku_id,
            'admin_id'            => auth()->id(),
            'tanggal_pinjam'      => $tanggalPinjam,
            'tanggal_jatuh_tempo' => $tanggalJatuhTempo,
            'status'              => 'dipinjam',
            'catatan'             => $request->catatan,
        ]);

        Buku::findOrFail($request->buku_id)->decrement('stok_tersedia');

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dicatat.');
    }

    public function show(Peminjaman $peminjaman): View
    {
        $peminjaman->load(['anggota', 'buku', 'admin', 'denda']);
        return view('admin.peminjaman.show', compact('peminjaman'));
    }

    // Konfirmasi pengajuan dari anggota
    public function konfirmasi(Peminjaman $peminjaman): RedirectResponse
    {
        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Pengajuan ini tidak dalam status menunggu.');
        }

        if ($peminjaman->buku->stok_tersedia <= 0) {
            return back()->with('error', 'Stok buku tidak tersedia.');
        }

        $peminjaman->update([
            'admin_id'            => auth()->id(),
            'tanggal_pinjam'      => Carbon::today(),
            'tanggal_jatuh_tempo' => Carbon::today()->addDays(7),
            'status'              => 'dipinjam',
        ]);

        $peminjaman->buku->decrement('stok_tersedia');

        return back()->with('success', 'Pengajuan berhasil dikonfirmasi. Buku sedang dipinjam.');
    }

    // Tolak pengajuan dari anggota
    public function tolak(Peminjaman $peminjaman): RedirectResponse
    {
        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Pengajuan ini tidak dalam status menunggu.');
        }

        $peminjaman->update([
            'admin_id' => auth()->id(),
            'status'   => 'ditolak',
        ]);

        return back()->with('success', 'Pengajuan berhasil ditolak.');
    }

    public function kembalikan(Peminjaman $peminjaman): RedirectResponse
    {
        if ($peminjaman->status !== 'dipinjam') {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Status peminjaman tidak valid.');
        }

        $tanggalKembali    = Carbon::today();
        $tanggalJatuhTempo = Carbon::parse($peminjaman->tanggal_jatuh_tempo);

        $peminjaman->update([
            'tanggal_kembali' => $tanggalKembali->toDateString(),
            'status'          => 'dikembalikan',
        ]);

        $peminjaman->buku->increment('stok_tersedia');

        if ($tanggalKembali->gt($tanggalJatuhTempo)) {
            $jumlahHari     = $tanggalJatuhTempo->diffInDays($tanggalKembali);
            $nominalPerHari = 2000;
            $totalDenda     = $jumlahHari * $nominalPerHari;

            Denda::create([
                'peminjaman_id'    => $peminjaman->id,
                'jumlah_hari'      => $jumlahHari,
                'nominal_per_hari' => $nominalPerHari,
                'total_denda'      => $totalDenda,
                'status_bayar'     => 'belum_bayar',
                'tanggal_bayar'    => null,
            ]);

            return redirect()->route('peminjaman.index')
                ->with('warning', "Buku terlambat {$jumlahHari} hari. "
                    . "Denda Rp " . number_format($totalDenda, 0, ',', '.') . " telah dicatat.");
        }

        return redirect()->route('peminjaman.index')
            ->with('success', 'Buku berhasil dikembalikan tepat waktu. Tidak ada denda.');
    }

    public function destroy(Peminjaman $peminjaman): RedirectResponse
    {
        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->buku->increment('stok_tersedia');
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }
}