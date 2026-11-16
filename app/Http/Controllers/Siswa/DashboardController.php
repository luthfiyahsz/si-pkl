<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa = auth()->user()->siswa;
        $pkl = $siswa->pkl()->with('guru.user', 'perusahaan.user')->latest()->get();
        $totalPkl = $pkl->count();
        $pklDisetujui = $pkl->where('status', 'disetujui')->count();
        $totalJurnal = Jurnal::whereIn('pkl_id', $pkl->pluck('id'))->count();

        return view('siswa.dashboard', compact('siswa', 'pkl', 'totalPkl', 'pklDisetujui', 'totalJurnal'));
    }
}
