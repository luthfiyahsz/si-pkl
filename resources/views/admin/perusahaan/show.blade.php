@extends('layouts.main')
@section('title', 'Detail Perusahaan')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Detail Perusahaan</h5>
    <a href="{{ route('admin.perusahaan.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">Informasi Perusahaan</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td width="150">Nama</td><td class="fw-bold">{{ $perusahaan->user->name }}</td></tr>
                    <tr><td>Email</td><td>{{ $perusahaan->user->email }}</td></tr>
                    <tr><td>Kontak Person</td><td>{{ $perusahaan->kontak_person ?? '-' }}</td></tr>
                    <tr><td>No. Telp</td><td>{{ $perusahaan->user->no_telp ?? '-' }}</td></tr>
                    <tr><td>Website</td><td>{{ $perusahaan->website ? '<a href="'.$perusahaan->website.'" target="_blank">'.$perusahaan->website.'</a>' : '-' }}</td></tr>
                    <tr><td>Alamat</td><td>{{ $perusahaan->user->alamat ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">PKL di Perusahaan Ini</div>
            <div class="card-body">
                @if($perusahaan->pkl->count())
                <table class="table table-sm">
                    <thead><tr><th>Siswa</th><th>Judul</th><th>Status</th></tr></thead>
                    <tbody>
                        @foreach($perusahaan->pkl as $p)
                        <tr><td>{{ $p->siswa->user->name ?? '-' }}</td><td>{{ $p->judul }}</td><td><span class="badge bg-{{ $p->status == 'disetujui' ? 'success' : ($p->status == 'ditolak' ? 'danger' : ($p->status == 'selesai' ? 'info' : 'warning')) }}">{{ $p->status }}</span></td></tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-muted mb-0">Belum ada PKL.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
