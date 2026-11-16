<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Pkl;

class SiswaController extends Controller
{
    public function index()
    {
        $guru = auth()->user()->guru;
        $pkl = Pkl::with(['siswa.user', 'perusahaan.user'])
            ->where('guru_id', $guru->id)
            ->latest()
            ->get();
        return view('guru.siswa.index', compact('pkl'));
    }
}
