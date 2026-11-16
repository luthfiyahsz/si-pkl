<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::with('user')->latest()->get();
        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'nip' => 'required|string|max:20|unique:gurus,nip',
            'gelar' => 'nullable|string|max:50',
            'no_telp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'guru',
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'active' => true,
        ]);

        Guru::create([
            'user_id' => $user->id,
            'nip' => $request->nip,
            'gelar' => $request->gelar,
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil ditambahkan.');
    }

    public function show(Guru $guru)
    {
        $guru->load('user', 'pkl');
        return view('admin.guru.show', compact('guru'));
    }

    public function edit(Guru $guru)
    {
        $guru->load('user');
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $guru->user_id,
            'nip' => 'required|string|max:20|unique:gurus,nip,' . $guru->id,
            'gelar' => 'nullable|string|max:50',
            'no_telp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'password' => 'nullable|string|min:8',
        ]);

        $guru->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        if ($request->password) {
            $guru->user->update(['password' => $request->password]);
        }

        $guru->update([
            'nip' => $request->nip,
            'gelar' => $request->gelar,
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil diupdate.');
    }

    public function destroy(Guru $guru)
    {
        $guru->user->delete();
        $guru->delete();
        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil dihapus.');
    }
}
