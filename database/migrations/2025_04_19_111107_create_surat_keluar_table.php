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
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique(); // Nomor surat
            $table->string('pengirim'); // Pengirim surat
            $table->string('tujuan'); // Tujuan surat
            $table->string('tembusan'); // Tembusan surat
            $table->string('tanggal'); // Tanggal surat
            $table->string('sifat'); // Sifat surat
            $table->string('perihal'); // Perihal surat
            $table->string('isi_surat'); // Isi surat
            $table->enum('reviewer', ['diproses', 'selesai']); // Status surat 
            $table->enum('penandatangan', ['diproses', 'selesai']); // Status surat
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};
