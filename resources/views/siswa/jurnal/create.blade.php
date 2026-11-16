@extends('layouts.main')
@section('title', 'Tambah Jurnal')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Tambah Jurnal Harian</h5>
    <a href="{{ route('siswa.jurnal.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('siswa.jurnal.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">PKL <span class="text-danger">*</span></label>
                    <select name="pkl_id" class="form-select @error('pkl_id') is-invalid @enderror" required>
                        <option value="">-- Pilih PKL --</option>
                        @foreach($pkl as $p)
                        <option value="{{ $p->id }}" {{ old('pkl_id') == $p->id ? 'selected' : '' }}>{{ $p->judul }}</option>
                        @endforeach
                    </select>
                    @error('pkl_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                    @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label">Kegiatan <span class="text-danger">*</span></label>
                    <textarea name="kegiatan" class="form-control @error('kegiatan') is-invalid @enderror" rows="5" required>{{ old('kegiatan') }}</textarea>
                    @error('kegiatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label">Dokumentasi (foto)</label>
                    <input type="file" name="dokumentasi" class="form-control @error('dokumentasi') is-invalid @enderror" accept="image/*">
                    @error('dokumentasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="mt-4"><button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button></div>
        </form>
    </div>
</div>
@endsection
