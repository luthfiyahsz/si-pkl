@extends('layouts.main')
@section('title', 'Detail Guru')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Detail Guru</h5>
    <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">Informasi Guru</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td width="150">NIP</td><td class="fw-bold">{{ $guru->nip }}</td></tr>
                    <tr><td>Nama</td><td class="fw-bold">{{ $guru->user->name }}</td></tr>
                    <tr><td>Email</td><td>{{ $guru->user->email }}</td></tr>
                    <tr><td>Gelar</td><td>{{ $guru->gelar ?? '-' }}</td></tr>
                    <tr><td>No. Telp</td><td>{{ $guru->user->no_telp ?? '-' }}</td></tr>
                    <tr><td>Alamat</td><td>{{ $guru->user->alamat ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">Pembimbing PKL</div>
            <div class="card-body">
                @if($guru->pkl->count())
                <table class="table table-sm">
                    <thead><tr><th>Siswa</th><th>Judul</th><th>Status</th></tr></thead>
                    <tbody>
                        @foreach($guru->pkl as $p)
                        <tr><td>{{ $p->siswa->user->name ?? '-' }}</td><td>{{ $p->judul }}</td><td><span class="badge bg-{{ $p->status == 'disetujui' ? 'success' : ($p->status == 'ditolak' ? 'danger' : ($p->status == 'selesai' ? 'info' : 'warning')) }}">{{ $p->status }}</span></td></tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-muted mb-0">Belum membimbing PKL.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
