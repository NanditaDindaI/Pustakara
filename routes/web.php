<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\DendaController;
use App\Http\Controllers\Anggota\DashboardAnggotaController;
use App\Http\Controllers\Anggota\KatalogController;
use App\Http\Controllers\Anggota\RiwayatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/force-logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();

    return redirect('/login');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'administrator') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('anggota.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ================= ADMIN =================
Route::middleware(['auth', 'role:administrator'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // ===== KATEGORI =====
    Route::resource('/kategori', KategoriController::class);

    // ===== BUKU =====
    Route::get('/buku/trash', [BukuController::class, 'trash'])
        ->name('buku.trash');

    Route::post('/buku/{id}/restore', [BukuController::class, 'restore'])
        ->name('buku.restore');

    Route::delete('/buku/{id}/force-delete', [BukuController::class, 'forceDelete'])
        ->name('buku.force-delete');

    Route::resource('/buku', BukuController::class);

    // ===== DATA ANGGOTA =====
    Route::get('/data-anggota/trash', [AnggotaController::class, 'trash'])
        ->name('anggota-admin.trash');

    Route::post('/data-anggota/{anggota}/restore', [AnggotaController::class, 'restore'])
        ->name('anggota-admin.restore');

    Route::delete('/data-anggota/{anggota}/force-delete', [AnggotaController::class, 'forceDelete'])
        ->name('anggota-admin.force-delete');

    Route::resource('/data-anggota', AnggotaController::class)
        ->names('anggota-admin')
        ->parameters([
            'data-anggota' => 'anggota'
        ]);

    // ===== PEMINJAMAN =====
    Route::post('/peminjaman/{peminjaman}/kembalikan', [PeminjamanController::class, 'kembalikan'])
        ->name('peminjaman.kembalikan');

    Route::post('/peminjaman/{peminjaman}/konfirmasi', [PeminjamanController::class, 'konfirmasi'])
        ->name('peminjaman.konfirmasi');

    Route::post('/peminjaman/{peminjaman}/tolak', [PeminjamanController::class, 'tolak'])
        ->name('peminjaman.tolak');

    Route::resource('/peminjaman', PeminjamanController::class);

    // ===== DENDA =====
    Route::resource('/denda', DendaController::class);
});

// ================= ANGGOTA =================
Route::middleware(['auth', 'role:anggota'])
    ->prefix('anggota')
    ->name('anggota.')
    ->group(function () {

        Route::get('/dashboard', [DashboardAnggotaController::class, 'index'])
            ->name('dashboard');

        Route::get('/katalog', [KatalogController::class, 'index'])
            ->name('katalog.index');

        Route::get('/katalog/{buku}', [KatalogController::class, 'show'])
            ->name('katalog.show');

        Route::post('/katalog/{buku}/ajukan', [KatalogController::class, 'ajukan'])
            ->name('katalog.ajukan');

        Route::get('/riwayat', [RiwayatController::class, 'index'])
            ->name('riwayat.index');
    });

// ================= PROFILE =================
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';