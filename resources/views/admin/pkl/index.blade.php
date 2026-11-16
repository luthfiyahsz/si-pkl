@extends('layouts.main')
@section('title', 'Data PKL')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Data PKL</h5>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr><th>No</th><th>Siswa</th><th>Judul</th><th>Guru</th><th>Perusahaan</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @foreach($pkl as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->siswa->user->name ?? '-' }}</td>
                        <td>{{ $p->judul }}</td>
                        <td>{{ $p->guru->user->name ?? '-' }}</td>
                        <td>{{ $p->perusahaan->user->name ?? '-' }}</td>
                        <td><span class="badge bg-{{ $p->status == 'disetujui' ? 'success' : ($p->status == 'ditolak' ? 'danger' : ($p->status == 'selesai' ? 'info' : 'warning')) }}">{{ $p->status }}</span></td>
                        <td>
                            <a href="{{ route('admin.pkl.show', $p) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('admin.pkl.edit', $p) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <button onclick="hapus('{{ route('admin.pkl.destroy', $p) }}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<form id="hapusForm" method="POST" style="display:none;">@csrf @method('DELETE')</form>
@endsection
@push('scripts')
<script>
$(document).ready(function() { $('.datatable').DataTable(); });
function hapus(url) {
    Swal.fire({
        title: 'Hapus data?', text: 'Data akan dihapus permanen.', icon: 'warning',
        showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'Ya, hapus!', cancelButtonText: 'Batal'
    }).then((result) => { if (result.isConfirmed) { $('#hapusForm').attr('action', url).submit(); } });
}
</script>
@endpush
