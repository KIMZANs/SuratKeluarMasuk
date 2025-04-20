<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GolonganJabatan extends Model
{
    use HasFactory;

    protected $table = 'golongan_jabatan'; // Nama tabel
    protected $fillable = ['nama_jabatan', 'nama_golongan']; // Kolom yang dapat diisi
}
