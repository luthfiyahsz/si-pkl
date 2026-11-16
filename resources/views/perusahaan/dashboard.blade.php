@extends('layouts.main')
@section('title', 'Dashboard Perusahaan')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Dashboard Perusahaan</h5>
</div>
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card card-dashboard border-start-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6 class="text-muted mb-1">Total Siswa PKL</h6><h3 class="mb-0">{{ $totalSiswa }}</h3></div>
                    <div class="text-primary fs-1"><i class="bi bi-people"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-dashboard border-start-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6 class="text-muted mb-1">PKL Aktif</h6><h3 class="mb-0">{{ $totalPklAktif }}</h3></div>
                    <div class="text-success fs-1"><i class="bi bi-briefcase"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-dashboard border-start-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6 class="text-muted mb-1">Jurnal Perlu Review</h6><h3 class="mb-0">{{ $totalJurnalPending }}</h3></div>
                    <div class="text-warning fs-1"><i class="bi bi-journal"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">Menu Cepat</div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4"><a href="{{ route('perusahaan.siswa.index') }}" class="btn btn-outline-primary w-100"><i class="bi bi-people me-2"></i> Siswa PKL</a></div>
            <div class="col-md-4"><a href="{{ route('perusahaan.jurnal.index') }}" class="btn btn-outline-warning w-100"><i class="bi bi-journal me-2"></i> Jurnal Siswa</a></div>
            <div class="col-md-4"><a href="{{ route('perusahaan.penilaian.index') }}" class="btn btn-outline-success w-100"><i class="bi bi-star me-2"></i> Penilaian</a></div>
        </div>
    </div>
</div>
@endsection
