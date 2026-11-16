<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\Admin\GuruController as AdminGuruController;
use App\Http\Controllers\Admin\PerusahaanController as AdminPerusahaanController;
use App\Http\Controllers\Admin\PklController as AdminPklController;
use App\Http\Controllers\Admin\JurnalController as AdminJurnalController;
use App\Http\Controllers\Admin\PenilaianController as AdminPenilaianController;
use App\Http\Controllers\Admin\AbsensiController as AdminAbsensiController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\PklController as SiswaPklController;
use App\Http\Controllers\Siswa\JurnalController as SiswaJurnalController;
use App\Http\Controllers\Siswa\ProfilController as SiswaProfilController;
use App\Http\Controllers\Siswa\AbsensiController as SiswaAbsensiController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\SiswaController as GuruSiswaController;
use App\Http\Controllers\Guru\JurnalController as GuruJurnalController;
use App\Http\Controllers\Guru\PenilaianController as GuruPenilaianController;
use App\Http\Controllers\Perusahaan\DashboardController as PerusahaanDashboardController;
use App\Http\Controllers\Perusahaan\SiswaController as PerusahaanSiswaController;
use App\Http\Controllers\Perusahaan\JurnalController as PerusahaanJurnalController;
use App\Http\Controllers\Perusahaan\PenilaianController as PerusahaanPenilaianController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role == 'admin') return redirect()->route('admin.dashboard');
        if ($user->role == 'siswa') return redirect()->route('siswa.dashboard');
        if ($user->role == 'guru') return redirect()->route('guru.dashboard');
        if ($user->role == 'perusahaan') return redirect()->route('perusahaan.dashboard');
    })->name('dashboard');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('siswa', AdminSiswaController::class);
        Route::resource('guru', AdminGuruController::class);
        Route::resource('perusahaan', AdminPerusahaanController::class);
        Route::resource('pkl', AdminPklController::class);
        Route::get('/jurnal', [AdminJurnalController::class, 'index'])->name('jurnal.index');
        Route::get('/jurnal/{jurnal}', [AdminJurnalController::class, 'show'])->name('jurnal.show');
        Route::get('/penilaian', [AdminPenilaianController::class, 'index'])->name('penilaian.index');
        Route::get('/penilaian/{penilaian}', [AdminPenilaianController::class, 'show'])->name('penilaian.show');
        Route::get('/absensi', [AdminAbsensiController::class, 'index'])->name('absensi.index');
    });

    // Siswa Routes
    Route::prefix('siswa')->name('siswa.')->middleware('role:siswa')->group(function () {
        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
        Route::resource('pkl', SiswaPklController::class);
        Route::post('/pkl/{pkl}/laporan', [SiswaPklController::class, 'uploadLaporan'])->name('pkl.laporan');
        Route::resource('jurnal', SiswaJurnalController::class);
        Route::get('/profil', [SiswaProfilController::class, 'edit'])->name('profil');
        Route::put('/profil', [SiswaProfilController::class, 'update'])->name('profil.update');
        Route::get('/absensi', [SiswaAbsensiController::class, 'index'])->name('absensi.index');
        Route::get('/absensi/create', [SiswaAbsensiController::class, 'create'])->name('absensi.create');
        Route::post('/absensi', [SiswaAbsensiController::class, 'store'])->name('absensi.store');
    });

    // Guru Routes
    Route::prefix('guru')->name('guru.')->middleware('role:guru')->group(function () {
        Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');
        Route::get('/siswa', [GuruSiswaController::class, 'index'])->name('siswa.index');
        Route::get('/jurnal', [GuruJurnalController::class, 'index'])->name('jurnal.index');
        Route::get('/jurnal/{jurnal}', [GuruJurnalController::class, 'show'])->name('jurnal.show');
        Route::post('/jurnal/{jurnal}/approve', [GuruJurnalController::class, 'approve'])->name('jurnal.approve');
        Route::post('/jurnal/{jurnal}/reject', [GuruJurnalController::class, 'reject'])->name('jurnal.reject');
        Route::post('/jurnal/{jurnal}/komentar', [GuruJurnalController::class, 'komentar'])->name('jurnal.komentar');
        Route::get('/penilaian', [GuruPenilaianController::class, 'index'])->name('penilaian.index');
        Route::get('/penilaian/create/{pkl}', [GuruPenilaianController::class, 'create'])->name('penilaian.create');
        Route::post('/penilaian', [GuruPenilaianController::class, 'store'])->name('penilaian.store');
        Route::get('/penilaian/{penilaian}/edit', [GuruPenilaianController::class, 'edit'])->name('penilaian.edit');
        Route::put('/penilaian/{penilaian}', [GuruPenilaianController::class, 'update'])->name('penilaian.update');
    });

    // Perusahaan Routes
    Route::prefix('perusahaan')->name('perusahaan.')->middleware('role:perusahaan')->group(function () {
        Route::get('/dashboard', [PerusahaanDashboardController::class, 'index'])->name('dashboard');
        Route::get('/siswa', [PerusahaanSiswaController::class, 'index'])->name('siswa.index');
        Route::get('/jurnal', [PerusahaanJurnalController::class, 'index'])->name('jurnal.index');
        Route::get('/jurnal/{jurnal}', [PerusahaanJurnalController::class, 'show'])->name('jurnal.show');
        Route::post('/jurnal/{jurnal}/komentar', [PerusahaanJurnalController::class, 'komentar'])->name('jurnal.komentar');
        Route::get('/penilaian', [PerusahaanPenilaianController::class, 'index'])->name('penilaian.index');
        Route::get('/penilaian/create/{pkl}', [PerusahaanPenilaianController::class, 'create'])->name('penilaian.create');
        Route::post('/penilaian', [PerusahaanPenilaianController::class, 'store'])->name('penilaian.store');
        Route::get('/penilaian/{penilaian}/edit', [PerusahaanPenilaianController::class, 'edit'])->name('penilaian.edit');
        Route::put('/penilaian/{penilaian}', [PerusahaanPenilaianController::class, 'update'])->name('penilaian.update');
    });
});

require __DIR__.'/auth.php';
