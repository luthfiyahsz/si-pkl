<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        $perusahaan = Perusahaan::with('user')->latest()->get();
        return view('admin.perusahaan.index', compact('perusahaan'));
    }

    public function create()
    {
        return view('admin.perusahaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'kontak_person' => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
            'no_telp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'perusahaan',
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'active' => true,
        ]);

        Perusahaan::create([
            'user_id' => $user->id,
            'kontak_person' => $request->kontak_person,
            'website' => $request->website,
        ]);

        return redirect()->route('admin.perusahaan.index')->with('success', 'Perusahaan berhasil ditambahkan.');
    }

    public function show(Perusahaan $perusahaan)
    {
        $perusahaan->load('user', 'pkl');
        return view('admin.perusahaan.show', compact('perusahaan'));
    }

    public function edit(Perusahaan $perusahaan)
    {
        $perusahaan->load('user');
        return view('admin.perusahaan.edit', compact('perusahaan'));
    }

    public function update(Request $request, Perusahaan $perusahaan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $perusahaan->user_id,
            'kontak_person' => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
            'no_telp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'password' => 'nullable|string|min:8',
        ]);

        $perusahaan->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        if ($request->password) {
            $perusahaan->user->update(['password' => $request->password]);
        }

        $perusahaan->update([
            'kontak_person' => $request->kontak_person,
            'website' => $request->website,
        ]);

        return redirect()->route('admin.perusahaan.index')->with('success', 'Perusahaan berhasil diupdate.');
    }

    public function destroy(Perusahaan $perusahaan)
    {
        $perusahaan->user->delete();
        $perusahaan->delete();
        return redirect()->route('admin.perusahaan.index')->with('success', 'Perusahaan berhasil dihapus.');
    }
}
