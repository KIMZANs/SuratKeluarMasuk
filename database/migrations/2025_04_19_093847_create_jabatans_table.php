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
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jabatan'); // Nama jabatan
            $table->text('keterangan')->nullable(); // Deskripsi jabatan
            $table->timestamps();
        });

        // Menambahkan data jabatan awal
        DB::table('jabatan')->insert([
            'nama_jabatan' => 'Manager',  
            'keterangan' => 'Jabatan Manager',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan');
    }
};
