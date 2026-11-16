@extends('layouts.main')
@section('title', 'Detail Jurnal')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Detail Jurnal</h5>
    <a href="{{ route('admin.jurnal.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">Kegiatan</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td width="120">Siswa</td><td class="fw-bold">{{ $jurnal->pkl->siswa->user->name ?? '-' }}</td></tr>
                    <tr><td>Tanggal</td><td>{{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d/m/Y') }}</td></tr>
                    <tr><td>Kegiatan</td><td>{{ nl2br($jurnal->kegiatan) }}</td></tr>
                    @if($jurnal->dokumentasi)
                    <tr><td>Dokumentasi</td><td><a href="{{ asset('storage/'.$jurnal->dokumentasi) }}" target="_blank"><img src="{{ asset('storage/'.$jurnal->dokumentasi) }}" width="200" class="img-thumbnail"></a></td></tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">Status</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td>Dosen</td><td><span class="badge bg-{{ $jurnal->status_dosen == 'disetujui' ? 'success' : ($jurnal->status_dosen == 'ditolak' ? 'danger' : 'warning') }}">{{ $jurnal->status_dosen }}</span></td></tr>
                    <tr><td>Perusahaan</td><td><span class="badge bg-{{ $jurnal->status_perusahaan == 'disetujui' ? 'success' : ($jurnal->status_perusahaan == 'ditolak' ? 'danger' : 'warning') }}">{{ $jurnal->status_perusahaan }}</span></td></tr>
                </table>
            </div>
        </div>
        @if($jurnal->komentar_dosen)
        <div class="card mb-4">
            <div class="card-header">Komentar Dosen</div>
            <div class="card-body"><p class="mb-0">{{ $jurnal->komentar_dosen }}</p></div>
        </div>
        @endif
        @if($jurnal->komentar_perusahaan)
        <div class="card mb-4">
            <div class="card-header">Komentar Perusahaan</div>
            <div class="card-body"><p class="mb-0">{{ $jurnal->komentar_perusahaan }}</p></div>
        </div>
        @endif
    </div>
</div>
@endsection
