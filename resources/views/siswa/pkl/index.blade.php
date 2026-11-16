@extends('layouts.main')
@section('title', 'Pengajuan PKL')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Pengajuan PKL</h5>
    <a href="{{ route('siswa.pkl.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Ajukan PKL</a>
</div>
<div class="card">
    <div class="card-body">
        @if($pkl->count())
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead><tr><th>No</th><th>Judul</th><th>Guru</th><th>Perusahaan</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                    @foreach($pkl as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->judul }}</td>
                        <td>{{ $p->guru->user->name ?? '-' }}</td>
                        <td>{{ $p->perusahaan->user->name ?? '-' }}</td>
                        <td><span class="badge bg-{{ $p->status == 'disetujui' ? 'success' : ($p->status == 'ditolak' ? 'danger' : ($p->status == 'selesai' ? 'info' : 'warning')) }}">{{ $p->status }}</span></td>
                        <td>
                            <a href="{{ route('siswa.pkl.show', $p) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                            @if($p->status == 'pengajuan')
                            <a href="{{ route('siswa.pkl.edit', $p) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            @endif
                        </td>
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
@push('scripts')
<script>$(document).ready(function() { $('.datatable').DataTable(); });</script>
@endpush
