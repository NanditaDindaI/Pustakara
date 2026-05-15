<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardAnggotaController extends Controller
{
    public function index(): View
    {
        $anggota = auth()->user()->anggota;

        if (!$anggota) {
            abort(403, 'Data anggota tidak ditemukan. Hubungi admin.');
        }

        $totalPinjam        = $anggota->peminjaman()->count();
        $sedangDipinjam     = $anggota->peminjaman()->where('status', 'dipinjam')->count();
        $menungguKonfirmasi = $anggota->peminjaman()->where('status', 'menunggu')->count();
        $totalDenda         = $anggota->peminjaman()
            ->with('denda')
            ->get()
            ->pluck('denda')
            ->filter()
            ->where('status_bayar', 'belum_bayar')
            ->sum('total_denda');

        $peminjamanAktif = $anggota->peminjaman()
            ->with('buku')
            ->whereIn('status', ['menunggu', 'dipinjam'])
            ->latest()
            ->get();

        return view('anggota.dashboard', compact(
            'anggota',
            'totalPinjam',
            'sedangDipinjam',
            'menungguKonfirmasi',
            'totalDenda',
            'peminjamanAktif'
        ));
    }
}