@extends('layouts.main')
@section('title', 'Edit Penilaian')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Edit Penilaian</h5>
    <a href="{{ route('perusahaan.penilaian.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">Informasi PKL</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td>Siswa</td><td class="fw-bold">{{ $penilaian->pkl->siswa->user->name ?? '-' }}</td></tr>
                    <tr><td>NIS</td><td>{{ $penilaian->pkl->siswa->nis ?? '-' }}</td></tr>
                    <tr><td>Judul</td><td>{{ $penilaian->pkl->judul ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Form Penilaian</div>
            <div class="card-body">
                <form method="POST" action="{{ route('perusahaan.penilaian.update', $penilaian) }}">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Kedisiplinan</label>
                            <input type="number" name="nilai_kedisiplinan" class="form-control" value="{{ $penilaian->nilai_kedisiplinan }}" min="0" max="100" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kerjasama</label>
                            <input type="number" name="nilai_kerjasama" class="form-control" value="{{ $penilaian->nilai_kerjasama }}" min="0" max="100" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pengetahuan</label>
                            <input type="number" name="nilai_pengetahuan" class="form-control" value="{{ $penilaian->nilai_pengetahuan }}" min="0" max="100" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Keterampilan</label>
                            <input type="number" name="nilai_keterampilan" class="form-control" value="{{ $penilaian->nilai_keterampilan }}" min="0" max="100" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Laporan</label>
                            <input type="number" name="nilai_laporan" class="form-control" value="{{ $penilaian->nilai_laporan }}" min="0" max="100" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Komentar</label>
                            <textarea name="komentar" class="form-control" rows="3">{{ $penilaian->komentar }}</textarea>
                        </div>
                    </div>
                    <div class="mt-4"><button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update Penilaian</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
