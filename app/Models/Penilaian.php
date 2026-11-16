<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penilaian extends Model
{
    protected $fillable = [
        'pkl_id', 'guru_id', 'perusahaan_id',
        'nilai_kedisiplinan', 'nilai_kerjasama', 'nilai_pengetahuan',
        'nilai_keterampilan', 'nilai_laporan', 'total_nilai', 'komentar'
    ];

    public function pkl(): BelongsTo
    {
        return $this->belongsTo(Pkl::class);
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class);
    }

    public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(Perusahaan::class);
    }
}
