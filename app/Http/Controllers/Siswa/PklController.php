<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Perusahaan;
use App\Models\Pkl;
use Illuminate\Http\Request;

class PklController extends Controller
{
    public function index()
    {
        $siswa = auth()->user()->siswa;
        $pkl = $siswa->pkl()->with('guru.user', 'perusahaan.user')->latest()->get();
        return view('siswa.pkl.index', compact('pkl'));
    }

    public function create()
    {
        $guru = Guru::with('user')->get();
        $perusahaan = Perusahaan::with('user')->get();
        return view('siswa.pkl.create', compact('guru', 'perusahaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'nullable|exists:gurus,id',
            'perusahaan_id' => 'nullable|exists:perusahaans,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        $siswa = auth()->user()->siswa;

        Pkl::create([
            'siswa_id' => $siswa->id,
            'guru_id' => $request->guru_id,
            'perusahaan_id' => $request->perusahaan_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'pengajuan',
        ]);

        return redirect()->route('siswa.pkl.index')->with('success', 'Pengajuan PKL berhasil dikirim.');
    }

    public function show(Pkl $pkl)
    {
        $this->authorizePkl($pkl);
        $pkl->load(['guru.user', 'perusahaan.user', 'jurnal']);
        return view('siswa.pkl.show', compact('pkl'));
    }

    public function edit(Pkl $pkl)
    {
        $this->authorizePkl($pkl);
        if ($pkl->status != 'pengajuan') {
            return redirect()->route('siswa.pkl.index')->with('error', 'PKL tidak dapat diubah.');
        }
        $guru = Guru::with('user')->get();
        $perusahaan = Perusahaan::with('user')->get();
        return view('siswa.pkl.edit', compact('pkl', 'guru', 'perusahaan'));
    }

    public function update(Request $request, Pkl $pkl)
    {
        $this->authorizePkl($pkl);
        if ($pkl->status != 'pengajuan') {
            return redirect()->route('siswa.pkl.index')->with('error', 'PKL tidak dapat diubah.');
        }

        $request->validate([
            'guru_id' => 'nullable|exists:gurus,id',
            'perusahaan_id' => 'nullable|exists:perusahaans,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        $pkl->update($request->only('guru_id', 'perusahaan_id', 'judul', 'deskripsi', 'tanggal_mulai', 'tanggal_selesai'));

        return redirect()->route('siswa.pkl.index')->with('success', 'PKL berhasil diupdate.');
    }

    public function uploadLaporan(Request $request, Pkl $pkl)
    {
        $this->authorizePkl($pkl);

        $request->validate([
            'laporan_akhir' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('laporan_akhir');
        $filename = 'laporan_' . $pkl->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('laporan', $filename, 'public');

        $pkl->update(['laporan_akhir' => $path]);

        return redirect()->route('siswa.pkl.show', $pkl)->with('success', 'Laporan akhir berhasil diupload.');
    }

    private function authorizePkl(Pkl $pkl)
    {
        $siswa = auth()->user()->siswa;
        if ($pkl->siswa_id !== $siswa->id) {
            abort(403);
        }
    }
}
