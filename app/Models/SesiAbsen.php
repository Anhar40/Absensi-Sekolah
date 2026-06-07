<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiAbsen extends Model
{
    use HasFactory;

    protected $fillable = ['nama_sesi', 'qr_token', 'waktu_mulai', 'waktu_selesai'];

    // Mengetahui semua log absensi pada sesi ini
    public function presensis()
    {
        return $this->hasMany(Presensi::class, 'sesi_absen_id');
    }
}