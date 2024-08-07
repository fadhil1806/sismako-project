<?php

namespace App\Http\Controllers;

use App\Models\Punishment;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use ZipArchive;


class PunishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $angkatanList = Siswa::select('angkatan')->distinct()->pluck('angkatan');
    $query = Punishment::with('siswa');

    if ($request->filled('angkatan')) {
        $query->whereHas('siswa', function ($query) use ($request) {
            $query->where('angkatan', $request->angkatan);
        });
    }

    if ($request->filled('id_siswa')) {
        $query->where('id_siswa', $request->id_siswa);
    }

    $dataPunishment = $query->get();

    if ($request->ajax()) {
        return response()->json(['data' => $dataPunishment]);
    }

    return view('database.punishment.index', compact('dataPunishment', 'angkatanList'));
}


public function exportPdf(Request $request)
{
    // Ambil parameter filter dari request
    $angkatanFilter = $request->query('angkatan', '');
    $idSiswaFilter = $request->query('id_siswa', '');

    // Query untuk mendapatkan data Punishment dengan filter
    $query = Punishment::with('siswa');

    if ($angkatanFilter) {
        $query->whereHas('siswa', function ($query) use ($angkatanFilter) {
            $query->where('angkatan', $angkatanFilter);
        });
    }

    if ($idSiswaFilter) {
        $query->where('id_siswa', $idSiswaFilter);
    }

    // Ambil data punishment
    $dataPunishment = $query->get();

    // Inisialisasi Dompdf untuk PDF utama
    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $options->set('isHtml5ParserEnabled', true);
    $dompdf = new Dompdf($options);

    // Membuat PDF untuk data punishment
    $html = View::make('template.punishment', compact('dataPunishment'))->render();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dataPunishmentPdfPath = public_path('pdf/data_punishment.pdf');
    file_put_contents($dataPunishmentPdfPath, $dompdf->output());

    // Membuat PDF untuk setiap kronologi
    foreach ($dataPunishment as $index => $data) {
        // Inisialisasi Dompdf untuk setiap PDF kronologi
        $dompdf = new Dompdf($options);

        $kronologiHtml = View::make('template.punishmentKronologi', compact('data'))->render();
        $dompdf->loadHtml($kronologiHtml);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $number = $index + 1;
        $kronologiPdfPath = public_path("pdf/kronologi_pelanggaran_{$number}.pdf");
        file_put_contents($kronologiPdfPath, $dompdf->output());
    }

    // Return a ZIP file
    return $this->zipPdfFiles();
}


