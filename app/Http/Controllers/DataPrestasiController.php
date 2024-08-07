<?php

namespace App\Http\Controllers;

use App\Models\DataPrestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;


class DataPrestasiController extends Controller
{

    public function index(Request $request)
    {
        // Ambil nilai filter status dari query string atau default ke kosong
        $statusFilter = $request->query('status', '');

        // Query untuk mengambil data prestasi
        $query = DataPrestasi::query();

        // Terapkan filter jika ada
        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }

        // Ambil data
        $dataPrestasi = $query->get();

        // Kembalikan view dengan data dan filter
        return view('database.prestasi.index', compact('dataPrestasi', 'statusFilter'));
    }

    public function exportPdf(Request $request)
    {
        // Ambil nilai filter status dari query string atau default ke kosong
        $statusFilter = $request->query('status', '');

        // Debug query string

        // Query untuk mengambil data prestasi
        $query = DataPrestasi::query();

        // Terapkan filter jika ada
        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }

        // Ambil data
        $dataPrestasi = $query->get();

        // Generate HTML untuk PDF
        $html = View::make('template.prestasi', compact('dataPrestasi', 'statusFilter'))->render();

        // Konfigurasi Dompdf
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new \Dompdf\Dompdf($options);

        // Load HTML content
        $dompdf->loadHtml($html);

        // Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Stream the PDF
        return $dompdf->stream('data_prestasi.pdf');
    }


    public function create() {
        return view('database.prestasi.add');
    }


    public function store(Request $request)
{
    // Validate incoming request data
    $validatedData = $request->validate([
        'nama' => 'required|string|max:50',
        'status' => 'required|in:Guru,Siswa',
        'tanggal_lomba' => 'required|date',
        'tempat_lomba' => 'required|string',
        'peringkat' => 'required|string|max:40',
    ]);

    // Handle file upload
    $file = $request->file('path_sertifikat');
    $namaFile =  Str::random(30) . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('/files/prestasi/' . $request->status . '/'), $namaFile);

    // Create a new DataPrestasi record with file path
    DataPrestasi::create(array_merge($validatedData, [
        'nama_file' => '/files/prestasi/' . $request->status . '/' . $namaFile,
        'kelas' => $request->kelas
    ]));

    // Optionally, provide feedback or redirect to another page
    return redirect()->route('prestasi.index')->with('success', 'Data berhasil di tambahkan');
}

public function update(Request $request, $id) {
    // Validate incoming request data
    $validatedData = $request->validate([
        'nama' => 'required|string|max:50',
        'tanggal_lomba' => 'required|date',
        'tempat_lomba' => 'required|string',
        'peringkat' => 'required|string|max:40',
    ]);

    // Find the existing DataPrestasi record by ID
    $data = DataPrestasi::findOrFail($id);

    // Handle file upload
    $file = $request->file('path_sertifikat');
    if ($file) {
        // Delete the existing file if it exists
        if (File::exists(public_path($data->nama_file))) {
            File::delete(public_path($data->nama_file));
        }

        $namaFile =  Str::random(30) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('/files/prestasi/' . $request->status . '/'), $namaFile);

        // Update the DataPrestasi record with new data and file path
        DataPrestasi::where('id', $id)->update(array_merge($validatedData, [
            'nama_file' => '/files/prestasi/' . $request->status . '/' . $namaFile,
            'kelas' => $request->kelas
        ]));
    } else {
        // Update the DataPrestasi record with new data without changing the file path
        DataPrestasi::where('id', $id)->update($validatedData);
    }

    // Optionally, provide feedback or redirect to another page
    return redirect()->route('prestasi.index')->with('success', 'Data berhasil di update');
}

    public function edit($id) {
        $prestasi = DataPrestasi::findOrFail($id);
        return view('database.prestasi.edit', compact('prestasi'));
    }
    public function destroy($id) {
        $prestasi = DataPrestasi::findOrFail($id);
        if (File::exists(public_path($prestasi->nama_file))) {
            File::delete(public_path($prestasi->nama_file));
        }
        $prestasi->delete();
        return redirect()->route('prestasi.index')->with('success', 'Data berhasil dihapus');
    }
}
