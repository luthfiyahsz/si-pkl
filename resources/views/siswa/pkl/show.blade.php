@extends('layouts.main')
@section('title', 'Detail PKL')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Detail PKL</h5>
    <a href="{{ route('siswa.pkl.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">Informasi PKL</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td width="150">Judul</td><td class="fw-bold">{{ $pkl->judul }}</td></tr>
                    <tr><td>Guru</td><td>{{ $pkl->guru->user->name ?? '-' }}</td></tr>
                    <tr><td>Perusahaan</td><td>{{ $pkl->perusahaan->user->name ?? '-' }}</td></tr>
                    <tr><td>Status</td><td><span class="badge bg-{{ $pkl->status == 'disetujui' ? 'success' : ($pkl->status == 'ditolak' ? 'danger' : ($pkl->status == 'selesai' ? 'info' : 'warning')) }}">{{ $pkl->status }}</span></td></tr>
                    <tr><td>Tanggal Mulai</td><td>{{ $pkl->tanggal_mulai ? \Carbon\Carbon::parse($pkl->tanggal_mulai)->format('d/m/Y') : '-' }}</td></tr>
                    <tr><td>Tanggal Selesai</td><td>{{ $pkl->tanggal_selesai ? \Carbon\Carbon::parse($pkl->tanggal_selesai)->format('d/m/Y') : '-' }}</td></tr>
                    <tr><td>Deskripsi</td><td>{{ nl2br($pkl->deskripsi ?? '-') }}</td></tr>
                    @if($pkl->catatan)
                    <tr><td>Catatan</td><td class="text-warning">{{ $pkl->catatan }}</td></tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">Upload Laporan Akhir</div>
            <div class="card-body">
                @if($pkl->laporan_akhir)
                <p class="mb-2"><a href="{{ asset('storage/'.$pkl->laporan_akhir) }}" target="_blank" class="btn btn-sm btn-success"><i class="bi bi-file-pdf"></i> Lihat Laporan</a></p>
                <hr>
                @endif
                <form method="POST" action="{{ route('siswa.pkl.laporan', $pkl) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">File PDF</label>
                        <input type="file" name="laporan_akhir" class="form-control" accept=".pdf" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-upload"></i> Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">Jurnal Harian ({{ $pkl->jurnal->count() }})</div>
    <div class="card-body">
        @if($pkl->jurnal->count())
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>Tanggal</th><th>Kegiatan</th><th>Status Dosen</th><th>Status Perusahaan</th><th>Dokumentasi</th></tr></thead>
                <tbody>
                    @foreach($pkl->jurnal as $j)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($j->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ Str::limit($j->kegiatan, 60) }}</td>
                        <td><span class="badge bg-{{ $j->status_dosen == 'disetujui' ? 'success' : ($j->status_dosen == 'ditolak' ? 'danger' : 'warning') }}">{{ $j->status_dosen }}</span></td>
                        <td><span class="badge bg-{{ $j->status_perusahaan == 'disetujui' ? 'success' : ($j->status_perusahaan == 'ditolak' ? 'danger' : 'warning') }}">{{ $j->status_perusahaan }}</span></td>
                        <td>@if($j->dokumentasi)<a href="{{ asset('storage/'.$j->dokumentasi) }}" target="_blank"><img src="{{ asset('storage/'.$j->dokumentasi) }}" width="50" class="img-thumbnail"></a>@else - @endif</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted mb-0">Belum ada jurnal harian.</p>
        @endif
    </div>
</div>
@endsection
