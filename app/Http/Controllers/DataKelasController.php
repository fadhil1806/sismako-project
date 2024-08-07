<?php

namespace App\Http\Controllers;

use App\Models\DataKelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;

class DataKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */public function index(Request $request)
{
    $tahunPelajaranFilter = $request->query('tahun_pelajaran', '');
    $kelasFilter = $request->query('kelas', '');
    $angkatanFilter = $request->query('angkatan', '');

    $query = DataKelas::query();

    if ($tahunPelajaranFilter) {
        $query->where('tahun_pelajaran', $tahunPelajaranFilter);
    }

    if ($kelasFilter) {
        $query->where('kelas', $kelasFilter);
    }

    if ($angkatanFilter) {
        $query->where('angkatan', $angkatanFilter);
    }

    // Tambahkan kondisi untuk mengecualikan kelas "Lulus"
    $query->where('kelas', '!=', 'Lulus');

    // Order by 'no_urut'
    $dataKelas = $query->with('siswa')->orderBy('no_urut')->get();

    // Get unique values for the filter dropdowns
    $availableTahunPelajaran = DataKelas::select('tahun_pelajaran')->distinct()->pluck('tahun_pelajaran');
    $availableKelas = DataKelas::select('kelas')->distinct()->pluck('kelas');
    $availableAngkatan = DataKelas::select('angkatan')->distinct()->pluck('angkatan');

    return view('database.kelas.index', compact(
        'dataKelas',
        'tahunPelajaranFilter',
        'kelasFilter',
        'angkatanFilter',
        'availableTahunPelajaran',
        'availableKelas',
        'availableAngkatan'
    ));
}


    public function upgrade()
    {
        $kelasMapping = [
            'X' => 'XI',
            'XI' => 'XII',
            'XII' => 'XIII',
            'XIII' => 'Lulus'
        ];

        $dataKelas = DataKelas::all();

        foreach ($dataKelas as $data) {
            if (isset($kelasMapping[$data->kelas])) {
                $data->kelas = $kelasMapping[$data->kelas];
                $data->save();
            }
        }

        return redirect()->route('kelas.index')->with('success', 'Semua kelas berhasil dinaikkan.');
    }
    public function exportPdf(Request $request)
    {
        // Define filters
        $tahunPelajaranFilter = $request->query('tahun_pelajaran', '');
        $kelasFilter = $request->query('kelas', '');
        $angkatanFilter = $request->query('angkatan', '');

        // Create query for DataKelas with applied filters
        $query = DataKelas::query();

        if ($tahunPelajaranFilter) {
            $query->where('tahun_pelajaran', $tahunPelajaranFilter);
        }

        if ($kelasFilter) {
            $query->where('kelas', $kelasFilter);
        }

        if ($angkatanFilter) {
            $query->where('angkatan', $angkatanFilter);
        }

        // Fetch the required data including only No Urut and Nama columns
        // Order by 'no_urut'
        $dataKelas = $query->with('siswa:id,nama')
            ->orderBy('no_urut')
            ->get(['no_urut', 'id_siswa', 'kelas']);
        // Generate HTML for the PDF
        $html = View::make('template.dataKelas', compact('dataKelas'))->render();

        // Instantiate Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);

        // Load HTML content
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Stream the PDF
        return $dompdf->stream('data_kelas.pdf');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $mutasiFilter = $request->query('angkatan', ''); // Default empty filter

        // Fetch distinct angkatan values from Siswa model
        $angkatan = Siswa::distinct()->pluck('angkatan');

        // Get the selected angkatan from the request or default to an empty string
        $defaultAngkatan = $request->angkatan;

        // Fetch names for the selected angkatan if available
        $names = $defaultAngkatan ? Siswa::where('angkatan', $defaultAngkatan)->get(['id', 'nama', 'angkatan']) : collect();

        return view('database.kelas.add', compact('angkatan', 'names'));
    }

    public function edit($id)
    {
        $kelas = DataKelas::findOrFail($id);
        $angkatan = Siswa::distinct()->pluck('angkatan');
        $names = Siswa::where('angkatan', $kelas->angkatan)->get(['id', 'nama', 'angkatan']);
        $dataKelas = DataKelas::with('siswa')->where('id', $id)->first(); // Also for a single record
        return view('database.kelas.edit', compact('kelas', 'angkatan', 'names', 'dataKelas'));
    }




    public function getSiswaByAngkatan(Request $request)
    {
        $angkatan = $request->query('angkatan');

        if ($angkatan) {
            $siswa = Siswa::where('angkatan', $angkatan)->get(['id', 'nama']);
        } else {
            $siswa = collect();
        }

        return response()->json($siswa);
    }

    public function getSiswaLulusByAngkatan(Request $request)
    {
        $angkatan = $request->query('angkatan');

        if ($angkatan) {
            $siswaLulus = DataKelas::where('angkatan', $angkatan)
                ->where('kelas', 'Lulus')
                ->with('siswa:id,nama')
                ->get()
                ->pluck('siswa');
        } else {
            $siswaLulus = collect();
            // dd($siswaLulus);
        }

        return response()->json($siswaLulus);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $validatedData = $request->validate([
            'id_siswa' => 'required|unique:data_kelas,id_siswa',
            'tahun_pelajaran' => 'required|string|max:20',
            'no_urut' => 'required|integer',
            'kelas' => 'nullable|in:X,XI,XII,XIII',
            'jurusan' => 'required|string|max:50',
            'angkatan' => 'required'
        ], [
            'id_siswa.unique' => 'Nama ini sudah digunakan pada kelas lain'
        ]);

        DataKelas::create($validatedData);

        return redirect()->route('kelas.index')->with('success', 'Data berhasil di tambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(DataKelas $dataKelas)
    {
        return response()->json($dataKelas);
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_siswa' => 'required',
            'angkatan' => 'required',
            'tahun_pelajaran' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
            'no_urut' => 'required|integer',
        ]);

        $kelas = DataKelas::findOrFail($id);
        $kelas->update($request->all());

        return redirect()->route('kelas.index')->with('success', 'Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kelas = DataKelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Data berhasil di hapus');
    }
}
