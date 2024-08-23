<?php

namespace App\Http\Controllers;

use App\Models\akhlak;
use App\Models\Siswa;
use Illuminate\Http\Request;

class akhlakController extends Controller
{
    public function index()
    {
        $akhlak = akhlak::where('type', 'akhlak')
        ->with([
            'siswa:id,nama,nisn',
            'siswa.dataKelas:id,id_siswa,kelas' // 'id_siswa' is the correct foreign key
        ])
        ->get();


        return view('page.keasramaan.jurnal.akhlak.akhlak', compact('akhlak'));
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
        return view('page.keasramaan.jurnal.akhlak.create', compact('angkatan', 'names'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tanggal' => 'required',
            'siswa_id' => 'required',
            'materi' => 'required',
        ], [
            'tanggal.required' => 'Tahun ajaran harus diisi',
            'materi.required' => 'Materi harus diisi',
        ]);

        akhlak::create(array_merge($validateData, ['type' => 'akhlak']));
        return redirect("/sekolah-keasramaan/jurnal-asrama/akhlak")->with("success", "Berhasil disimpan");
    }

    public function edit($id)
    {
        $akhlak = akhlak::find($id);
        return view('page.keasramaan.jurnal.akhlak.edit', compact('akhlak'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'materi' => 'required',
        ], [
            'tanggal.required' => 'Tahun ajaran harus diisi',
            'materi.required' => 'Materi harus diisi',
        ]);

        akhlak::find($id)->update($validatedData);

        return redirect("/sekolah-keasramaan/jurnal-asrama/akhlak")->with("success", "Berhasil diPerbaharui");
    }

    public function destroy($id)
    {
        akhlak::findOrFail($id)->delete();
        return redirect("/sekolah-keasramaan/jurnal-asrama/akhlak")->with("success", "Berhasil dihapus");
    }
}
