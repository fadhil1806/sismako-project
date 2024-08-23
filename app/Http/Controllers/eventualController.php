<?php

namespace App\Http\Controllers;

use App\Models\pelatihan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class eventualController extends Controller
{
    public function index()
    {
        $eventual = pelatihan::where('type', 'eventual')->with(['siswa:id,nama,nisn'])->get();
        return view('page.keasramaan.akademik.volentir.volentir', compact('eventual'));
    }

    public function create(Request $request)
    {
        $mutasiFilter = $request->query('angkatan', ''); // Default empty filter

        // Fetch distinct angkatan values from Siswa model
        $angkatan = Siswa::distinct()->pluck('angkatan');

        // Get the selected angkatan from the request or default to an empty string
        $defaultAngkatan = $request->angkatan;

        // Fetch names for the selected angkatan if available
        $names = $defaultAngkatan ? Siswa::where('angkatan', $defaultAngkatan)->get(['id', 'nama', 'angkatan']) : collect();
        return view('page.keasramaan.akademik.volentir.create', compact('angkatan', 'names'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tanggal' => 'required',
            'siswa_id' => 'required',
            'kegiatan' => 'required',
            'keterangan' => 'required',
            'dokumentasi.' => 'file|max:10240',
            'undangan.' => 'file|max:10240',
        ], [
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'kegiatan.required' => 'Nama kegiatan yang dilaksanakan tidak boleh kosong',
            'keterangan.required' => 'Keterangan Tidak boleh kosong',
            'dokumentasi.*.max' => 'Ukuran file yang diupload maksimal 10MB',
            'undangan.*.max' => 'Ukuran file yang diupload maksimal 10MB',
        ]);

        $fileFields = ['dokumentasi', 'undangan'];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $files = $request->file($fileField);
                $storedFiles = [];

                foreach ($files as $index => $file) {
                    if ($index < 3) { // Batas maksimal 3 file
                        $originalName = $file->getClientOriginalName();
                        $storedFiles[] = $file->storeAs($fileField, $originalName, 'public');
                    }
                }
                $validateData[$fileField] = json_encode($storedFiles);
            }
        }

        pelatihan::create(array_merge($validateData, ['type' => 'eventual']));
        return redirect('/sekolah-keasramaan/akademik/eventual')->with('success', 'Data berhasil ditambahkan');
    }


    public function edit($id)
    {
        $eventual = pelatihan::findOrFail($id);
        return view('page.keasramaan.akademik.volentir.edit', compact('eventual'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'tanggal' => 'required',
            'kelas' => 'required',
            'nama' => 'required',
            'nisn' => 'required',
            'kegiatan' => 'required',
            'keterangan' => 'required',
            'dokumentasi.' => 'file|max:10240',
            'undangan.' => 'file|max:10240',
        ],[
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'kelas.required' => 'Kelas tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
            'nisn.required' => 'NISN (Nomor Induk Siswa Nasional) tidak boleh kosong',
            'kegiatan.required' => 'Nama kegiatan yang dilaksanakan tidak boleh kosong',
            'keterangan.required' => 'Keterangan Tidak boleh kosong',
            'dokumentasi.*.max' => 'Ukuran file yang diupload maksimal 10MB',
            'undangan.*.max' => 'Ukuran file yang diupload maksimal 10MB',
        ]);

        $eventual = pelatihan::findOrFail($id);

        $fileFields = ['dokumentasi', 'undangan'];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $files = $request->file($fileField);
                $storedFiles = [];

                foreach ($files as $index => $file) {
                    if ($index < 3) {
                        // Hapus file lama jika ada
                        $existingFiles = json_decode($eventual->$fileField);
                        if (isset($existingFiles[$index])) {
                            Storage::delete($existingFiles[$index]);
                        }

                        $originalName = $file->getClientOriginalName();
                        $storedFiles[] = $file->storeAs($fileField, $originalName);
                    }
                }
                $validateData[$fileField] = json_encode($storedFiles);
            } else {
                $validateData[$fileField] = $eventual->$fileField;
            }
        }
        $eventual->update($validateData);
        return redirect('/sekolah-keasramaan/akademik/eventual')->with('success', 'Data berhasil diperbaharui');
    }


    public function destroy($id)
    {
        $eventual = pelatihan::findOrFail($id);

        $fileFields = [
            'dokumentasi',
            'undangan',
        ];

        foreach ($fileFields as $fileField) {
            if ($eventual->$fileField) {
                Storage::delete($eventual->$fileField);
            }
        }

        $eventual->delete();

        return redirect('/sekolah-keasramaan/akademik/eventual')->with('success', 'Data berhasil dihapus');
    }
}
