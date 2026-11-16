<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Perusahaan extends Model
{
    protected $fillable = ['user_id', 'kontak_person', 'website'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pkl(): HasMany
    {
        return $this->hasMany(Pkl::class);
    }

    public function penilaian(): HasMany
    {
        return $this->hasMany(Penilaian::class);
    }
}
