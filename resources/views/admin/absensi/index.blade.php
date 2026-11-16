@extends('layouts.main')
@section('title', 'Data Absensi')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Data Absensi</h5>
</div>
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card card-dashboard border-start-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6 class="text-muted mb-1">Hadir Hari Ini</h6><h3 class="mb-0">{{ $todayHadir }}</h3></div>
                    <div class="text-success fs-1"><i class="bi bi-check-circle"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-dashboard border-start-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6 class="text-muted mb-1">Total Siswa</h6><h3 class="mb-0">{{ $totalSiswa }}</h3></div>
                    <div class="text-warning fs-1"><i class="bi bi-people"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-dashboard border-start-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div><h6 class="text-muted mb-1">Belum Absen</h6><h3 class="mb-0">{{ $belumAbsen }}</h3></div>
                    <div class="text-danger fs-1"><i class="bi bi-x-circle"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        @if($absensi->count())
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead><tr><th>No</th><th>Siswa</th><th>NIS</th><th>Tanggal</th><th>Status</th><th>Keterangan</th></tr></thead>
                <tbody>
                    @foreach($absensi as $a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $a->siswa->user->name ?? '-' }}</td>
                        <td>{{ $a->siswa->nis ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($a->tanggal)->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $a->status == 'hadir' ? 'success' : ($a->status == 'sakit' ? 'warning' : ($a->status == 'izin' ? 'info' : 'secondary')) }}">
                                {{ ucfirst($a->status) }}
                            </span>
                        </td>
                        <td>{{ $a->keterangan ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted mb-0">Belum ada data absensi.</p>
        @endif
    </div>
</div>
@endsection
@push('scripts')
<script>$(document).ready(function() { $('.datatable').DataTable(); });</script>
@endpush
