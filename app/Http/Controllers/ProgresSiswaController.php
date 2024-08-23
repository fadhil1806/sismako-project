<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Akhlak;
use App\Models\Pelatihan;
use App\Models\Sertifikat;
use App\Models\Siswa;
use App\Models\Tahfidz;
use App\Models\Tahsin;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\View;

class ProgresSiswaController extends Controller
{
    public function index(Request $request, $nisn)
    {
        // Retrieve start_date and end_date from query parameters
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');

        // Retrieve siswa data with related models
        $siswa = Siswa::where('nisn', $nisn)
            ->select('id', 'nama', 'nisn', 'tahun_pelajaran')
            ->with([
                'fotoSiswa',
                'dataKelas',
                'tahfidzSiswa' => function ($query) use ($start_date, $end_date) {
                    $query->betweenDates($start_date, $end_date)->latest('tanggal')->first();
                },
                'tahsinSiswa' => function ($query) use ($start_date, $end_date) {
                    $query->betweenDates($start_date, $end_date)->latest('tanggal')->first();
                },
                'sertifikatSiswa',
                'jurnalAsramaSiswa' => function ($query) use ($start_date, $end_date) {
                    $query->betweenDates($start_date, $end_date);
                },
                'pelatihanSiswa' => function ($query) use ($start_date, $end_date) {
                    $query->betweenDates($start_date, $end_date);
                }
            ])
            ->firstOrFail();

        // Ensure jurnalAsramaSiswa is not null and categorize it
        $jurnalAsramaSiswa = $siswa->jurnalAsramaSiswa ?: collect();

        // Categorize jurnalAsramaSiswa data by 'type'
        $jurnalData = $jurnalAsramaSiswa->groupBy('type');

        // Extract data or set empty collections if not present
        // $akhlakData = $jurnalData->get('akhlak', collect());
        // $fiqihData = $jurnalData->get('fiqih', collect());
        // $tafsirData = $jurnalData->get('tafsir', collect());
        // $tajwidData = $jurnalData->get('tajwid', collect());

        $akhlakData = $jurnalData->get('akhlak', collect())->take(4);
        $fiqihData = $jurnalData->get('fiqih', collect())->take(4);
        $tafsirData = $jurnalData->get('tafsir', collect())->take(4);
        $tajwidData = $jurnalData->get('tajwid', collect())->take(4);

        //         $akhlakData = $jurnalData->get('akhlak', collect())->sortByDesc('tanggal')->take(4);
        // $fiqihData = $jurnalData->get('fiqih', collect())->sortByDesc('tanggal')->take(4);
        // $tafsirData = $jurnalData->get('tafsir', collect())->sortByDesc('tanggal')->take(4);
        // $tajwidData = $jurnalData->get('tajwid', collect())->sortByDesc('tanggal')->take(4);

        // dd($akhlakData, $fiqihData, $tafsirData, $tajwidData); // Debug output


        // Combine all data into a single array
        $combinedData = [
            'akhlak' => $akhlakData,
            'fiqih' => $fiqihData,
            'tafsir' => $tafsirData,
            'tajwid' => $tajwidData,
        ];

        // Add the combined data to the siswa object
        $siswa->jurnalAsramaSiswa = $combinedData;

        // Return the combined data to the view
        return view('page.keasramaan.progresSiswa', compact('siswa', 'start_date', 'end_date'));
    }
}
