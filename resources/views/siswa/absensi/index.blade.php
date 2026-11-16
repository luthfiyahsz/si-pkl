@extends('layouts.main')
@section('title', 'Absensi')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Absensi Harian</h5>
    <a href="{{ route('siswa.absensi.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Absen Hari Ini</a>
</div>
<div class="card">
    <div class="card-body">
        @if($absensi->count())
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead><tr><th>No</th><th>Tanggal</th><th>Status</th><th>Keterangan</th></tr></thead>
                <tbody>
                    @foreach($absensi as $a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
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
        <p class="text-muted mb-0">Belum ada absensi.</p>
        @endif
    </div>
</div>
@endsection
@push('scripts')
<script>$(document).ready(function() { $('.datatable').DataTable(); });</script>
@endpush
