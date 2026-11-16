<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public function index()
    {
        $guru = auth()->user()->guru;
        $jurnal = Jurnal::with(['pkl.siswa.user'])
            ->whereIn('pkl_id', $guru->pkl()->pluck('id'))
            ->latest()
            ->get();
        return view('guru.jurnal.index', compact('jurnal'));
    }

    public function show(Jurnal $jurnal)
    {
        $this->authorizeJurnal($jurnal);
        $jurnal->load(['pkl.siswa.user', 'pkl.perusahaan.user']);
        return view('guru.jurnal.show', compact('jurnal'));
    }

    public function approve(Jurnal $jurnal)
    {
        $this->authorizeJurnal($jurnal);
        $jurnal->update(['status_dosen' => 'disetujui']);
        return redirect()->back()->with('success', 'Jurnal berhasil disetujui.');
    }

    public function reject(Request $request, Jurnal $jurnal)
    {
        $this->authorizeJurnal($jurnal);
        $request->validate(['komentar_dosen' => 'required|string']);
        $jurnal->update([
            'status_dosen' => 'ditolak',
            'komentar_dosen' => $request->komentar_dosen,
        ]);
        return redirect()->back()->with('success', 'Jurnal ditolak.');
    }

    public function komentar(Request $request, Jurnal $jurnal)
    {
        $this->authorizeJurnal($jurnal);
        $request->validate(['komentar_dosen' => 'required|string']);
        $jurnal->update(['komentar_dosen' => $request->komentar_dosen]);
        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    private function authorizeJurnal(Jurnal $jurnal)
    {
        $guru = auth()->user()->guru;
        $pklIds = $guru->pkl()->pluck('id');
        if (!in_array($jurnal->pkl_id, $pklIds->toArray())) {
            abort(403);
        }
    }
}
