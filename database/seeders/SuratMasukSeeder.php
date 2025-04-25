<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SuratMasukSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        DB::table('surat_masuk')->insert([
            [
                'nomor_surat' => '000.5/001/IPDN XX',
                'pengirim' => 'Aria',
                'tembusan' => json_encode([
                    'Kepala Biro Administrasi Akademik dan Perencanaan',
                    'Kepala Biro Administrasi Umum dan Keuangan'
                ]),
                'tanggal' => Carbon::now()->subDays(3)->toDateString(),
                'sifat' => 'Penting',
                'perihal' => 'Permohonan Pengadaan Barang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_surat' => '001.2/002/IPDN XX',
                'pengirim' => 'Riri',
                'tembusan' => json_encode([
                    'Kepala Bagian Umum dan Perlengkapan'
                ]),
                'tanggal' => Carbon::now()->subDays(1)->toDateString(),
                'sifat' => 'Biasa',
                'perihal' => 'Laporan Kegiatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
