<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Models\Pkl;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $perusahaan = auth()->user()->perusahaan;
        $totalSiswa = Pkl::where('perusahaan_id', $perusahaan->id)->count();
        $totalPklAktif = Pkl::where('perusahaan_id', $perusahaan->id)
            ->whereIn('status', ['disetujui', 'selesai'])
            ->count();
        $totalJurnalPending = Jurnal::whereIn('pkl_id', Pkl::where('perusahaan_id', $perusahaan->id)->pluck('id'))
            ->where('status_perusahaan', 'pending')
            ->count();

        return view('perusahaan.dashboard', compact('perusahaan', 'totalSiswa', 'totalPklAktif', 'totalJurnalPending'));
    }
}
