<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\PklAdministrasiSekolah;

class PklAdministrasiSekolahController extends Controller
{
    // Display a listing of the resource


public function index(Request $request)
{
    // Ambil daftar perusahaan tempat PKL yang unik
    $perusahaanList = PklAdministrasiSekolah::select('nama_perusahaan')->distinct()->pluck('nama_perusahaan');

    // dd($perusahaanList);
    $query = PklAdministrasiSekolah::query();

    // Tambahkan filter berdasarkan perusahaan tempat PKL jika ada input
    if ($request->filled('filter_perusahaan')) {
        $query->where('nama_perusahaan', $request->filter_perusahaan);
    }

    $dataPklSekolah = $query->get();

    return view('database.pkl.adm-sklh.index', compact('dataPklSekolah', 'perusahaanList'));
}



    public function sekolah() {
        $dataPklSekolah = PklAdministrasiSekolah::all();
        return view('database.pkl.adm-sklh.index', compact('dataPklSekolah'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        // Return view to create a new record if needed
        return view('database.pkl.adm-sklh.add');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tahun_ajaran' => 'required|string|max:10',
            'nama_perusahaan' => 'required|string|max:40',
            'path_foto_siswa_dan_perusahaan' => 'required|file',
            'path_foto_mov' => 'required|file',
        ]);

        // Handle file upload
        if ($request->hasFile('path_foto_siswa_dan_perusahaan')) {
            $file = $request->file('path_foto_siswa_dan_perusahaan');
            $namaFile = 'File-Siswa-Perusahaan' . $request->tahun_ajaran . '.' . $file->getClientOriginalExtension();
            $filePath = '/files/pkl/sekolah/';
            $file->move(public_path($filePath), $namaFile);
            $validatedData['path_foto_siswa_dan_perusahaan'] = $filePath . $namaFile;
        } else {
            return response()->json(['error' => 'File not uploaded'], 400);
        }

        // Handle file upload
        if ($request->hasFile('path_foto_mov')) {
            $file = $request->file('path_foto_mov');
            $namaFile = 'File-mov' . $request->tahun_ajaran . '.' . $file->getClientOriginalExtension();
            $filePath = '/files/pkl/sekolah/';
            $file->move(public_path($filePath), $namaFile);
            $validatedData['path_foto_mov'] = $filePath . $namaFile;
        } else {
            return response()->json(['error' => 'File not uploaded'], 400);
        }

        $sekolah = PklAdministrasiSekolah::create($validatedData);
        return redirect()->route('pkl.sekolah.index')->with('success', 'Data berhasil di tambahkan');
    }

    // Display the specified resource
    public function show($id)
    {
        $sekolah = PklAdministrasiSekolah::findOrFail($id);
        return response()->json($sekolah);
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $data = PklAdministrasiSekolah::findOrFail($id);
        return view('database.pkl.adm-sklh.edit', compact('data'));
        // Return view to edit the record if needed
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tahun_ajaran' => 'required|string|max:10',
            'nama_perusahaan' => 'required|string|max:40',
            'path_foto_siswa_dan_perusahaan' => 'sometimes|file',
            'path_foto_mov' => 'sometimes|file',
        ]);

        // Temukan data yang akan diperbarui
        $sekolah = PklAdministrasiSekolah::findOrFail($id);

        // Define the file paths
        $filePath = '/files/pkl/sekolah/';

        // Handle file upload for 'path_foto_siswa_dan_perusahaan'
        if ($request->hasFile('path_foto_siswa_dan_perusahaan')) {
            // Check if the file already exists and delete it
            if ($sekolah->path_foto_siswa_dan_perusahaan) {
                $oldFile = public_path($sekolah->path_foto_siswa_dan_perusahaan);
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }

            $file = $request->file('path_foto_siswa_dan_perusahaan');
            $namaFile = 'File-Siswa-Perusahaan' . $request->tahun_ajaran . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($filePath), $namaFile);
            $validatedData['path_foto_siswa_dan_perusahaan'] = $filePath . $namaFile;
        }

        // Handle file upload for 'path_foto_mov'
        if ($request->hasFile('path_foto_mov')) {
            // Check if the file already exists and delete it
            if ($sekolah->path_foto_mov) {
                $oldFile = public_path($sekolah->path_foto_mov);
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }

            $file = $request->file('path_foto_mov');
            $namaFile = 'File-mov' . $request->tahun_ajaran . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($filePath), $namaFile);
            $validatedData['path_foto_mov'] = $filePath . $namaFile;
        }

        // Update data di database
        $sekolah->update($validatedData);

        return redirect()->route('pkl.sekolah.index')->with('success', 'Data berhasil di update');
    }

    // Remove the specified resource from storage
    public function destroy($id)
{
    // Temukan data yang akan dihapus
    $sekolah = PklAdministrasiSekolah::findOrFail($id);

    // Define the file paths
    $fotoSiswaDanPerusahaanPath = public_path($sekolah->path_foto_siswa_dan_perusahaan);
    $fotoMovPath = public_path($sekolah->path_foto_mov);

    // Hapus file 'path_foto_siswa_dan_perusahaan' jika ada
    if (File::exists($fotoSiswaDanPerusahaanPath)) {
        File::delete($fotoSiswaDanPerusahaanPath);
    }

    // Hapus file 'path_foto_mov' jika ada
    if (File::exists($fotoMovPath)) {
        File::delete($fotoMovPath);
    }

    // Hapus data dari database
    $sekolah->delete();

    return redirect()->route('pkl.sekolah.index')->with('success', 'Data berhasil di hapus');
}
}
