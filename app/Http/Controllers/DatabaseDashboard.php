<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Tendik;
use Illuminate\Http\Request;
use App\Models\DataKelulusan;

class DatabaseDashboard extends Controller
{
    //
    public function index()
    {
        $totalGuruAktif = Guru::where('status_kepegawaian', 'aktif')->count();
        $totalGuruTidakAktif = Guru::where('status_kepegawaian', 'tidak aktif')->count();

        $totalSiswaAktif = Siswa::where('status_siswa', 'Aktif')->count();
        $totalSiswaTidakAktif = Siswa::where('status_siswa', 'Tidak aktif')->count();

        $totalTendikAktif = Tendik::where('status_kepegawaian', 'aktif')->count();
        $totalTendikTidakAktif = Tendik::where('status_kepegawaian', 'tidak aktif')->count();

        $totalKelulusanSiswa = DataKelulusan::count();
        return view(
            'dashboard',
            compact(
                'totalGuruAktif',
                'totalGuruTidakAktif',
                'totalSiswaAktif',
                'totalSiswaTidakAktif',
                'totalKelulusanSiswa',
                'totalTendikAktif',
                'totalTendikTidakAktif'
            )
        );
    }
}
