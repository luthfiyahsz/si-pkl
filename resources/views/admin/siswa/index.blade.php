@extends('layouts.main')
@section('title', 'Data Siswa SMK')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Data Siswa SMK</h5>
    <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Kelas</th>
                        <th>No. Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswa as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $s->nis }}</td>
                        <td>{{ $s->user->name }}</td>
                        <td>{{ $s->user->email }}</td>
                        <td>{{ $s->kelas ?? '-' }}</td>
                        <td>{{ $s->user->no_telp ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.siswa.show', $s) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('admin.siswa.edit', $s) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <button onclick="hapus('{{ route('admin.siswa.destroy', $s) }}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
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
        showCancelButton: true, confirmButtonColor: '#d33', cancelButtonText: 'Batal',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) { $('#hapusForm').attr('action', url).submit(); }
    });
}
</script>
@endpush
