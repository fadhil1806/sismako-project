<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\tahfidz;
use Illuminate\Http\Request;

class tahfidzController extends Controller
{
    public function index()
    {
        $tahfidz = tahfidz::with(['siswa:id,nama,nisn'])->get();;
        return view('page.keasramaan.quran.tahfidz.tahfidz', compact('tahfidz'));
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
        return view('page.keasramaan.quran.tahfidz.create', compact('angkatan', 'names'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'siswa_id' => 'required',
            'surat' => 'required',
            'ayat' => 'required',
            'predikat' => 'required',
            'pengajar' => 'required',
        ], [
            'tanggal.required' => 'Tahun ajaran harus diisi',
            'surat.required' => 'Surat harus diisi',
            'ayat.required' => 'Ayat harus diisi',
            'predikat.required' => 'Predikat harus diisi',
            'pengajar.required' => 'Pengajar harus diisi',
        ]);

        tahfidz::create($validatedData);

        return redirect("/sekolah-keasramaan/al-quran/tahfidz")->with("success", "Berhasil disimpan");
    }

    public function edit($id)
    {
        $tahfidz = tahfidz::find($id);
        return view('page.keasramaan.quran.tahfidz.edit', compact('tahfidz'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'surat' => 'required',
            'ayat' => 'required',
            'predikat' => 'required',
            'pengajar' => 'required',
        ], [
            'tanggal.required' => 'Tahun ajaran harus diisi',
            'surat.required' => 'Surat harus diisi',
            'ayat.required' => 'Ayat harus diisi',
            'predikat.required' => 'Predikat harus diisi',
            'pengajar.required' => 'Pengajar harus diisi',
        ]);

        tahfidz::find($id)->update($validatedData);

        return redirect("/sekolah-keasramaan/al-quran/tahfidz")->with("success", "Berhasil diPerbaharui");
    }

    public function destroy($id)
    {
        tahfidz::findOrFail($id)->delete();
        return redirect("/sekolah-keasramaan/al-quran/tahfidz")->with("success", "Berhasil dihapus");
    }
}
