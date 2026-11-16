<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pkl;
use Illuminate\Http\Request;

class PklController extends Controller
{
    public function index()
    {
        $pkl = Pkl::with(['siswa.user', 'guru.user', 'perusahaan.user'])->latest()->get();
        return view('admin.pkl.index', compact('pkl'));
    }

    public function show(Pkl $pkl)
    {
        $pkl->load(['siswa.user', 'guru.user', 'perusahaan.user', 'jurnal']);
        return view('admin.pkl.show', compact('pkl'));
    }

    public function edit(Pkl $pkl)
    {
        $pkl->load(['siswa.user', 'guru.user', 'perusahaan.user']);
        return view('admin.pkl.edit', compact('pkl'));
    }

    public function update(Request $request, Pkl $pkl)
    {
        $request->validate([
            'status' => 'required|in:pengajuan,disetujui,ditolak,selesai',
            'catatan' => 'nullable|string',
        ]);

        $pkl->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.pkl.index')->with('success', 'Status PKL berhasil diupdate.');
    }

    public function destroy(Pkl $pkl)
    {
        $pkl->delete();
        return redirect()->route('admin.pkl.index')->with('success', 'PKL berhasil dihapus.');
    }
}
