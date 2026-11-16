<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $siswa = auth()->user()->siswa;
        $absensi = Absensi::where('siswa_id', $siswa->id)->latest()->get();
        return view('siswa.absensi.index', compact('absensi'));
    }

    public function create()
    {
        $siswa = auth()->user()->siswa;
        $today = now()->format('Y-m-d');
        $alreadyAbsen = Absensi::where('siswa_id', $siswa->id)->where('tanggal', $today)->exists();
        return view('siswa.absensi.create', compact('alreadyAbsen'));
    }

    public function store(Request $request)
    {
        $siswa = auth()->user()->siswa;
        $today = now()->format('Y-m-d');

        $alreadyAbsen = Absensi::where('siswa_id', $siswa->id)->where('tanggal', $today)->exists();
        if ($alreadyAbsen) {
            return redirect()->route('siswa.absensi.index')->with('error', 'Anda sudah absen hari ini.');
        }

        $request->validate([
            'status' => 'required|in:hadir,sakit,izin,alpha',
            'keterangan' => 'nullable|string',
        ]);

        Absensi::create([
            'siswa_id' => $siswa->id,
            'tanggal' => $today,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('siswa.absensi.index')->with('success', 'Absensi berhasil dicatat.');
    }
}
