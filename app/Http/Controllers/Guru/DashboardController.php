<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;

class DashboardController extends Controller
{
    public function index()
    {
        $guru = auth()->user()->guru;
        $totalSiswaBimbingan = $guru->pkl()->count();
        $totalJurnalPending = Jurnal::whereIn('pkl_id', $guru->pkl()->pluck('id'))
            ->where('status_dosen', 'pending')
            ->count();
        $totalJurnalDisetujui = Jurnal::whereIn('pkl_id', $guru->pkl()->pluck('id'))
            ->where('status_dosen', 'disetujui')
            ->count();
        $pkl = $guru->pkl()->with('siswa.user', 'perusahaan.user')->latest()->get();

        return view('guru.dashboard', compact('guru', 'totalSiswaBimbingan', 'totalJurnalPending', 'totalJurnalDisetujui', 'pkl'));
    }
}
