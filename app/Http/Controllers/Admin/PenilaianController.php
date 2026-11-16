<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $penilaian = Penilaian::with(['pkl.siswa.user', 'guru.user', 'perusahaan.user'])->latest()->get();
        return view('admin.penilaian.index', compact('penilaian'));
    }

    public function show(Penilaian $penilaian)
    {
        $penilaian->load(['pkl.siswa.user', 'guru.user', 'perusahaan.user']);
        return view('admin.penilaian.show', compact('penilaian'));
    }
}
