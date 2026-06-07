<?php

namespace Database\Seeders; // DI SINI PERBAIKANNYA

use App\Models\User;
use App\Models\SesiAbsen;
use App\Models\Presensi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AbsensiSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Generate User Dummy untuk dicoba tim Frontend/Backend
        $user1 = User::create([
            'nomor_induk' => '2026001',
            'name' => 'Rahmat Kurniawan',
            'email' => 'rahmat@example.com',
            'password' => Hash::make('password123'),
        ]);

        $user2 = User::create([
            'nomor_induk' => '2026002',
            'name' => 'Sry Wulandari',
            'email' => 'sry@example.com',
            'password' => Hash::make('password123'),
        ]);

        // 2. Buat Sesi Absen
        $sesiPagi = SesiAbsen::create([
            'nama_sesi' => 'Absen Masuk Pagi - Reguler',
            'qr_token' => 'QR-MASUK-' . Str::random(16),
            'waktu_mulai' => Carbon::now()->startOfDay()->addHours(7), // 07:00
            'waktu_selesai' => Carbon::now()->startOfDay()->addHours(9), // 09:00
        ]);

        // 3. Buat Log Riwayat Scan Dummy
        Presensi::create([
            'user_id' => $user1->id,
            'sesi_absen_id' => $sesiPagi->id,
            'waktu_scan' => Carbon::now()->startOfDay()->addHours(7)->addMinutes(15), // Scan jam 07:15
            'status' => 'hadir',
        ]);

        Presences::create([
            'user_id' => $user2->id,
            'sesi_absen_id' => $sesiPagi->id,
            'waktu_scan' => Carbon::now()->startOfDay()->addHours(8)->addMinutes(45), // Scan jam 08:45
            'status' => 'terlambat',
        ]);
    }
}