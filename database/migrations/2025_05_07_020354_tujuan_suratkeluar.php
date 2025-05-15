<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tujuan_suratkeluar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_keluar_id')->nullable();
            $table->unsignedBigInteger('jabatan_id')->nullable();
            $table->unsignedBigInteger('unit_kerja_id')->nullable();
            $table->foreign('surat_keluar_id')->references('id')->on('surat_keluar')->onDelete('set null');
            $table->foreign('jabatan_id')->references('id')->on('jabatan')->onDelete('set null');
            $table->foreign('unit_kerja_id')->references('id')->on('unit_kerja')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tujuan_suratkeluar', function (Blueprint $table) {
            $table->dropForeign(['surat_keluar_id']);
            $table->dropForeign(['jabatan_id']);
            $table->dropForeign(['unit_kerja_id']);
        });

        Schema::dropIfExists('tujuan_suratkeluar');
    }
};

