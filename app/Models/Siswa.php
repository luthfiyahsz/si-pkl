<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    protected $fillable = ['user_id', 'nis', 'kelas'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pkl(): HasMany
    {
        return $this->hasMany(Pkl::class, 'siswa_id');
    }
}
