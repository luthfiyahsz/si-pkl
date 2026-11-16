<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Perusahaan;
use App\Models\Pkl;
use App\Models\Jurnal;
use App\Models\Absensi;
use App\Models\Penilaian;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@si-pkl.test',
            'password' => 'password',
            'role' => 'admin',
            'active' => true,
        ]);

        $guruUser = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@si-pkl.test',
            'password' => 'password',
            'role' => 'guru',
            'no_telp' => '081234567890',
            'active' => true,
        ]);
        $guru = Guru::create([
            'user_id' => $guruUser->id,
            'nip' => '198001012010011001',
            'gelar' => 'S.Pd., M.Pd.',
        ]);

        $guruUser2 = User::create([
            'name' => 'Siti Rahmawati',
            'email' => 'siti@si-pkl.test',
            'password' => 'password',
            'role' => 'guru',
            'no_telp' => '081234567891',
            'active' => true,
        ]);
        Guru::create([
            'user_id' => $guruUser2->id,
            'nip' => '198501012010011002',
            'gelar' => 'S.Kom., M.Kom.',
        ]);

        $siswa1User = User::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'ahmad@si-pkl.test',
            'password' => 'password',
            'role' => 'siswa',
            'no_telp' => '081234567892',
            'active' => true,
        ]);
        $siswa1 = Siswa::create([
            'user_id' => $siswa1User->id,
            'nis' => '2024001',
            'kelas' => 'XII RPL 1',
        ]);

        $siswa2User = User::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi@si-pkl.test',
            'password' => 'password',
            'role' => 'siswa',
            'no_telp' => '081234567893',
            'active' => true,
        ]);
        $siswa2 = Siswa::create([
            'user_id' => $siswa2User->id,
            'nis' => '2024002',
            'kelas' => 'XII RPL 1',
        ]);

        $perusahaanUser = User::create([
            'name' => 'PT Teknologi Maju',
            'email' => 'perusahaan@si-pkl.test',
            'password' => 'password',
            'role' => 'perusahaan',
            'no_telp' => '02112345678',
            'alamat' => 'Jl. Merdeka No. 123, Jakarta',
            'active' => true,
        ]);
        $perusahaan = Perusahaan::create([
            'user_id' => $perusahaanUser->id,
            'kontak_person' => 'Hendra',
            'website' => 'https://teknologimaju.co.id',
        ]);

        $perusahaanUser2 = User::create([
            'name' => 'CV Karya Digital',
            'email' => 'cvkarya@si-pkl.test',
            'password' => 'password',
            'role' => 'perusahaan',
            'no_telp' => '02212345678',
            'alamat' => 'Jl. Sudirman No. 45, Bandung',
            'active' => true,
        ]);
        Perusahaan::create([
            'user_id' => $perusahaanUser2->id,
            'kontak_person' => 'Rina',
            'website' => 'https://karyadigital.co.id',
        ]);

        $pkl1 = Pkl::create([
            'siswa_id' => $siswa1->id,
            'guru_id' => $guru->id,
            'perusahaan_id' => $perusahaan->id,
            'judul' => 'Pengembangan Sistem Informasi Perpustakaan Berbasis Web',
            'deskripsi' => 'Membangun sistem informasi perpustakaan menggunakan Laravel dan MySQL',
            'tanggal_mulai' => '2026-01-10',
            'tanggal_selesai' => '2026-06-10',
            'status' => 'disetujui',
        ]);

        $pkl2 = Pkl::create([
            'siswa_id' => $siswa2->id,
            'guru_id' => $guru->id,
            'perusahaan_id' => $perusahaan->id,
            'judul' => 'Pengembangan Aplikasi Kasir Berbasis Web',
            'deskripsi' => 'Membangun aplikasi kasir untuk usaha kecil menggunakan PHP dan MySQL',
            'tanggal_mulai' => '2026-02-01',
            'tanggal_selesai' => '2026-07-01',
            'status' => 'pengajuan',
        ]);

        Jurnal::create([
            'pkl_id' => $pkl1->id,
            'tanggal' => '2026-01-15',
            'kegiatan' => 'Membuat struktur database dan ERD',
            'status_dosen' => 'disetujui',
            'status_perusahaan' => 'disetujui',
        ]);

        Jurnal::create([
            'pkl_id' => $pkl1->id,
            'tanggal' => '2026-01-16',
            'kegiatan' => 'Membuat halaman login dan register',
            'status_dosen' => 'pending',
            'status_perusahaan' => 'pending',
        ]);

        Jurnal::create([
            'pkl_id' => $pkl2->id,
            'tanggal' => '2026-02-05',
            'kegiatan' => 'Analisis kebutuhan sistem kasir',
            'status_dosen' => 'pending',
            'status_perusahaan' => 'pending',
        ]);

        Absensi::create([
            'siswa_id' => $siswa1->id,
            'tanggal' => now()->format('Y-m-d'),
            'status' => 'hadir',
        ]);

        Absensi::create([
            'siswa_id' => $siswa2->id,
            'tanggal' => now()->format('Y-m-d'),
            'status' => 'sakit',
            'keterangan' => 'Demam',
        ]);

        Penilaian::create([
            'pkl_id' => $pkl1->id,
            'guru_id' => $guru->id,
            'perusahaan_id' => $perusahaan->id,
            'nilai_kedisiplinan' => 85,
            'nilai_kerjasama' => 80,
            'nilai_pengetahuan' => 90,
            'nilai_keterampilan' => 88,
            'nilai_laporan' => 85,
            'total_nilai' => 86,
            'komentar' => 'Siswa rajin dan memiliki kemampuan teknis yang baik.',
        ]);

        $this->command->info('=== Akun Login ===');
        $this->command->info('Admin        | admin@si-pkl.test    | password');
        $this->command->info('Guru         | budi@si-pkl.test     | password');
        $this->command->info('Guru 2       | siti@si-pkl.test     | password');
        $this->command->info('Siswa        | ahmad@si-pkl.test    | password');
        $this->command->info('Siswa 2      | dewi@si-pkl.test     | password');
        $this->command->info('Perusahaan   | perusahaan@si-pkl.test | password');
        $this->command->info('Perusahaan 2 | cvkarya@si-pkl.test  | password');
    }
}
