<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'pengguna', 'penandatangan', 'reviewer']);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('jabatan')->nullable();
            $table->unsignedBigInteger('golongan_jabatan')->nullable();
            $table->unsignedBigInteger('unit_kerja')->nullable();
            $table->text('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
