<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TembusanSuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'tembusan_suratmasuk';
    
    protected $fillable = ['surat_masuk_id', 'jabatan_id', 'unit_kerja_id'];

    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_keluar_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }
}
