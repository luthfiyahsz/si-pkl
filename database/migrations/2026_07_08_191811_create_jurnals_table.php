<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurnals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pkl_id')->constrained()->cascadeOnDelete();
            $table->date('tanggal');
            $table->text('kegiatan');
            $table->string('dokumentasi')->nullable();
            $table->text('komentar_dosen')->nullable();
            $table->text('komentar_perusahaan')->nullable();
            $table->enum('status_dosen', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->enum('status_perusahaan', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jurnals');
    }
};