private function zipPdfFiles()
{
    $zip = new ZipArchive;
    $zipFileName = public_path('pdf/punishment_files.zip');

    if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
        // Tambahkan file PDF utama
        $zip->addFile(public_path('pdf/data_punishment.pdf'), 'data_punishment.pdf');

        // Tambahkan file PDF kronologi
        $files = glob(public_path('pdf/kronologi_pelanggaran_*.pdf'));
        foreach ($files as $file) {
            $fileName = basename($file);
            $zip->addFile($file, $fileName);
        }

        $zip->close();
    } else {
        return response()->json(['error' => 'Could not create ZIP file'], 500);
    }

    // Hapus file PDF setelah ZIP dibuat
    @unlink(public_path('pdf/data_punishment.pdf')); // @ untuk suppress warning jika file tidak ada
    foreach (glob(public_path('pdf/kronologi_pelanggaran_*.pdf')) as $file) {
        @unlink($file); // @ untuk suppress warning jika file tidak ada
    }

    $response = response()->download($zipFileName);
    $response->deleteFileAfterSend(true);

    return $response;
}



    public function filter(Request $request)
    {
        $angkatan = $request->input('angkatan');
        $siswas = Siswa::where('angkatan', $angkatan)->get();
        return response()->json($siswas);
    }



     public function getSiswaByAngkatan(Request $request) {
        $angkatan = $request->angkatan;
        $siswa = Siswa::where('angkatan', $angkatan)
        ->select('id', 'nama')
        ->get();
        return response()->json($siswa);
    }
    public function create()
{
    $angkatan = Siswa::distinct()->pluck('angkatan');
    return view('database.punishment.add', compact('angkatan'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi data
    $validatedData = $request->validate([
        'angkatan' => 'required|integer',
        'tanggal' => 'required|date',
        'id_siswa' => 'required|integer',
        'tindak_lanjut' => 'required',
        'jenis_pelanggaran' => 'required|string|max:75',
        'kronologi' => 'required|string',
        'pengawasan_guru' => 'required|string|max:50',
        'pengurangan_point' => 'required|integer',
        'path_dokumen' => 'nullable|file|max:2048',
    ]);

    // Handle file upload
    if ($request->hasFile('path_dokumen')) {
        $file = $request->file('path_dokumen');
        $namaFile = Str::random(30) . '.' . $file->getClientOriginalExtension();
        $filePath = '/files/punishment/';
        $file->move(public_path($filePath), $namaFile);
        $validatedData['path_dokumen'] = $filePath . $namaFile;
    }

    // Retrieve the student
    $siswa = Siswa::findOrFail($validatedData['id_siswa']);

    // Calculate new points
    $newPoints = $siswa->point - $validatedData['pengurangan_point'];

    // Update student's points and save
    $siswa->point = $newPoints;
    $siswa->save();

    // Create the punishment record
    Punishment::create($validatedData);

    return redirect()->route('punishment.index')->with('success', 'data punishment berhasil ditambahkan');
}

    /**
     * Display the specified resource.
     */
    public function show(Punishment $punishment)
    {
        return view('punishments.show', compact('punishment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $punishment = Punishment::findOrFail($id);
    $angkatan = Siswa::select('angkatan')->distinct()->pluck('angkatan'); // Ambil daftar angkatan yang unik
    return view('database.punishment.edit', compact('punishment', 'angkatan'));
}

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, $id)
     {
         // Validasi data
         $validatedData = $request->validate([
             'angkatan' => 'required|integer',
             'tanggal' => 'required|date',
             'id_siswa' => 'required|integer',
             'tindak_lanjut' => 'required',
             'jenis_pelanggaran' => 'required|string|max:75',
             'kronologi' => 'required|string',
             'pengawasan_guru' => 'required|string|max:50',
             'pengurangan_point' => 'required|integer',
             'path_dokumen' => 'nullable|file|max:2048',
         ]);

         // Ambil data punishment lama
         $punishment = Punishment::findOrFail($id);

         // Ambil siswa terkait
         $siswa = Siswa::findOrFail($punishment->id_siswa);

         // Tambahkan kembali pengurangan point lama
         $siswa->point += $punishment->pengurangan_point;

         // Kurangi dengan pengurangan point baru
         $siswa->point -= $validatedData['pengurangan_point'];

         // Simpan perubahan point siswa
         $siswa->save();

         // Handle file upload
         if ($request->hasFile('path_dokumen')) {
             // Hapus file lama jika ada
             if ($punishment->path_dokumen && file_exists(public_path($punishment->path_dokumen))) {
                 unlink(public_path($punishment->path_dokumen));
             }

             // Simpan file baru
             $file = $request->file('path_dokumen');
             $namaFile = Str::random(30) . '.' . $file->getClientOriginalExtension();
             $filePath = '/files/punishment/';
             $file->move(public_path($filePath), $namaFile);
             $validatedData['path_dokumen'] = $filePath . $namaFile;
         } else {
             // Jika tidak ada file baru, pertahankan path dokumen lama
             $validatedData['path_dokumen'] = $punishment->path_dokumen;
         }

         // Update punishment dengan data baru
         $punishment->update($validatedData);

         return redirect()->route('punishment.index')->with('success', 'data punishment berhasil di update');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Ambil data punishment yang akan dihapus
    $punishment = Punishment::findOrFail($id);

    // Ambil siswa terkait
    $siswa = Siswa::findOrFail($punishment->id_siswa);

    // Tambahkan kembali pengurangan point ke siswa
    $siswa->point += $punishment->pengurangan_point;

    // Simpan perubahan point siswa
    $siswa->save();

    // Hapus punishment
    $punishment->delete();

    return redirect()->route('punishment.index')->with('success', 'data punishment berhasil dihapus');
}
}
