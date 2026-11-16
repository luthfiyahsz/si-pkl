<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public function index()
    {
        $perusahaan = auth()->user()->perusahaan;
        $jurnal = Jurnal::with(['pkl.siswa.user'])
            ->whereIn('pkl_id', $perusahaan->pkl()->pluck('id'))
            ->latest()
            ->get();
        return view('perusahaan.jurnal.index', compact('jurnal'));
    }

    public function show(Jurnal $jurnal)
    {
        $this->authorizeJurnal($jurnal);
        $jurnal->load(['pkl.siswa.user', 'pkl.guru.user']);
        return view('perusahaan.jurnal.show', compact('jurnal'));
    }

    public function komentar(Request $request, Jurnal $jurnal)
    {
        $this->authorizeJurnal($jurnal);
        $request->validate(['komentar_perusahaan' => 'required|string']);
        $jurnal->update([
            'komentar_perusahaan' => $request->komentar_perusahaan,
            'status_perusahaan' => $request->has('status_perusahaan') ? $request->status_perusahaan : $jurnal->status_perusahaan,
        ]);
        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    private function authorizeJurnal(Jurnal $jurnal)
    {
        $perusahaan = auth()->user()->perusahaan;
        $pklIds = $perusahaan->pkl()->pluck('id');
        if (!in_array($jurnal->pkl_id, $pklIds->toArray())) {
            abort(403);
        }
    }
}
