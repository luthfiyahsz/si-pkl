@extends('layouts.main')
@section('title', 'Data Perusahaan')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Data Perusahaan</h5>
    <a href="{{ route('admin.perusahaan.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr><th>No</th><th>Nama</th><th>Email</th><th>Kontak Person</th><th>No. Telp</th><th>Website</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @foreach($perusahaan as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->user->name }}</td>
                        <td>{{ $p->user->email }}</td>
                        <td>{{ $p->kontak_person ?? '-' }}</td>
                        <td>{{ $p->user->no_telp ?? '-' }}</td>
                        <td>{{ $p->website ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.perusahaan.show', $p) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('admin.perusahaan.edit', $p) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <button onclick="hapus('{{ route('admin.perusahaan.destroy', $p) }}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
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
