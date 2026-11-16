<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jurnal;
use App\Models\Siswa;
use App\Models\Perusahaan;
use App\Models\Pkl;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalPerusahaan = Perusahaan::count();
        $totalPkl = Pkl::count();
        $totalJurnal = Jurnal::count();
        $pklMenunggu = Pkl::where('status', 'pengajuan')->count();
        $siswaList = Siswa::with('user', 'pkl.guru.user', 'pkl.perusahaan.user')->latest()->get();

        return view('admin.dashboard', compact(
            'totalSiswa', 'totalGuru', 'totalPerusahaan',
            'totalPkl', 'totalJurnal', 'pklMenunggu', 'siswaList'
        ));
    }
}
