<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatroliRequest;
use Illuminate\Http\Request;
use App\Models\PatroliAsrama;

class PatroliAsramaController extends Controller
{
    // Display a listing of the resource
    public function index(Request $request)
    {
        $query = PatroliAsrama::query();

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Filter berdasarkan status patroli
        if ($request->filled('status_patroli')) {
            $query->where('status_patroli', $request->status_patroli);
        }

        // Dapatkan hasil query
        $patroliAsrama = $query->get();

        return view('page.keasramaan.patroli.index', compact('patroliAsrama'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('page.keasramaan.patroli.add');
    }

    // Store a newly created resource in storage
    public function store(PatroliRequest $request)
    {
        // Validasi data
        $validateData = $request->validated();

        // Inisialisasi variabel pathDokumentasi
        $pathDokumentasi = null;

        // Periksa apakah file dokumentasi ada
        if ($request->hasFile('dokumentasi')) {
            $pathDokumentasi = $this->handleFileUpload($request) ?? '';
        }

        // Simpan path dokumentasi ke dalam array validateData
        $validateData['dokumentasi'] = $pathDokumentasi;


        // Simpan data ke database
        PatroliAsrama::create($validateData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('patroli.asrama.index')
            ->with('success', 'Patroli Asrama created successfully.');
    }

    // Display the specified resource
    public function show(PatroliAsrama $patroliAsrama)
    {
        return view('patroli.asrama.show', compact('patroliAsrama'));
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $patroliAsrama = PatroliAsrama::findOrFail($id);
        return view('page.keasramaan.patroli.edit', compact('patroliAsrama', 'id'));
    }

    // Update the specified resource in storage
    public function update(PatroliRequest $request, PatroliAsrama $patroliAsrama)
    {
        $request->validated();

        $patroliAsrama->update($request->all());

        return redirect()->route('patroli.asrama.index')
            ->with('success', 'Patroli Asrama updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(PatroliAsrama $patroliAsrama)
    {
        $patroliAsrama->delete();

        return redirect()->route('patroli.asrama.index')
            ->with('success', 'Patroli Asrama deleted successfully.');
    }

    private function handleFileUpload(Request $request)
    {
        if ($request->hasFile('dokumentasi')) {
            $file = $request->file('dokumentasi');

            // Generate a unique file name using a hash
            $originalName = $file->getClientOriginalName();
            $hash = md5($originalName . time());
            $extension = $file->getClientOriginalExtension();
            $uniqueName = 'Dokumentasi-'  . $hash . '.' . $extension;

            // Move the file to the designated directory with the unique name
            $file->move(public_path('/files/patroli/asrama/'), $uniqueName);

            return '/files/patroli/asrama/' . $uniqueName;
        }

        return null;
    }
}
