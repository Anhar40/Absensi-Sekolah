<?php

namespace App\Http\Controllers;

use App\Models\SesiAbsensi; // 1. Import model
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 2. Ambil data
        $sesiAbsen = SesiAbsensi::all(); 
        
        // 3. Kirim ke view
        return view('sesi_absen', compact('sesiAbsen'));
    }
}
