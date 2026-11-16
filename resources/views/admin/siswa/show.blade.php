@extends('layouts.main')
@section('title', 'Detail Siswa SMK')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Detail Siswa SMK</h5>
    <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">Informasi Siswa</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td width="150">NIS</td><td class="fw-bold">{{ $siswa->nis }}</td></tr>
                    <tr><td>Nama</td><td class="fw-bold">{{ $siswa->user->name }}</td></tr>
                    <tr><td>Email</td><td>{{ $siswa->user->email }}</td></tr>
                    <tr><td>Kelas</td><td>{{ $siswa->kelas ?? '-' }}</td></tr>
                    <tr><td>No. Telp</td><td>{{ $siswa->user->no_telp ?? '-' }}</td></tr>
                    <tr><td>Alamat</td><td>{{ $siswa->user->alamat ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">Riwayat PKL</div>
            <div class="card-body">
                @if($siswa->pkl->count())
                <table class="table table-sm">
                    <thead><tr><th>Judul</th><th>Status</th></tr></thead>
                    <tbody>
                        @foreach($siswa->pkl as $p)
                        <tr><td>{{ $p->judul }}</td><td><span class="badge bg-{{ $p->status == 'disetujui' ? 'success' : ($p->status == 'ditolak' ? 'danger' : ($p->status == 'selesai' ? 'info' : 'warning')) }}">{{ $p->status }}</span></td></tr>
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
