<?php

namespace App\Http\Controllers;

use App\Models\DataMutasi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;

class DataMutasiController extends Controller
{
    public function index(Request $request)
    {
        $mutasiFilter = $request->query('mutasi', ''); // Default empty filter
        $statusFilter = $request->query('status', ''); // Default empty filter

        $query = DataMutasi::query();

        if ($mutasiFilter) {
            $query->where('mutasi', $mutasiFilter);
        }

        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }

        $dataMutasi = $query->get();

        return view('database.mutasi.index', compact('dataMutasi', 'mutasiFilter', 'statusFilter'));
    }



    public function exportPdf(Request $request)
    {
        $mutasiFilter = $request->query('mutasi', ''); // Default empty filter
        $statusFilter = $request->query('status', ''); // Default empty filter

        $query = DataMutasi::query();

        if ($mutasiFilter) {
            $query->where('mutasi', $mutasiFilter);
        }

        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }

        $dataMutasi = $query->get();

        $html = View::make('template.dataMutasi', compact('dataMutasi'))->render();

        // Instantiate Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);

        // Load HTML content
        $dompdf->loadHtml($html);

        // Set paper size and orientation to landscape
        $dompdf->setPaper('F4', 'landscape');

        // Render PDF (important step!)
        $dompdf->render();

        return $dompdf->stream('data_mutasi.pdf');
    }

    public function create()
    {
        //
        return view('database.mutasi.add');
    }
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:50',
                'status' => 'required|in:Guru,Siswa',
                'mutasi' => 'required|in:Masuk,Keluar',
                'tanggal_mutasi' => 'required|date',
                'asal_sekolah' => 'nullable|string|max:50',
                'tujuan_berikutnya' => 'nullable|string|max:50',
                'alasan' => 'required|string',
                'path_dokumen_pendukung_tambahan' => 'required|file',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

         // Handle file upload
        $file = $request->file('path_dokumen_pendukung_tambahan');
        $namaFile =  'Dokumen-Pendukung-Tambahan-' . $request->nama . '-' . $request->status . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('/files/mutasi/' . $request->status . '/'), $namaFile);

        $validatedData['path_dokumen_pendukung_tambahan'] = '/files/mutasi/' . $request->status . '/' . $namaFile;

        DataMutasi::create($validatedData);

        return redirect()->route('mutasi.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $dataMutasi = DataMutasi::findOrFail($id);
        $dataMutasi->tanggal_mutasi = Carbon::parse($dataMutasi->tanggal_mutasi);
        return view('database.mutasi.edit', compact('dataMutasi'));
    }

    public function update(Request $request, $id)
    {

        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:50',
                'status' => 'required|in:Guru,Siswa',
                'mutasi' => 'required|in:Masuk,Keluar',
                'tanggal_mutasi' => 'required|date',
                'asal_sekolah' => 'nullable|string|max:50',
                'tujuan_berikutnya' => 'nullable|string|max:50',
                'alasan' => 'required|string',
                'path_dokumen_pendukung_tambahan' => 'required|file',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        DataMutasi::findOrFail($id)->update($validatedData);

        return redirect()->route('mutasi.index')->with('success', 'Data berhasil di update');
    }

    public function destroy($id)
    {
        // Temukan data yang akan dihapus
        $dataMutasi = DataMutasi::findOrFail($id);

        // Hapus data tersebut
        $dataMutasi->delete();

        // Mengembalikan respon sukses
        return redirect()->route('mutasi.index')->with('success', 'Data berhasil dihapus');
    }
}
