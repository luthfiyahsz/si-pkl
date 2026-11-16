@extends('layouts.main')
@section('title', 'Jurnal Harian')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Jurnal Harian</h5>
    <a href="{{ route('siswa.jurnal.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Jurnal</a>
</div>
<div class="card">
    <div class="card-body">
        @if($jurnal->count())
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead><tr><th>No</th><th>Tanggal</th><th>PKL</th><th>Kegiatan</th><th>Status Dosen</th><th>Status Perusahaan</th><th>Aksi</th></tr></thead>
                <tbody>
                    @foreach($jurnal as $j)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($j->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $j->pkl->judul ?? '-' }}</td>
                        <td>{{ Str::limit($j->kegiatan, 50) }}</td>
                        <td><span class="badge bg-{{ $j->status_dosen == 'disetujui' ? 'success' : ($j->status_dosen == 'ditolak' ? 'danger' : 'warning') }}">{{ $j->status_dosen }}</span></td>
                        <td><span class="badge bg-{{ $j->status_perusahaan == 'disetujui' ? 'success' : ($j->status_perusahaan == 'ditolak' ? 'danger' : 'warning') }}">{{ $j->status_perusahaan }}</span></td>
                        <td>
                            <a href="{{ route('siswa.jurnal.edit', $j) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <button onclick="hapus('{{ route('siswa.jurnal.destroy', $j) }}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
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
<form id="hapusForm" method="POST" style="display:none;">@csrf @method('DELETE')</form>
@endsection
@push('scripts')
<script>
$(document).ready(function() { $('.datatable').DataTable(); });
function hapus(url) {
    Swal.fire({
        title: 'Hapus jurnal?', text: 'Data akan dihapus permanen.', icon: 'warning',
        showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'Ya, hapus!', cancelButtonText: 'Batal'
    }).then((result) => { if (result.isConfirmed) { $('#hapusForm').attr('action', url).submit(); } });
}
</script>
@endpush
