@extends('layouts.main')
@section('title', 'Edit Status PKL')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Edit Status PKL</h5>
    <a href="{{ route('admin.pkl.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">Informasi PKL</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td width="150">Siswa</td><td class="fw-bold">{{ $pkl->siswa->user->name ?? '-' }}</td></tr>
                    <tr><td>Judul</td><td>{{ $pkl->judul }}</td></tr>
                    <tr><td>Guru</td><td>{{ $pkl->guru->user->name ?? '-' }}</td></tr>
                    <tr><td>Perusahaan</td><td>{{ $pkl->perusahaan->user->name ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Ubah Status</div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.pkl.update', $pkl) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="pengajuan" {{ $pkl->status == 'pengajuan' ? 'selected' : '' }}>Pengajuan</option>
                            <option value="disetujui" {{ $pkl->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ $pkl->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="selesai" {{ $pkl->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="catatan" class="form-control" rows="3">{{ $pkl->catatan }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
