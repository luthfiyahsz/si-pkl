@extends('layouts.main')
@section('title', 'Dashboard Guru')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Dashboard Guru</h5>
</div>
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card card-dashboard border-start-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6 class="text-muted mb-1">Siswa Bimbingan</h6><h3 class="mb-0">{{ $totalSiswaBimbingan }}</h3></div>
                    <div class="text-primary fs-1"><i class="bi bi-people"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-dashboard border-start-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6 class="text-muted mb-1">Jurnal Pending</h6><h3 class="mb-0">{{ $totalJurnalPending }}</h3></div>
                    <div class="text-warning fs-1"><i class="bi bi-clock"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-dashboard border-start-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6 class="text-muted mb-1">Jurnal Disetujui</h6><h3 class="mb-0">{{ $totalJurnalDisetujui }}</h3></div>
                    <div class="text-success fs-1"><i class="bi bi-check-circle"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">Menu Cepat</div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4"><a href="{{ route('guru.siswa.index') }}" class="btn btn-outline-primary w-100"><i class="bi bi-people me-2"></i>Siswa Bimbingan</a></div>
            <div class="col-md-4"><a href="{{ route('guru.jurnal.index') }}" class="btn btn-outline-warning w-100"><i class="bi bi-journal me-2"></i>Jurnal Siswa</a></div>
            <div class="col-md-4"><a href="{{ route('guru.penilaian.index') }}" class="btn btn-outline-success w-100"><i class="bi bi-star me-2"></i>Penilaian</a></div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">Daftar Siswa Bimbingan</div>
    <div class="card-body">
        @if($pkl->count())
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead><tr><th>No</th><th>NIS</th><th>Nama</th><th>Judul PKL</th><th>Perusahaan</th><th>Status</th></tr></thead>
                <tbody>
                    @foreach($pkl as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->siswa->nis ?? '-' }}</td>
                        <td>{{ $p->siswa->user->name ?? '-' }}</td>
                        <td>{{ $p->judul }}</td>
                        <td>{{ $p->perusahaan->user->name ?? '-' }}</td>
                        <td><span class="badge bg-{{ $p->status == 'disetujui' ? 'success' : ($p->status == 'ditolak' ? 'danger' : ($p->status == 'selesai' ? 'info' : 'warning')) }}">{{ $p->status }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted mb-0">Belum ada siswa bimbingan.</p>
        @endif
    </div>
</div>
@endsection
