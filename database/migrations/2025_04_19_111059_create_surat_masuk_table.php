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
            $table->string('nomor_surat')->unique(); // Nomor surat
            $table->string('pengirim'); // Pengirim surat
            $table->string('perihal'); // Perihal surat
            $table->date('tanggal_surat'); // Tanggal surat
            $table->date('tanggal_diterima'); // Tanggal diterima
            $table->text('keterangan')->nullable(); // Keterangan tambahan
            $table->string('file_surat')->nullable(); // File surat (jika ada)
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
