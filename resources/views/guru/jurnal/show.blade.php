@extends('layouts.main')
@section('title', 'Detail Jurnal')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="page-title">Detail Jurnal</h5>
    <a href="{{ route('guru.jurnal.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">Kegiatan Jurnal</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td width="120">Siswa</td><td class="fw-bold">{{ $jurnal->pkl->siswa->user->name ?? '-' }}</td></tr>
                    <tr><td>Tanggal</td><td>{{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d/m/Y') }}</td></tr>
                    <tr><td>Kegiatan</td><td>{{ nl2br($jurnal->kegiatan) }}</td></tr>
                    @if($jurnal->dokumentasi)
                    <tr><td>Dokumentasi</td><td><a href="{{ asset('storage/'.$jurnal->dokumentasi) }}" target="_blank"><img src="{{ asset('storage/'.$jurnal->dokumentasi) }}" width="200" class="img-thumbnail"></a></td></tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">Aksi</div>
            <div class="card-body">
                <div class="d-flex gap-2 mb-3">
                    <form method="POST" action="{{ route('guru.jurnal.approve', $jurnal) }}">
                        @csrf
                        <button type="submit" class="btn btn-success" {{ $jurnal->status_dosen == 'disetujui' ? 'disabled' : '' }}><i class="bi bi-check-lg"></i> Setujui</button>
                    </form>
                </div>
                <hr>
                <form method="POST" action="{{ route('guru.jurnal.komentar', $jurnal) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Komentar</label>
                        <textarea name="komentar_dosen" class="form-control" rows="3">{{ $jurnal->komentar_dosen }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-chat"></i> Kirim Komentar</button>
                </form>
                <hr>
                <form method="POST" action="{{ route('guru.jurnal.reject', $jurnal) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Alasan Tolak <span class="text-danger">*</span></label>
                        <textarea name="komentar_dosen" class="form-control" rows="2" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-x-lg"></i> Tolak</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
