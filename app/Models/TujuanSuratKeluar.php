<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TujuanSuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'tujuan_suratkeluar';

    protected $fillable = [
        'surat_keluar_id',
        'jabatan_id',
        'unit_kerja_id',
    ];

    public function suratKeluar()
    {
        return $this->belongsTo(SuratKeluar::class, 'surat_keluar_id');
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