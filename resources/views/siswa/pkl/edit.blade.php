@extends('layouts.main')
@section('title', 'Edit PKL')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Edit PKL</h5>
    <a href="{{ route('siswa.pkl.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('siswa.pkl.update', $pkl) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $pkl->judul) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Guru Pembimbing</label>
                    <select name="guru_id" class="form-select">
                        <option value="">-- Pilih --</option>
                        @foreach($guru as $d)
                        <option value="{{ $d->id }}" {{ $pkl->guru_id == $d->id ? 'selected' : '' }}>{{ $d->user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Perusahaan</label>
                    <select name="perusahaan_id" class="form-select">
                        <option value="">-- Pilih --</option>
                        @foreach($perusahaan as $p)
                        <option value="{{ $p->id }}" {{ $pkl->perusahaan_id == $p->id ? 'selected' : '' }}>{{ $p->user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $pkl->tanggal_mulai) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $pkl->tanggal_selesai) }}">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $pkl->deskripsi) }}</textarea>
                </div>
            </div>
            <div class="mt-4"><button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button></div>
        </form>
    </div>
</div>
@endsection
