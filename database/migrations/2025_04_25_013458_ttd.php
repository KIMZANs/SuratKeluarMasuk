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
        Schema::create('ttd', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama unit kerja
            $table->string('jabatan'); // Kode unit kerja
            $table->string('ttd'); // Kolom untuk menyimpan path foto
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ttd');
    }
};
