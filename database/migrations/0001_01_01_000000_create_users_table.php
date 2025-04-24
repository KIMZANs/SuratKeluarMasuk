<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nip')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'pengguna', 'penandatangan', 'reviewer']);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('unit_kerja', ['Unit Kerja 1', 'Unit Kerja 2', 'Unit Kerja 3']);
            $table->text('photo')->nullable(); // Kolom untuk menyimpan path foto
            $table->timestamps();
        });

        // Tambahkan akun admin langsung
        DB::table('users')->insert([
            'name' => 'Admin',
            'nip' => '1234567890',  
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'), // Password diubah menjadi 'admin'
            'role' => 'admin',
            'status' => 'active',
            'unit_kerja' => 'Unit Kerja 1', // Ganti dengan unit kerja yang sesuai
            'photo' => 'assets/Logo_IPDN.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
