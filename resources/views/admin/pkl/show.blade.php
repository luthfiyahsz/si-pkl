@extends('layouts.main')
@section('title', 'Detail PKL')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Detail PKL</h5>
    <a href="{{ route('admin.pkl.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">Informasi PKL</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td width="150">Judul</td><td class="fw-bold">{{ $pkl->judul }}</td></tr>
                    <tr><td>Siswa</td><td>{{ $pkl->siswa->user->name ?? '-' }} ({{ $pkl->siswa->nis ?? '-' }})</td></tr>
                    <tr><td>Guru</td><td>{{ $pkl->guru->user->name ?? '-' }}</td></tr>
                    <tr><td>Perusahaan</td><td>{{ $pkl->perusahaan->user->name ?? '-' }}</td></tr>
                    <tr><td>Status</td><td><span class="badge bg-{{ $pkl->status == 'disetujui' ? 'success' : ($pkl->status == 'ditolak' ? 'danger' : ($pkl->status == 'selesai' ? 'info' : 'warning')) }}">{{ $pkl->status }}</span></td></tr>
                    <tr><td>Tanggal Mulai</td><td>{{ $pkl->tanggal_mulai ? \Carbon\Carbon::parse($pkl->tanggal_mulai)->format('d/m/Y') : '-' }}</td></tr>
                    <tr><td>Tanggal Selesai</td><td>{{ $pkl->tanggal_selesai ? \Carbon\Carbon::parse($pkl->tanggal_selesai)->format('d/m/Y') : '-' }}</td></tr>
                    <tr><td>Catatan</td><td>{{ $pkl->catatan ?? '-' }}</td></tr>
                    <tr><td>Laporan</td><td>@if($pkl->laporan_akhir)<a href="{{ asset('storage/'.$pkl->laporan_akhir) }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-file-pdf"></i> Lihat</a>@else - @endif</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">Jurnal Harian ({{ $pkl->jurnal->count() }})</div>
            <div class="card-body">
                @if($pkl->jurnal->count())
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead><tr><th>Tanggal</th><th>Status Dosen</th><th>Status Perusahaan</th></tr></thead>
                        <tbody>
                            @foreach($pkl->jurnal as $j)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($j->tanggal)->format('d/m/Y') }}</td>
                                <td><span class="badge bg-{{ $j->status_dosen == 'disetujui' ? 'success' : ($j->status_dosen == 'ditolak' ? 'danger' : 'warning') }}">{{ $j->status_dosen }}</span></td>
                                <td><span class="badge bg-{{ $j->status_perusahaan == 'disetujui' ? 'success' : ($j->status_perusahaan == 'ditolak' ? 'danger' : 'warning') }}">{{ $j->status_perusahaan }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted mb-0">Belum ada jurnal.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
