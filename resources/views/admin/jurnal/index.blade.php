@extends('layouts.main')
@section('title', 'Semua Jurnal')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Semua Jurnal Harian</h5>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr><th>No</th><th>Siswa</th><th>Tanggal</th><th>Kegiatan</th><th>Status Dosen</th><th>Status Perusahaan</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @foreach($jurnal as $j)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $j->pkl->siswa->user->name ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($j->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ Str::limit($j->kegiatan, 50) }}</td>
                        <td><span class="badge bg-{{ $j->status_dosen == 'disetujui' ? 'success' : ($j->status_dosen == 'ditolak' ? 'danger' : 'warning') }}">{{ $j->status_dosen }}</span></td>
                        <td><span class="badge bg-{{ $j->status_perusahaan == 'disetujui' ? 'success' : ($j->status_perusahaan == 'ditolak' ? 'danger' : 'warning') }}">{{ $j->status_perusahaan }}</span></td>
                        <td><a href="{{ route('admin.jurnal.show', $j) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>$(document).ready(function() { $('.datatable').DataTable(); });</script>
@endpush
