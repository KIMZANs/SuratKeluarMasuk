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
                'pengirim' => 'Kepala Sekolah',
                'tujuan' => 'Dinas Pendidikan',
                'perihal' => 'Pengajuan Kerjasama',
                'sifat' => 'Penting',
                'tembusan' => 'Direktur, Manajer',
                'tanggal_masuk' => '2025-04-15',
                'reviewer' => 'diproses',
                'penandatangan' => 'diproses',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_surat' => 'SK-002/2025',
                'pengirim' => 'Dinas Pendidikan',
                'tujuan' => 'Kepala Sekolah',
                'perihal' => 'Laporan Kegiatan',
                'sifat' => 'Biasa',
                'tembusan' => 'Kepala Sekolah, Guru',
                'tanggal_masuk' => '2025-04-18',
                'reviewer' => 'diproses',
                'penandatangan' => 'diproses',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_surat' => 'SK-003/2025',
                'pengirim' => 'Kementerian Kesehatan',
                'tujuan' => 'Dinas Kesehatan',
                'perihal' => 'Permohonan Bantuan',
                'sifat' => 'Segera',
                'tembusan' => 'Direktur, Kepala Dinas Kesehatan',
                'tanggal_masuk' => '2025-04-20',
                'reviewer' => 'selesai',
                'penandatangan' => 'selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}