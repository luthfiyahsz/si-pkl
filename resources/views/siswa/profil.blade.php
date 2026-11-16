@extends('layouts.main')
@section('title', 'Profil Saya')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Profil Saya</h5>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                @if($user->foto)
                <img src="{{ asset('storage/'.$user->foto) }}" class="img-thumbnail mb-3" width="200">
                @else
                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:150px;height:150px">
                    <i class="bi bi-person-fill text-muted" style="font-size:4rem"></i>
                </div>
                @endif
                <h5>{{ $user->name }}</h5>
                <p class="text-muted">{{ $siswa->nis }} | {{ $siswa->kelas ?? '-' }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Edit Profil</div>
            <div class="card-body">
                <form method="POST" action="{{ route('siswa.profil.update') }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Telp</label>
                            <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $user->no_telp) }}">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $user->alamat) }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Foto Profil</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password Baru (kosongkan jika tidak diubah)</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>
                    <div class="mt-4"><button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
