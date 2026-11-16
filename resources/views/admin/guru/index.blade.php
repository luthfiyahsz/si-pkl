@extends('layouts.main')
@section('title', 'Data Guru')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Data Guru</h5>
    <a href="{{ route('admin.guru.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr><th>No</th><th>NIP</th><th>Nama</th><th>Email</th><th>Gelar</th><th>No. Telp</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @foreach($guru as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->nip }}</td>
                        <td>{{ $d->user->name }}</td>
                        <td>{{ $d->user->email }}</td>
                        <td>{{ $d->gelar ?? '-' }}</td>
                        <td>{{ $d->user->no_telp ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.guru.show', $d) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('admin.guru.edit', $d) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <button onclick="hapus('{{ route('admin.guru.destroy', $d) }}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
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
