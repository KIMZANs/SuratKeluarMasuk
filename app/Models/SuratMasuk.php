<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk'; // Nama tabel di database
    protected $fillable = [
        'nomor_surat',
        'pengirim',
        'tujuan',
        'perihal',
        'tanggal_surat',
        'tanggal_diterima',
        'keterangan',
        'file_surat',
    ];
}
