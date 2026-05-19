<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalBuku = Buku::count();

        $totalAnggota = Anggota::count();

        $sedangDipinjam = Peminjaman::where('status', 'dipinjam')->count();

        $menungguKonfirmasi = Peminjaman::where('status', 'pending')->count();

        $aktivitasTerbaru = Peminjaman::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBuku',
            'totalAnggota',
            'sedangDipinjam',
            'menungguKonfirmasi',
            'aktivitasTerbaru'
        ));
    }
}