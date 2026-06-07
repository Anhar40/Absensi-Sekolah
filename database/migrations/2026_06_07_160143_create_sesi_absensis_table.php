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
      Schema::create('sesi_absensis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sesi'); // Misal: "Absen Masuk Pagi", "Kelas Basis Data"
            $table->string('qr_token')->unique(); // Token unik di dalam QR Code
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai'); // Batas akhir scan
            $table->timestamps();

            // Indexing untuk mempercepat pencarian token oleh Backend saat scan
            $table->index('qr_token');
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi_absensis');
    }
};
