<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\tahsin;
use Illuminate\Http\Request;

class tahsinController extends Controller
{
    public function index()
    {
        $tahsin = tahsin::with(['siswa:id,nama,nisn'])->get();
        return view('page.keasramaan.quran.tahsin.tahsin', compact('tahsin'));
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
        return view('page.keasramaan.quran.tahsin.create', compact('angkatan', 'names'));
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
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'surat.required' => 'Surat tahfidz harus diisi',
            'ayat.required' => 'Ayat tahfidz harus diisi',
            'predikat.required' => 'Predikat tahfidz harus diisi',
        ]);

        tahsin::create($validatedData);

        return redirect("/sekolah-keasramaan/al-quran/tahsin")->with("success", "Berhasil disimpan");
    }

    public function edit($id)
    {
        $tahsin = tahsin::find($id);
        return view('page.keasramaan.quran.tahsin.edit', compact('tahsin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
            'surat' => 'required',
            'ayat' => 'required',
            'predikat' => 'required',
            'pengajar' => 'required',
        ], [
            'tanggal.required' => 'Tanggal harus diisi',
            'surat.required' => 'Surat tahfidz harus diisi',
            'ayat.required' => 'Ayat tahfidz harus diisi',
            'predikat.required' => 'Predikat tahfidz harus diisi',
            'pengajar.required' => 'Pengajar harus diisi',
        ]);

        tahsin::find($id)->update([
            'tanggal' => $request->tanggal,
            'surat' => $request->surat,
            'ayat' => $request->ayat,
            'predikat' => $request->predikat,
            'pengajar' => $request->pengajar,
        ]);

        return redirect("/sekolah-keasramaan/al-quran/tahsin")->with("success", "Berhasil diPerbaharui");
    }

    public function destroy($id)
    {
        tahsin::findOrFail($id)->delete();
        return redirect("/sekolah-keasramaan/al-quran/tahsin")->with("success", "Berhasil dihapus");
    }
}
