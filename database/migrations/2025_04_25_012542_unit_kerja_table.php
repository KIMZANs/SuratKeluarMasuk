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
        Schema::create('unit_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('nama_unitkerja');
            $table->string('kode_unitkerja');
            $table->timestamps();
        });

        // Menambahkan data unit kerja awal
        DB::table('unit_kerja')->insert([
            'nama_unitkerja' => 'LPDSI',  
            'kode_unitkerja' => 'Unit 13',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_kerja');
    }
};
