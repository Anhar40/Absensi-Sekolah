<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Sesi Absensi QR</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800 font-sans">

    <div class="flex h-screen">
        <div class="w-64 bg-slate-900 text-white p-6 hidden md:block">
            <div class="flex items-center gap-3 mb-8">
                <i class="fa-solid fa-qrcode text-2xl text-indigo-400"></i>
                <span class="text-xl font-bold tracking-wider">QR-Absen</span>
            </div>
            <nav class="space-y-2">
                <a href="#" class="flex items-center gap-3 bg-indigo-600 text-white px-4 py-2.5 rounded-lg font-medium transition">
                    <i class="fa-solid fa-calendar-check w-5"></i> Sesi Absensi
                </a>
                <a href="#" class="flex items-center gap-3 text-slate-400 hover:bg-slate-800 hover:text-white px-4 py-2.5 rounded-lg font-medium transition">
                    <i class="fa-solid fa-users w-5"></i> Data Hadir
                </a>
            </nav>
        </div>

        <div class="flex-1 flex flex-col overflow-y-auto">
            <header class="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center shadow-xs">
                <h1 class="text-xl font-bold text-slate-800">Sesi Absensi Sma</h1>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">A</div>
                    <span class="text-sm font-medium text-slate-600">Admin</span>
                </div>
            </header>

            <main class="p-8 max-w-7xl w-full mx-auto">
                
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">Daftar Sesi</h2>
                        <p class="text-sm text-slate-500">Kelola token QR Code dan batas waktu absensi di sini.</p>
                    </div>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg font-semibold flex items-center gap-2 shadow-md shadow-indigo-100 transition duration-200 cursor-pointer">
                        <i class="fa-solid fa-plus"></i> Buat Sesi Baru
                    </button>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                        <span class="font-bold text-slate-700">Semua Sesi Absensi</span>
                        <span class="text-xs font-semibold bg-slate-200 text-slate-700 px-2.5 py-1 rounded-full">
                            Total: {{ $sesiAbsen->count() }} Sesi
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 text-slate-400 uppercase text-xs font-bold tracking-wider border-b border-slate-200">
                                    <th class="py-4 px-6">Nama Sesi (`nama_sesi`)</th>
                                    <th class="py-4 px-6">Waktu Mulai (`waktu_mulai`)</th>
                                    <th class="py-4 px-6">Waktu Selesai (`waktu_selesai`)</th>
                                    <th class="py-4 px-6">Token QR (`qr_token`)</th>
                                    <th class="py-4 px-6">Status</th>
                                    <th class="py-4 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 text-sm">
                                @forelse($sesiAbsen as $sesi)
                                    @php
                                        // Membandingkan waktu_selesai dengan waktu sekarang (Real-time dari server/laptop)
                                        $isExpired = \Carbon\Carbon::now()->greaterThan($sesi->waktu_selesai);
                                    @endphp

                                    <tr class="hover:bg-slate-50/80 transition {{ $isExpired ? 'bg-slate-50/40 text-slate-400' : '' }}">
                                        <td class="py-4 px-6 font-semibold {{ $isExpired ? 'line-through text-slate-400' : 'text-slate-900' }}">
                                            {{ $sesi->nama_sesi }}
                                        </td>
                                        
                                        <td class="py-4 px-6 {{ $isExpired ? 'text-slate-400' : 'text-slate-600' }}">
                                            <i class="fa-regular fa-clock text-slate-400 mr-1.5"></i>
                                            {{ \Carbon\Carbon::parse($sesi->waktu_mulai)->format('d M Y, H:i') }}
                                        </td>
                                        
                                        <td class="py-4 px-6 {{ $isExpired ? 'text-slate-400' : 'text-slate-600' }}">
                                            <i class="fa-regular fa-clock text-slate-400 mr-1.5"></i>
                                            {{ \Carbon\Carbon::parse($sesi->waktu_selesai)->format('d M Y, H:i') }}
                                        </td>
                                        
                                        <td class="py-4 px-6">
                                            <code class="px-2 py-1 rounded border font-mono text-xs {{ $isExpired ? 'bg-slate-50 border-slate-200 text-slate-400' : 'bg-indigo-50 border-indigo-100 text-indigo-700' }}">
                                                {{ $sesi->qr_token }}
                                            </code>
                                        </td>
                                        
                                        <td class="py-4 px-6">
                                            @if($isExpired)
                                                <span class="inline-flex items-center py-1 px-2.5 rounded-full text-xs font-medium bg-slate-100 text-slate-500">
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Aktif
                                                </span>
                                            @endif
                                        </td>
                                        
                                        <td class="py-4 px-6 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                @if($isExpired)
                                                    <button title="Sudah Kedaluwarsa" disabled class="p-2 bg-slate-100 text-slate-300 rounded-lg cursor-not-allowed">
                                                        <i class="fa-solid fa-qrcode"></i>
                                                    </button>
                                                @else
                                                    <button title="Tampilkan QR Code" class="p-2 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 rounded-lg transition cursor-pointer">
                                                        <i class="fa-solid fa-qrcode"></i>
                                                    </button>
                                                @endif
                                                <button title="Hapus" class="p-2 bg-rose-50 text-rose-600 hover:bg-rose-100 rounded-lg transition cursor-pointer">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-12 text-center text-slate-400 italic">
                                            <i class="fa-solid fa-folder-open text-2xl block mb-2 text-slate-300"></i>
                                            Belum ada sesi absensi di database `sesi_absensis`.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

</body>
</html>