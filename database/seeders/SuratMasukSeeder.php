<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                'perihal' => 'Undangan Rapat',
                'tanggal_surat' => '2025-04-15',
                'tanggal_diterima' => '2025-04-16',
                'keterangan' => 'Rapat akan dilaksanakan pada tanggal 20 April 2025.',
                'file_surat' => 'undangan_rapat.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_surat' => 'SM-002/2025',
                'pengirim' => 'Dinas Pendidikan',
                'perihal' => 'Pemberitahuan Libur',
                'tanggal_surat' => '2025-04-10',
                'tanggal_diterima' => '2025-04-11',
                'keterangan' => 'Pemberitahuan libur nasional pada tanggal 25 April 2025.',
                'file_surat' => 'pemberitahuan_libur.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_surat' => 'SM-003/2025',
                'pengirim' => 'Kementerian Kesehatan',
                'perihal' => 'Sosialisasi Kesehatan',
                'tanggal_surat' => '2025-04-18',
                'tanggal_diterima' => '2025-04-19',
                'keterangan' => 'Sosialisasi kesehatan akan dilakukan di kantor pusat.',
                'file_surat' => 'sosialisasi_kesehatan.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}