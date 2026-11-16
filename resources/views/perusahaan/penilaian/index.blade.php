@extends('layouts.main')
@section('title', 'Penilaian PKL')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Penilaian PKL</h5>
</div>
<div class="card">
    <div class="card-body">
        @if($penilaian->count())
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead><tr><th>No</th><th>Siswa</th><th>Judul PKL</th><th>Nilai</th><th>Aksi</th></tr></thead>
                <tbody>
                    @foreach($penilaian as $n)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $n->pkl->siswa->user->name ?? '-' }}</td>
                        <td>{{ $n->pkl->judul ?? '-' }}</td>
                        <td><span class="badge bg-{{ $n->total_nilai >= 80 ? 'success' : ($n->total_nilai >= 60 ? 'warning' : 'danger') }}">{{ $n->total_nilai ?? '-' }}</span></td>
                        <td><a href="{{ route('perusahaan.penilaian.edit', $n) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted mb-0">Belum ada penilaian.</p>
        @endif
    </div>
</div>
@endsection
@push('scripts')
<script>$(document).ready(function() { $('.datatable').DataTable(); });</script>
@endpush
