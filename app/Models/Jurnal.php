<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jurnal extends Model
{
    protected $fillable = [
        'pkl_id', 'tanggal', 'kegiatan', 'dokumentasi',
        'komentar_dosen', 'komentar_perusahaan',
        'status_dosen', 'status_perusahaan'
    ];

    public function pkl(): BelongsTo
    {
        return $this->belongsTo(Pkl::class);
    }
}
