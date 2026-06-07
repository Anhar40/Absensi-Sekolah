<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'sesi_absen_id', 'waktu_scan', 'status', 'keterangan'];

    // Mengetahui informasi user yang melakukan scan
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mengetahui detail sesi dari baris absensi ini
    public function sesiAbsen()
    {
        return $this->belongsTo(SesiAbsen::class, 'sesi_absen_id');
    }
}