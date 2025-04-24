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
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique(); // Nomor surat masuk
            $table->string('pengirim'); // Pengirim surat masuk
            $table->string('tujuan'); // Tujuan surat masuk
            $table->string('tembusan'); // Tembusan surat masuk
            $table->string('tanggal_masuk'); // Tanggal surat masuk
            $table->string('tanggal_diterima'); // Tanggal diterima surat masuk
            $table->enum('sifat', ['Penting', 'Biasa']); // Sifat surat masuk
            $table->string('perihal'); // Perihal surat masuk
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
};
