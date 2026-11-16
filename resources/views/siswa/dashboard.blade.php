@extends('layouts.main')
@section('title', 'Dashboard Siswa SMK')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Dashboard Siswa SMK</h5>
    <span class="badge bg-primary fs-6">{{ $siswa->nis }}</span>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card card-dashboard border-start-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6 class="text-muted mb-1">Total PKL</h6><h3 class="mb-0">{{ $totalPkl }}</h3></div>
                    <div class="text-primary fs-1"><i class="bi bi-briefcase"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-dashboard border-start-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6 class="text-muted mb-1">PKL Disetujui</h6><h3 class="mb-0">{{ $pklDisetujui }}</h3></div>
                    <div class="text-success fs-1"><i class="bi bi-check-circle"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-dashboard border-start-info">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6 class="text-muted mb-1">Total Jurnal</h6><h3 class="mb-0">{{ $totalJurnal }}</h3></div>
                    <div class="text-info fs-1"><i class="bi bi-journal"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">Riwayat PKL</div>
    <div class="card-body">
        @if($pkl->count())
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>Judul</th><th>Guru</th><th>Perusahaan</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                    @foreach($pkl as $p)
                    <tr>
                        <td>{{ $p->judul }}</td>
                        <td>{{ $p->guru->user->name ?? '-' }}</td>
                        <td>{{ $p->perusahaan->user->name ?? '-' }}</td>
                        <td><span class="badge bg-{{ $p->status == 'disetujui' ? 'success' : ($p->status == 'ditolak' ? 'danger' : ($p->status == 'selesai' ? 'info' : 'warning')) }}">{{ $p->status }}</span></td>
                        <td><a href="{{ route('siswa.pkl.show', $p) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted mb-0">Belum ada pengajuan PKL. <a href="{{ route('siswa.pkl.create') }}">Ajukan sekarang</a></p>
        @endif
    </div>
</div>
@endsection
