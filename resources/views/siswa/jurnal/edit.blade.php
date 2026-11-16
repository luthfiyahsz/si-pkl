@extends('layouts.main')
@section('title', 'Edit Jurnal')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Edit Jurnal Harian</h5>
    <a href="{{ route('siswa.jurnal.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('siswa.jurnal.update', $jurnal) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">PKL <span class="text-danger">*</span></label>
                    <select name="pkl_id" class="form-select" required>
                        @foreach($pkl as $p)
                        <option value="{{ $p->id }}" {{ $jurnal->pkl_id == $p->id ? 'selected' : '' }}>{{ $p->judul }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $jurnal->tanggal) }}" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Kegiatan <span class="text-danger">*</span></label>
                    <textarea name="kegiatan" class="form-control" rows="5" required>{{ old('kegiatan', $jurnal->kegiatan) }}</textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Dokumentasi</label>
                    @if($jurnal->dokumentasi)
                    <div class="mb-2"><img src="{{ asset('storage/'.$jurnal->dokumentasi) }}" width="150" class="img-thumbnail"></div>
                    @endif
                    <input type="file" name="dokumentasi" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="mt-4"><button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button></div>
        </form>
    </div>
</div>
@endsection
