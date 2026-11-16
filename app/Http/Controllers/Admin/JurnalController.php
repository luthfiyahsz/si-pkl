<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public function index()
    {
        $jurnal = Jurnal::with(['pkl.siswa.user', 'pkl.guru.user'])->latest()->get();
        return view('admin.jurnal.index', compact('jurnal'));
    }

    public function show(Jurnal $jurnal)
    {
        $jurnal->load(['pkl.siswa.user', 'pkl.guru.user', 'pkl.perusahaan.user']);
        return view('admin.jurnal.show', compact('jurnal'));
    }
}
