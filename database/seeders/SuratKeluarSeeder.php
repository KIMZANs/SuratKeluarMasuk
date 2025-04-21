<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuratKeluarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus semua data di tabel surat_keluar
        DB::table('surat_keluar')->truncate();

        // Masukkan data baru
        DB::table('surat_keluar')->insert([
            [
                'nomor_surat' => 'SK-001/2025',
                'tujuan' => 'PT. Contoh Tujuan',
                'perihal' => 'Pengajuan Kerjasama',
                'tanggal_surat' => '2025-04-15',
                'keterangan' => 'Pengajuan kerjasama untuk proyek baru.',
                'file_surat' => 'pengajuan_kerjasama.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_surat' => 'SK-002/2025',
                'tujuan' => 'Dinas Pendidikan',
                'perihal' => 'Laporan Kegiatan',
                'tanggal_surat' => '2025-04-18',
                'keterangan' => 'Laporan kegiatan tahunan telah disampaikan.',
                'file_surat' => 'laporan_kegiatan.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_surat' => 'SK-003/2025',
                'tujuan' => 'Kementerian Kesehatan',
                'perihal' => 'Permohonan Bantuan',
                'tanggal_surat' => '2025-04-20',
                'keterangan' => 'Permohonan bantuan untuk program kesehatan masyarakat.',
                'file_surat' => 'permohonan_bantuan.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}