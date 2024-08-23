<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\akhlak;
use App\Models\pelatihan;
use App\Models\sertifikat;
use App\Models\Siswa;
use App\Models\tahfidz;
use App\Models\tahsin;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProgresSiswaController extends Controller
{
    //

    public function index(Request $request, $nisn): JsonResponse
    {
        // Retrieve start_date and end_date from query parameters
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');

        // $student = Siswa::where('nisn', $nisn)->get();
        $akhlakData = akhlak::nisn($nisn)->type('akhlak')->whereBetween('tanggal', [$start_date, $end_date])->get();
        $tafsirData = akhlak::nisn($nisn)->type('tafsir')->whereBetween('tanggal', [$start_date, $end_date])->get();
        $fiqihData = akhlak::nisn($nisn)->type('fiqih')->whereBetween('tanggal', [$start_date, $end_date])->get();
        $tajwidData = akhlak::nisn($nisn)->type('tajwid')->whereBetween('tanggal', [$start_date, $end_date])->get();
        // Fetch pelatihan, lomba, and eventual data based on nisn and date range
        $pelatihanData = pelatihan::where('nisn', $nisn)
            ->whereBetween('tanggal', [$start_date, $end_date])
            ->get();

        $lombaData = tahsin::where('nisn', $nisn)
            ->whereBetween('tanggal', [$start_date, $end_date])
            ->get();

        $eventualData = tahfidz::where('nisn', $nisn)
            ->whereBetween('tanggal', [$start_date, $end_date])
            ->get();

        $sertifikat = sertifikat::where('nisn', $nisn)
            ->get();

        // Combine all data into a single object
        $combinedData = [
            // 'data' => $dataSiswa,
            'akhlak' => $akhlakData,
            'tafsir' => $tafsirData,
            'fiqih' => $fiqihData,
            'tajwid' => $tajwidData,
            // 'pelatihan' => $pelatihanData,
            // 'tahsin' => $lombaData,
            // 'tahdfidz' => $eventualData,
            // 'sertifikat' => $sertifikat
        ];

        // Return combined data as JSON
        return response()->json($combinedData);
    }
}
