<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use App\Models\Pkl;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $perusahaan = auth()->user()->perusahaan;
        $penilaian = Penilaian::with(['pkl.siswa.user'])
            ->where('perusahaan_id', $perusahaan->id)
            ->latest()
            ->get();
        return view('perusahaan.penilaian.index', compact('penilaian'));
    }

    public function create(Pkl $pkl)
    {
        $this->authorizePkl($pkl);
        $pkl->load('siswa.user');
        return view('perusahaan.penilaian.create', compact('pkl'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pkl_id' => 'required|exists:pkls,id',
            'nilai_kedisiplinan' => 'required|integer|min:0|max:100',
            'nilai_kerjasama' => 'required|integer|min:0|max:100',
            'nilai_pengetahuan' => 'required|integer|min:0|max:100',
            'nilai_keterampilan' => 'required|integer|min:0|max:100',
            'nilai_laporan' => 'required|integer|min:0|max:100',
            'komentar' => 'nullable|string',
        ]);

        $perusahaan = auth()->user()->perusahaan;
        $pkl = Pkl::findOrFail($request->pkl_id);

        if ($pkl->perusahaan_id !== $perusahaan->id) {
            abort(403);
        }

        $total = ($request->nilai_kedisiplinan + $request->nilai_kerjasama +
                  $request->nilai_pengetahuan + $request->nilai_keterampilan +
                  $request->nilai_laporan) / 5;

        Penilaian::updateOrCreate(
            ['pkl_id' => $pkl->id, 'perusahaan_id' => $perusahaan->id],
            [
                'guru_id' => $pkl->guru_id,
                'nilai_kedisiplinan' => $request->nilai_kedisiplinan,
                'nilai_kerjasama' => $request->nilai_kerjasama,
                'nilai_pengetahuan' => $request->nilai_pengetahuan,
                'nilai_keterampilan' => $request->nilai_keterampilan,
                'nilai_laporan' => $request->nilai_laporan,
                'total_nilai' => round($total),
                'komentar' => $request->komentar,
            ]
        );

        return redirect()->route('perusahaan.penilaian.index')->with('success', 'Penilaian berhasil disimpan.');
    }

    public function edit(Penilaian $penilaian)
    {
        $perusahaan = auth()->user()->perusahaan;
        if ($penilaian->perusahaan_id !== $perusahaan->id) abort(403);
        $penilaian->load('pkl.siswa.user');
        return view('perusahaan.penilaian.edit', compact('penilaian'));
    }

    public function update(Request $request, Penilaian $penilaian)
    {
        $perusahaan = auth()->user()->perusahaan;
        if ($penilaian->perusahaan_id !== $perusahaan->id) abort(403);

        $request->validate([
            'nilai_kedisiplinan' => 'required|integer|min:0|max:100',
            'nilai_kerjasama' => 'required|integer|min:0|max:100',
            'nilai_pengetahuan' => 'required|integer|min:0|max:100',
            'nilai_keterampilan' => 'required|integer|min:0|max:100',
            'nilai_laporan' => 'required|integer|min:0|max:100',
            'komentar' => 'nullable|string',
        ]);

        $total = ($request->nilai_kedisiplinan + $request->nilai_kerjasama +
                  $request->nilai_pengetahuan + $request->nilai_keterampilan +
                  $request->nilai_laporan) / 5;

        $penilaian->update([
            'nilai_kedisiplinan' => $request->nilai_kedisiplinan,
            'nilai_kerjasama' => $request->nilai_kerjasama,
            'nilai_pengetahuan' => $request->nilai_pengetahuan,
            'nilai_keterampilan' => $request->nilai_keterampilan,
            'nilai_laporan' => $request->nilai_laporan,
            'total_nilai' => round($total),
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('perusahaan.penilaian.index')->with('success', 'Penilaian berhasil diupdate.');
    }

    private function authorizePkl(Pkl $pkl)
    {
        $perusahaan = auth()->user()->perusahaan;
        if ($pkl->perusahaan_id !== $perusahaan->id) abort(403);
    }
}
