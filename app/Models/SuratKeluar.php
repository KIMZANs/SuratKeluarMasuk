<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'surat_keluar';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nomor_surat',
        'tujuan',
        'perihal',
        'tanggal_surat',
        'keterangan',
        'file_surat',
    ];
}
