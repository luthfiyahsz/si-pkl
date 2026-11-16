@extends('layouts.main')
@section('title', 'Edit Guru')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Edit Guru</h5>
    <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.guru.update', $guru) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">NIP <span class="text-danger">*</span></label>
                    <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip', $guru->nip) }}" required>
                    @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $guru->user->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $guru->user->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Gelar</label>
                    <input type="text" name="gelar" class="form-control" value="{{ old('gelar', $guru->gelar) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">No. Telp</label>
                    <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $guru->user->no_telp) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $guru->user->alamat) }}</textarea>
                </div>
            </div>
            <div class="mt-4"><button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button></div>
        </form>
    </div>
</div>
@endsection
