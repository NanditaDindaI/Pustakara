<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Denda;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DendaController extends Controller
{
    public function index(): View
    {
        $dendas = Denda::with(['peminjaman.anggota', 'peminjaman.buku'])
            ->latest()
            ->paginate(10);

        $totalBelumBayar = Denda::where('status_bayar', 'belum_bayar')->sum('total_denda');
        $totalSudahBayar = Denda::where('status_bayar', 'sudah_bayar')->sum('total_denda');

        return view('admin.denda.index', compact('dendas', 'totalBelumBayar', 'totalSudahBayar'));
    }

    public function show(Denda $denda): View
    {
        $denda->load(['peminjaman.anggota', 'peminjaman.buku']);
        return view('admin.denda.show', compact('denda'));
    }

    // Tandai denda sudah dibayar — PATCH /denda/{denda}
    public function update(Request $request, Denda $denda): RedirectResponse
    {
        if ($denda->status_bayar === 'sudah_bayar') {
            return back()->with('info', 'Denda ini sudah dibayar sebelumnya.');
        }

        $denda->update([
            'status_bayar'  => 'sudah_bayar',
            'tanggal_bayar' => now()->toDateString(),
        ]);

        return back()->with('success', 'Denda berhasil ditandai sudah bayar.');
    }
}