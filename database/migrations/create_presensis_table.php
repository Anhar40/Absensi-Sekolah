<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('sesi_absen_id')->constrained()->onDelete('cascade');
            $table->dateTime('waktu_scan');
            $table->enum('status', ['hadir', 'terlambat', 'izin', 'sakit'])->default('hadir');
            $table->string('keterangan')->nullable(); // Alasan jika izin/sakit
            $table->timestamps();

            // KEAMANAN DB: Mencegah user 'tembak' API absen dua kali di sesi yang sama
            $table->unique(['user_id', 'sesi_absen_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};