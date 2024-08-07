<?php

namespace App\Http\Controllers;

use App\Models\PklAdministrasiSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PklAdministrasiSiswaController extends Controller
{
    // Display a listing of the resource
    public function index(Request $request)
{
    // Ambil daftar perusahaan tempat PKL yang unik
    $perusahaanList = PklAdministrasiSiswa::select('tempat_pkl')->distinct()->pluck('tempat_pkl');

    $query = PklAdministrasiSiswa::query();

    // Tambahkan filter berdasarkan perusahaan tempat PKL jika ada input
    if ($request->filled('filter_perusahaan')) {
        $query->where('tempat_pkl', $request->filter_perusahaan);
    }

    $dataPklSiswa = $query->get();

    return view('database.pkl.adm-siswa.index', compact('dataPklSiswa', 'perusahaanList'));
}


    // Show the form for creating a new resource
    public function create()
    {
        // Return view to create a new record if needed
        return view('database.pkl.adm-siswa.add');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nama' => 'required|string|max:50',
        'nisn' => 'required|string|max:20',
        'tempat_pkl' => 'required|string|max:50',
        'path_rekap_kehadiran' => 'required|file',
        'path_jurnal_pkl' => 'required|file',
    ]);

    // Handle file upload for path_rekap_kehadiran
    if ($request->hasFile('path_rekap_kehadiran')) {
        $file = $request->file('path_rekap_kehadiran');
        $namaFile = 'File-kehadiran-' . $request->nama . '.' . $file->getClientOriginalExtension();
        $filePath = '/files/pkl/siswa/rekap_kehadiran/';
        $file->move(public_path($filePath), $namaFile);
        $validatedData['path_rekap_kehadiran'] = $filePath . $namaFile;
    } else {
        return response()->json(['error' => 'File rekap kehadiran not uploaded'], 400);
    }

    // Handle file upload for path_jurnal_pkl
    if ($request->hasFile('path_jurnal_pkl')) {
        $file = $request->file('path_jurnal_pkl');
        $namaFile = 'File-Jurnal-PKL-' . $request->nama . '.' . $file->getClientOriginalExtension();
        $filePath = '/files/pkl/siswa/jurnal_pkl/';
        $file->move(public_path($filePath), $namaFile);
        $validatedData['path_jurnal_pkl'] = $filePath . $namaFile;
    } else {
        return response()->json(['error' => 'File jurnal PKL not uploaded'], 400);
    }

    PklAdministrasiSiswa::create($validatedData);

    return redirect()->route('pkl.siswa.index')->with('success', 'Data berhasil di tambahkan');
}

    // Display the specified resource
    public function show($id)
    {
        $siswa = PklAdministrasiSiswa::findOrFail($id);
        return response()->json($siswa);
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $data = PklAdministrasiSiswa::findOrFail($id);
        return view('database.pkl.adm-siswa.edit', compact('data'));
        // Return view to edit the record if needed
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:50',
            'nisn' => 'required|string|max:20',
            'tempat_pkl' => 'required|string|max:50',
            'path_rekap_kehadiran' => 'sometimes|file',
            'path_jurnal_pkl' => 'sometimes|file',
        ]);

        // Temukan data yang akan diperbarui
        $siswa = PklAdministrasiSiswa::findOrFail($id);

        // Define the file paths
        $rekapKehadiranPath = '/files/pkl/siswa/rekap_kehadiran/';
        $jurnalPklPath = '/files/pkl/siswa/jurnal_pkl/';

        // Handle file upload for 'path_rekap_kehadiran'
        if ($request->hasFile('path_rekap_kehadiran')) {
            // Check if the file already exists and delete it
            if ($siswa->path_rekap_kehadiran) {
                $oldFile = public_path($siswa->path_rekap_kehadiran);
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }

            $file = $request->file('path_rekap_kehadiran');
            $namaFile = 'File-kehadiran-' . $request->nama . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($rekapKehadiranPath), $namaFile);
            $validatedData['path_rekap_kehadiran'] = $rekapKehadiranPath . $namaFile;
        }

        // Handle file upload for 'path_jurnal_pkl'
        if ($request->hasFile('path_jurnal_pkl')) {
            // Check if the file already exists and delete it
            if ($siswa->path_jurnal_pkl) {
                $oldFile = public_path($siswa->path_jurnal_pkl);
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }

            $file = $request->file('path_jurnal_pkl');
            $namaFile = 'File-Jurnal-PKL-' . $request->nama . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($jurnalPklPath), $namaFile);
            $validatedData['path_jurnal_pkl'] = $jurnalPklPath . $namaFile;
        }

        // Update data di database
        $siswa->update($validatedData);

        return redirect()->route('pkl.siswa.index')->with('success', 'Data berhasil di update');
    }


    // Remove the specified resource from storage
    public function destroy($id)
{
    // Temukan data yang akan dihapus
    $siswa = PklAdministrasiSiswa::findOrFail($id);

    // Define the file paths
    $rekapKehadiranPath = public_path($siswa->path_rekap_kehadiran);
    $jurnalPklPath = public_path($siswa->path_jurnal_pkl);

    // Hapus file 'path_rekap_kehadiran' jika ada
    if (File::exists($rekapKehadiranPath)) {
        File::delete($rekapKehadiranPath);
    }

    // Hapus file 'path_jurnal_pkl' jika ada
    if (File::exists($jurnalPklPath)) {
        File::delete($jurnalPklPath);
    }

    // Hapus data dari database
    $siswa->delete();

    return redirect()->route('pkl.siswa.index')->with('success', 'Data berhasil dihapus');
}

}
