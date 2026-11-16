@extends('layouts.main')
@section('title', 'Data Penilaian')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Data Penilaian</h5>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr><th>No</th><th>Siswa</th><th>Judul PKL</th><th>Guru</th><th>Perusahaan</th><th>Nilai</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @foreach($penilaian as $n)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $n->pkl->siswa->user->name ?? '-' }}</td>
                        <td>{{ $n->pkl->judul ?? '-' }}</td>
                        <td>{{ $n->guru->user->name ?? '-' }}</td>
                        <td>{{ $n->perusahaan->user->name ?? '-' }}</td>
                        <td><span class="badge bg-{{ $n->total_nilai >= 80 ? 'success' : ($n->total_nilai >= 60 ? 'warning' : 'danger') }}">{{ $n->total_nilai ?? '-' }}</span></td>
                        <td><a href="{{ route('admin.penilaian.show', $n) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a></td>
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
