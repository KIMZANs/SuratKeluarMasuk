<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuratMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus semua data di tabel surat_masuk
        DB::table('surat_masuk')->truncate();

        // Masukkan data baru
        DB::table('surat_masuk')->insert([
            [
                'nomor_surat' => 'SM-001/2025',
                'pengirim' => 'PT. Contoh Pengirim',
                'tujuan' => 'Dinas Pendidikan',
                'perihal' => 'Undangan Rapat',
                'sifat' => 'Penting',
                'tembusan' => 'Direktur, Manajer',
                'tanggal_masuk' => '2025-04-15',
                'tanggal_diterima' => '2025-04-16',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_surat' => 'SM-002/2025',
                'pengirim' => 'Dinas Pendidikan',
                'tujuan' => 'Kepala Sekolah',
                'perihal' => 'Pemberitahuan Libur',
                'sifat' => 'Biasa',
                'tembusan' => 'Kepala Sekolah, Guru',
                'tanggal_masuk' => '2025-04-10',
                'tanggal_diterima' => '2025-04-11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_surat' => 'SM-003/2025',
                'pengirim' => 'Kementerian Kesehatan',
                'tujuan' => 'Dinas Kesehatan',
                'perihal' => 'Sosialisasi Kesehatan',
                'sifat' => 'Biasa',
                'tembusan' => 'Direktur, Kepala Dinas Kesehatan',
                'tanggal_masuk' => '2025-04-18',
                'tanggal_diterima' => '2025-04-19',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}