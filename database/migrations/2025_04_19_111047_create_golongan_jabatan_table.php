<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('golongan_jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jabatan'); // Nama jabatan
            $table->string('nama_golongan'); // Golongan jabatan
            $table->timestamps();
        });

        // Menambahkan data jabatan awal
        DB::table('golongan_jabatan')->insert([
            'nama_jabatan' => 'Manager',  
            'nama_golongan' => 'Golongan 1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('golongan_jabatan');
    }
};
