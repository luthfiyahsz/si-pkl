@extends('layouts.main')
@section('title', 'Siswa PKL')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Siswa PKL</h5>
</div>
<div class="card">
    <div class="card-body">
        @if($pkl->count())
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead><tr><th>No</th><th>NIS</th><th>Nama</th><th>Judul PKL</th><th>Guru</th><th>Status</th></tr></thead>
                <tbody>
                    @foreach($pkl as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->siswa->nis ?? '-' }}</td>
                        <td>{{ $p->siswa->user->name ?? '-' }}</td>
                        <td>{{ $p->judul }}</td>
                        <td>{{ $p->guru->user->name ?? '-' }}</td>
                        <td><span class="badge bg-{{ $p->status == 'disetujui' ? 'success' : ($p->status == 'ditolak' ? 'danger' : ($p->status == 'selesai' ? 'info' : 'warning')) }}">{{ $p->status }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted mb-0">Belum ada siswa PKL.</p>
        @endif
    </div>
</div>
@endsection
@push('scripts')
<script>$(document).ready(function() { $('.datatable').DataTable(); });</script>
@endpush
