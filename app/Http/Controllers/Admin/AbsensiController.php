<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::with('siswa.user')->latest()->get();
        $today = now()->format('Y-m-d');
        $todayHadir = Absensi::where('tanggal', $today)->count();
        $totalSiswa = \App\Models\Siswa::count();
        $belumAbsen = $totalSiswa - Absensi::where('tanggal', $today)->count();

        return view('admin.absensi.index', compact('absensi', 'todayHadir', 'totalSiswa', 'belumAbsen'));
    }
}
