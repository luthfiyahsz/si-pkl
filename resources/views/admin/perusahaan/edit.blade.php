@extends('layouts.main')
@section('title', 'Edit Perusahaan')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Edit Perusahaan</h5>
    <a href="{{ route('admin.perusahaan.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.perusahaan.update', $perusahaan) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $perusahaan->user->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $perusahaan->user->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kontak Person</label>
                    <input type="text" name="kontak_person" class="form-control" value="{{ old('kontak_person', $perusahaan->kontak_person) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">No. Telp</label>
                    <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $perusahaan->user->no_telp) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Website</label>
                    <input type="url" name="website" class="form-control" value="{{ old('website', $perusahaan->website) }}">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $perusahaan->user->alamat) }}</textarea>
                </div>
            </div>
            <div class="mt-4"><button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button></div>
        </form>
    </div>
</div>
@endsection
