<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class RiwayatController extends Controller
{
    public function index(): View
    {
        $anggota = auth()->user()->anggota;

        if (!$anggota) {
            abort(403, 'Data anggota tidak ditemukan.');
        }

        $peminjaman = $anggota->peminjaman()
            ->with(['buku', 'denda'])
            ->latest()
            ->paginate(10);

        $totalDendaBelumBayar = $anggota->peminjaman()
            ->with('denda')
            ->get()
            ->pluck('denda')
            ->filter()
            ->where('status_bayar', 'belum_bayar')
            ->sum('total_denda');

        return view('anggota.riwayat.index', compact('peminjaman', 'totalDendaBelumBayar'));
    }
}