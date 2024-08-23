<?php

namespace App\Http\Controllers;

use App\Models\sertifikat;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class sertifikatController extends Controller
{
    public function index()
    {
        $sertifikat = sertifikat::with(['siswa:id,nama,nisn'])->get();
        return view('page.keasramaan.quran.sertifikat.sertif', compact('sertifikat'));
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

        return view('page.keasramaan.quran.sertifikat.create', compact('angkatan', 'names'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tanggal' => 'required',
            'siswa_id' => 'required',
            'juz_30' => 'file|max:10240',
            'juz_29' => 'file|max:10240',
            'juz_28' => 'file|max:10240',
            'juz_umum' => 'file|max:10240',

        ], [
            'tanggal.required' => 'Tahun ajaran harus diisi',
        ]);

        // Menyimpan file-file yang di-upload dengan nama asli
        $fileFields = [
            'juz_30',
            'juz_29',
            'juz_28',
            'juz_umum',
        ];

        foreach ($fileFields as $fileField) {
            if ($request->file($fileField)) {
                $file = $request->file($fileField);
                $originalName = Str::random(30) . '.' . $file->getClientOriginalExtension();
                $validateData[$fileField] = $file->storeAs('al-quran/sertifikat', $originalName, 'public');
            }
        }

        sertifikat::create($validateData);

        return redirect('/sekolah-keasramaan/al-quran/sertif')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $sertifikat = sertifikat::find($id);
        return view('page.keasramaan.quran.sertifikat.edit', compact('sertifikat'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'tanggal' => 'required',
            'juz_30' => 'file|max:10240',
            'juz_29' => 'file|max:10240',
            'juz_28' => 'file|max:10240',
            'juz_umum' => 'file|max:10240',
        ], [
            'tanggal.required' => 'Tahun ajaran harus diisi',
        ]);

        $sertifikat = sertifikat::findOrFail($id);

        $fileFields = [
            'juz_30',
            'juz_29',
            'juz_28',
            'juz_umum',
        ];

        foreach ($fileFields as $fileField) {
            if ($request->file($fileField)) {
                // Hapus file lama jika ada
                if ($sertifikat->$fileField) {
                    Storage::delete($sertifikat->$fileField);
                }
                // Simpan file baru
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName, 'public');
            } else {
                // Set the field to the old value if no file was uploaded
                $validateData[$fileField] = $sertifikat->$fileField;
            }
        }

        $sertifikat->update($validateData);

        return redirect('/sekolah-keasramaan/al-quran/sertif')->with('success', 'Data berhasil diperbaharui');
    }


    public function destroy($id)
    {
        $sertifikat = sertifikat::findOrFail($id);

        $fileFields = [
            'juz_30',
            'juz_29',
            'juz_28',
            'juz_umum',
        ];

        foreach ($fileFields as $fileField) {
            if ($sertifikat->$fileField) {
                Storage::delete($sertifikat->$fileField);
            }
        }

        $sertifikat->delete();

        return redirect('/sekolah-keasramaan/al-quran/sertif')->with('success', 'Data berhasil dihapus');
    }
}
