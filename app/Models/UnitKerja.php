<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;

    protected $table = 'unit_kerja'; // Nama tabel
    protected $fillable = ['nama_unitkerja', 'kode_unitkerja']; // Kolom yang dapat diisi

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
