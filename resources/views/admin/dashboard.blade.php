@extends('layouts.main')
@section('title', 'Dashboard Admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Dashboard Admin</h5>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card card-dashboard border-start-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Siswa SMK</h6>
                        <h3 class="mb-0">{{ $totalSiswa }}</h3>
                    </div>
                    <div class="text-primary fs-1"><i class="bi bi-people"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-dashboard border-start-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Guru</h6>
                        <h3 class="mb-0">{{ $totalGuru }}</h3>
                    </div>
                    <div class="text-success fs-1"><i class="bi bi-person-badge"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-dashboard border-start-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Perusahaan</h6>
                        <h3 class="mb-0">{{ $totalPerusahaan }}</h3>
                    </div>
                    <div class="text-warning fs-1"><i class="bi bi-building"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-dashboard border-start-info">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1">Total PKL</h6>
                        <h3 class="mb-0">{{ $totalPkl }}</h3>
                    </div>
                    <div class="text-info fs-1"><i class="bi bi-briefcase"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Informasi Umum</div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr><td>Total Jurnal</td><td class="fw-bold">{{ $totalJurnal }}</td></tr>
                    <tr><td>PKL Menunggu Persetujuan</td><td class="fw-bold text-warning">{{ $pklMenunggu }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">Daftar Semua Siswa</div>
    <div class="card-body">
        @if($siswaList->count())
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead><tr><th>No</th><th>NIS</th><th>Nama</th><th>Kelas</th><th>Judul PKL</th><th>Guru</th><th>Perusahaan</th><th>Status PKL</th></tr></thead>
                <tbody>
                    @foreach($siswaList as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $s->nis }}</td>
                        <td>{{ $s->user->name }}</td>
                        <td>{{ $s->kelas ?? '-' }}</td>
                        <td>
                            @foreach($s->pkl as $p)
                            {{ $p->judul }}@if(!$loop->last), @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($s->pkl as $p)
                            {{ $p->guru->user->name ?? '-' }}@if(!$loop->last), @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($s->pkl as $p)
                            {{ $p->perusahaan->user->name ?? '-' }}@if(!$loop->last), @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($s->pkl as $p)
                            <span class="badge bg-{{ $p->status == 'disetujui' ? 'success' : ($p->status == 'ditolak' ? 'danger' : ($p->status == 'selesai' ? 'info' : 'warning')) }}">{{ $p->status }}</span>@if(!$loop->last) @endif
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted mb-0">Belum ada data siswa.</p>
        @endif
    </div>
</div>
@endsection
