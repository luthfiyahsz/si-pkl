<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Pkl;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $perusahaan = auth()->user()->perusahaan;
        $pkl = Pkl::with(['siswa.user', 'guru.user'])
            ->where('perusahaan_id', $perusahaan->id)
            ->latest()
            ->get();
        return view('perusahaan.siswa.index', compact('pkl'));
    }
}
