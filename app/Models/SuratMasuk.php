<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';
    protected $fillable = [
        'nomor_surat',
        'pengirim',
        'tanggal',
        'sifat',
        'perihal',
    ];

    public function tembusans()
    {
        return $this->hasMany(TembusanSuratMasuk::class, 'surat_masuk_id');
    }
}
