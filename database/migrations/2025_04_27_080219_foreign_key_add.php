<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->foreign('pengirim')->references('id')->on('jabatan')->onDelete('set null');
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('jabatan')->references('id')->on('jabatan')->onDelete('set null');
            $table->foreign('golongan_jabatan')->references('id')->on('golongan_jabatan')->onDelete('set null');
            $table->foreign('unit_kerja')->references('id')->on('unit_kerja')->onDelete('set null');
        });

        // Insert default admin user
        DB::table('users')->insert([
            'nama' => 'Admin',
            'nip' => '1234567890',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'status' => 'active',
            'jabatan' => '1',
            'golongan_jabatan' => '1',
            'unit_kerja' => '1',
            'photo' => 'assets/Logo_IPDN.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'nama' => 'Cau',
            'nip' => '123456789',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1990-01-01',
            'email' => 'cau@gmail.com',
            'password' => Hash::make('cau123'),
            'role' => 'pengguna',
            'status' => 'active',
            'jabatan' => '1',
            'golongan_jabatan' => '1',
            'unit_kerja' => '1',
            'photo' => 'assets/Logo_IPDN.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['jabatan']);
            $table->dropForeign(['golongan_jabatan']);
            $table->dropForeign(['unit_kerja']);
        });

        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->dropForeign(['pengirim']);
        });
    }
};
