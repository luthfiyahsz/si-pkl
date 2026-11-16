<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $siswa = $user->siswa;
        return view('siswa.profil', compact('user', 'siswa'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $siswa = $user->siswa;

        $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $userData = [
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'foto_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $userData['foto'] = $file->storeAs('foto', $filename, 'public');
        }

        if ($request->password) {
            $userData['password'] = $request->password;
        }

        $user->update($userData);

        return redirect()->route('siswa.profil')->with('success', 'Profil berhasil diupdate.');
    }
}
