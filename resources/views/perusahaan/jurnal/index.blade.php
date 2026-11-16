@extends('layouts.main')
@section('title', 'Jurnal Siswa')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Jurnal Siswa</h5>
</div>
<div class="card">
    <div class="card-body">
        @if($jurnal->count())
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead><tr><th>No</th><th>Siswa</th><th>Tanggal</th><th>Kegiatan</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                    @foreach($jurnal as $j)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $j->pkl->siswa->user->name ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($j->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ Str::limit($j->kegiatan, 50) }}</td>
                        <td><span class="badge bg-{{ $j->status_perusahaan == 'disetujui' ? 'success' : ($j->status_perusahaan == 'ditolak' ? 'danger' : 'warning') }}">{{ $j->status_perusahaan }}</span></td>
                        <td><a href="{{ route('perusahaan.jurnal.show', $j) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a></td>
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
@endsection
@push('scripts')
<script>$(document).ready(function() { $('.datatable').DataTable(); });</script>
@endpush
