@extends('layouts.main')
@section('title', 'Detail Penilaian')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Detail Penilaian</h5>
    <a href="{{ route('admin.penilaian.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">Informasi PKL</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td width="150">Siswa</td><td class="fw-bold">{{ $penilaian->pkl->siswa->user->name ?? '-' }}</td></tr>
                    <tr><td>Judul</td><td>{{ $penilaian->pkl->judul ?? '-' }}</td></tr>
                    <tr><td>Guru</td><td>{{ $penilaian->guru->user->name ?? '-' }}</td></tr>
                    <tr><td>Perusahaan</td><td>{{ $penilaian->perusahaan->user->name ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">Nilai</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td>Kedisiplinan</td><td class="fw-bold">{{ $penilaian->nilai_kedisiplinan ?? '-' }}</td></tr>
                    <tr><td>Kerjasama</td><td class="fw-bold">{{ $penilaian->nilai_kerjasama ?? '-' }}</td></tr>
                    <tr><td>Pengetahuan</td><td class="fw-bold">{{ $penilaian->nilai_pengetahuan ?? '-' }}</td></tr>
                    <tr><td>Keterampilan</td><td class="fw-bold">{{ $penilaian->nilai_keterampilan ?? '-' }}</td></tr>
                    <tr><td>Laporan</td><td class="fw-bold">{{ $penilaian->nilai_laporan ?? '-' }}</td></tr>
                    <tr><td>Total Nilai</td><td><span class="badge bg-{{ $penilaian->total_nilai >= 80 ? 'success' : ($penilaian->total_nilai >= 60 ? 'warning' : 'danger') }} fs-6">{{ $penilaian->total_nilai ?? '-' }}</span></td></tr>
                    <tr><td>Komentar</td><td>{{ $penilaian->komentar ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
