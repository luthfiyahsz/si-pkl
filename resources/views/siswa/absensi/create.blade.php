@extends('layouts.main')
@section('title', 'Absen Hari Ini')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Absen Hari Ini</h5>
    <a href="{{ route('siswa.absensi.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                @if($alreadyAbsen)
                <div class="alert alert-info">Anda sudah absen hari ini.</div>
                @else
                <form method="POST" action="{{ route('siswa.absensi.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="hadir">Hadir</option>
                            <option value="sakit">Sakit</option>
                            <option value="izin">Izin</option>
                            <option value="alpha">Alpha</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Opsional"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
