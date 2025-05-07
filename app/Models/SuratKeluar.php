<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar';

    protected $fillable = [
        'nomor_surat',
        'pengirim',
        'tanggal',
        'sifat',
        'perihal',
        'isi_surat',
    ];

    public function tembusans()
    {
        return $this->hasMany(TembusanSuratKeluar::class, 'surat_keluar_id');
    }

    public function tujuans()
    {
        return $this->hasMany(TujuanSuratKeluar::class, 'surat_keluar_id');
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }
    
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }
}