<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Models\Pkl;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public function index()
    {
        $siswa = auth()->user()->siswa;
        $pklIds = $siswa->pkl()->pluck('id');
        $jurnal = Jurnal::with('pkl')->whereIn('pkl_id', $pklIds)->latest()->get();
        return view('siswa.jurnal.index', compact('jurnal'));
    }

    public function create()
    {
        $siswa = auth()->user()->siswa;
        $pkl = $siswa->pkl()->whereIn('status', ['disetujui', 'selesai'])->get();

        if ($pkl->isEmpty()) {
            return redirect()->route('siswa.jurnal.index')->with('error', 'Anda belum memiliki PKL yang disetujui.');
        }

        return view('siswa.jurnal.create', compact('pkl'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pkl_id' => 'required|exists:pkls,id',
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string',
            'dokumentasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $siswa = auth()->user()->siswa;
        $pkl = Pkl::findOrFail($request->pkl_id);

        if ($pkl->siswa_id !== $siswa->id) {
            abort(403);
        }

        $data = $request->only('pkl_id', 'tanggal', 'kegiatan');

        if ($request->hasFile('dokumentasi')) {
            $file = $request->file('dokumentasi');
            $filename = 'dokumentasi_' . time() . '_' . $file->getClientOriginalName();
            $data['dokumentasi'] = $file->storeAs('dokumentasi', $filename, 'public');
        }

        Jurnal::create($data);

        return redirect()->route('siswa.jurnal.index')->with('success', 'Jurnal berhasil ditambahkan.');
    }

    public function edit(Jurnal $jurnal)
    {
        $this->authorizeJurnal($jurnal);
        $siswa = auth()->user()->siswa;
        $pkl = $siswa->pkl()->whereIn('status', ['disetujui', 'selesai'])->get();
        return view('siswa.jurnal.edit', compact('jurnal', 'pkl'));
    }

    public function update(Request $request, Jurnal $jurnal)
    {
        $this->authorizeJurnal($jurnal);

        $request->validate([
            'pkl_id' => 'required|exists:pkls,id',
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string',
            'dokumentasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('pkl_id', 'tanggal', 'kegiatan');

        if ($request->hasFile('dokumentasi')) {
            $file = $request->file('dokumentasi');
            $filename = 'dokumentasi_' . time() . '_' . $file->getClientOriginalName();
            $data['dokumentasi'] = $file->storeAs('dokumentasi', $filename, 'public');

            if ($jurnal->dokumentasi) {
                \Storage::disk('public')->delete($jurnal->dokumentasi);
            }
        }

        $jurnal->update($data);

        return redirect()->route('siswa.jurnal.index')->with('success', 'Jurnal berhasil diupdate.');
    }

    public function destroy(Jurnal $jurnal)
    {
        $this->authorizeJurnal($jurnal);
        if ($jurnal->dokumentasi) {
            \Storage::disk('public')->delete($jurnal->dokumentasi);
        }
        $jurnal->delete();
        return redirect()->route('siswa.jurnal.index')->with('success', 'Jurnal berhasil dihapus.');
    }

    private function authorizeJurnal(Jurnal $jurnal)
    {
        $siswa = auth()->user()->siswa;
        $pklIds = $siswa->pkl()->pluck('id');
        if (!in_array($jurnal->pkl_id, $pklIds->toArray())) {
            abort(403);
        }
    }
}
