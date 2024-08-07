<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tendik;
use App\Models\IjazahTendik;
use Illuminate\Http\Request;
use App\Models\SertifikatTendik;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;
use Dompdf\Options;

class TendikController extends Controller
{

    public function index()
    {
        $tendik = Tendik::all();
        return view('database.tendik.index', compact('tendik'));
    }

    public function create()
    {
        return view('database.tendik.add');
    }

    public function fileSetup($file, $nama, $prefix, $namaDir, $path = '')
    {
        $imageFileName = $prefix . str_replace(' ', '_', $nama) . '.' . $file->getClientOriginalExtension();
        $fullPath = 'img/tendik/' . $namaDir . $path . '/';

        // Pastikan direktori tujuan ada
        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0777, true);
        }

        // Pindahkan file ke direktori tujuan
        $file->move(public_path($fullPath), $imageFileName);

        return $fullPath . $imageFileName;
    }

    public function makeDir($folder, $nama)
    {
        $baseDir = public_path('img/' . $folder . '/'  . $nama);

        if (!file_exists($baseDir)) {
            mkdir($baseDir, 0777, true);
        }

        $ijazahDir = $baseDir . '/ijazah';
        if (!file_exists($ijazahDir)) {
            mkdir($ijazahDir, 0777, true);
        }

        $sertifikatDir = $baseDir . '/sertifikat';
        if (!file_exists($sertifikatDir)) {
            mkdir($sertifikatDir, 0777, true);
        }
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'no_nik' => 'required|integer',
            'no_gtk' => 'required|integer',
            'no_nuptk' => 'required|integer',
            'tempat_tanggal_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|max:10',
            'agama' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'status_kepegawaian' => 'required|string|max:50',
            'no_rekening' => 'required',
            'posisi' => 'required|string|max:255',
            'email' => 'required|email|max:255|',
            'pendidikan_terakhir' => 'required|string|max:50',
            'tanggal_masuk' => 'required|date',
            'foto' => 'required|file|mimes:png',
            'foto_ktp' => 'required|file|mimes:png',
            'foto_surat_keterangan_mengajar' => 'required|file|mimes:png',
            'no_hp' => 'nullable|string|max:20',
        ]);


        $nama = $request->nama;
        $namaDir = str_replace(' ', '_', $nama);
        $this->makeDir('tendik', $namaDir);

        $imageNamaFoto = null;
        $imageNamaFotoKtp = null;
        $imageNamaFotoSk = null;
        $tendik = Tendik::findOrFail($id);

        if ($request->hasFile('foto')) $imageNamaFoto = $this->fileSetup($request->file('foto'), $nama, 'Foto-', $namaDir);

        if ($request->hasFile('foto_ktp')) $imageNamaFotoKtp = $this->fileSetup($request->file('foto_ktp'), $nama, 'Foto-KTP-', $namaDir);

        if ($request->hasFile('foto_surat_keterangan_mengajar')) $imageNamaFotoSk = $this->fileSetup($request->file('foto_surat_keterangan_mengajar'), $nama, 'Foto-SK-Mengajar-', $namaDir);

        $folderPath = public_path('img/tendik/' . $tendik->nama);
        if (File::exists($folderPath)) {
            File::deleteDirectory($folderPath);
        }

        $tendik->update(array_merge(
            $validatedData,
            [
                'tanggal_keluar' => $request->tanggal_keluar, // Update nullable field
                'foto' => $imageNamaFoto,
                'foto_ktp' => $imageNamaFotoKtp,
                'foto_surat_keterangan_mengajar' => $imageNamaFotoSk,
            ]
        ));

        $idTendik = $tendik->id;
        $ijazahData = [];
        $ijazahTypes = [
            'ijazah_smp' => 'SMP',
            'ijazah_sma' => 'SMA',
            'ijazah_s1' => 'S1',
            'ijazah_s2' => 'S2'
        ];

        foreach ($ijazahTypes as $fileKey => $jenisIjazah) {
            if ($request->hasFile($fileKey)) {
                $imageNamaFile = $this->fileSetup($request->file($fileKey), $request->nama, "Foto-Ijazah-{$jenisIjazah}-", $namaDir, '/ijazah');
                $ijazahData[] = [
                    'id_tendik' => $idTendik,
                    'jenis_ijazah' => $jenisIjazah,
                    'nama_file' => $imageNamaFile
                ];
            }
        }

        if (!empty($ijazahData)) IjazahTendik::insert($ijazahData);

        // Update SertifikatGuru records
        $sertifikatData = [];

        //Delete data sertifikat of id_tendik
        SertifikatTendik::where('id_tendik', $id)->delete();

        if ($request->hasFile('foto_sertifikat')) {
            $files = $request->file('foto_sertifikat');
            $sertifikatDir = 'img/tendik/' . $namaDir . '/sertifikat';

            foreach ($files as $index => $file) {
                $imageNamaSertifikat = $this->fileSetup($file, $nama, 'Sertifikat-' . ($index + 1) . '-', $namaDir, '/sertifikat');
                $sertifikatData[] = ['id_tendik' => $id, 'nama_file' => $imageNamaSertifikat];
            }
        }

        if (!empty($sertifikatData)) {
            SertifikatTendik::insert($sertifikatData);
        }

        return redirect()->route('tendik.index')->with('success', 'Data tendik berhasil di update.');
    }


    public function exportPdf($id)
    {
        $tendik = Tendik::findOrFail($id);

        $html = View::make('template.tendik_cv', compact('tendik'))->render();

        // Instantiate Dompdf

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('debugCss', false);
        $options->set('debugLayout', false);
        $options->set('debugLayoutLines', false);
        $options->set('debugLayoutBlocks', false);
        $options->set('debugLayoutInline', false);
        $options->set('debugLayoutPaddingBox', false);

        $dompdf = new Dompdf($options);

        // Load HTML content
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (important step!)
        $dompdf->render();

        return $dompdf->stream( $tendik->nama .'.pdf');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'no_nik' => 'required|integer|unique:tendik,no_nik',
            'no_gtk' => 'required|integer|unique:tendik,no_gtk',
            'no_nuptk' => 'required|integer|unique:tendik,no_nuptk',
            'tempat_tanggal_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|max:10',
            'agama' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'status_kepegawaian' => 'required|string|max:50',
            'no_rekening' => 'required',
            'posisi' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tendik,email',
            'pendidikan_terakhir' => 'required|string|max:50',
            'tanggal_masuk' => 'required|date',
            'foto' => 'required|file|mimes:png',
            'foto_ktp' => 'required|file|mimes:png',
            'foto_surat_keterangan_mengajar' => 'required|file|mimes:png',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $nama = $request->nama;
        $namaDir = str_replace(' ', '_', $nama);
        $this->makeDir('tendik', $namaDir);

        $imageNamaFoto = null;
        $imageNamaFotoKtp = null;
        $imageNamaFotoSk = null;

        if ($request->hasFile('foto')) $imageNamaFoto = $this->fileSetup($request->file('foto'), $nama, 'Foto-', $namaDir);

        if ($request->hasFile('foto_ktp')) $imageNamaFotoKtp = $this->fileSetup($request->file('foto_ktp'), $nama, 'Foto-KTP-', $namaDir);

        if ($request->hasFile('foto_surat_keterangan_mengajar')) $imageNamaFotoSk = $this->fileSetup($request->file('foto_surat_keterangan_mengajar'), $nama, 'Foto-SK-Mengajar-', $namaDir);

        $tendik = Tendik::create(array_merge(
            $validatedData, // Include validated data
            [
                'foto' => $imageNamaFoto,
                'foto_ktp' => $imageNamaFotoKtp,
                'foto_surat_keterangan_mengajar' => $imageNamaFotoSk,
            ]
        ));

        // Menangani upload dan penyimpanan ijazah
        $idTendik = $tendik->id;
        $ijazahData = [];
        $ijazahTypes = [
            'ijazah_smp' => 'SMP',
            'ijazah_sma' => 'SMA',
            'ijazah_s1' => 'S1',
            'ijazah_s2' => 'S2'
        ];

        foreach ($ijazahTypes as $fileKey => $jenisIjazah) {
            if ($request->hasFile($fileKey)) {
                $imageNamaFile = $this->fileSetup($request->file($fileKey), $request->nama, "Foto-Ijazah-{$jenisIjazah}-", $namaDir, '/ijazah');
                $ijazahData[] = [
                    'id_tendik' => $idTendik,
                    'jenis_ijazah' => $jenisIjazah,
                    'nama_file' => $imageNamaFile
                ];
            }
        }

        if (!empty($ijazahData)) IjazahTendik::insert($ijazahData);

        $sertifikatData = [];

        if ($request->hasFile('foto_sertifikat')) {
            $files = $request->file('foto_sertifikat');
            $sertifikatDir = 'img/tendik/' . $namaDir . '/sertifikat';

            foreach ($files as $index => $file) {
                $imageNamaSertifikat = $this->fileSetup($file, $nama, 'Sertifikat-' . ($index + 1) . '-', $namaDir, '/sertifikat');
                $sertifikatData[] = ['id_tendik' => $idTendik, 'nama_file' => $imageNamaSertifikat];
            }
        }

        if (!empty($sertifikatData)) {
            SertifikatTendik::insert($sertifikatData);
        }

        return redirect()->route('tendik.index')->with('success', 'Data tendik berhasil di tambahkan.');
    }




    public function edit($id)
    {
        $tendik = Tendik::with('ijazah', 'sertifikat')->findOrFail($id);

        // Pastikan bahwa atribut tanggal adalah instance dari Carbon
        if (!$tendik->tanggal_lahir instanceof Carbon) {
            $tendik->tanggal_lahir = new Carbon($tendik->tanggal_lahir);
        }
        if (!$tendik->tanggal_masuk instanceof Carbon) {
            $tendik->tanggal_masuk = new Carbon($tendik->tanggal_masuk);
        }
        if (!$tendik->tanggal_keluar instanceof Carbon) {
            $tendik->tanggal_keluar = new Carbon($tendik->tanggal_keluar);
        }

        $namatendik = strtolower(str_replace(' ', '_', $tendik->nama)); // Ubah sesuai format yang diinginkan
        $folderPath = "public/img/{$namatendik}/sertifikat/";

        // Periksa apakah folder ada dan ambil semua file
        $ijazahFiles = [];
        if (Storage::exists($folderPath)) {
            $ijazahFiles = Storage::files($folderPath);
        } else {

        }

        return view('database.tendik.edit', compact('tendik', 'ijazahFiles'));
    }

    public function destroy($id)
    {
        $data = Tendik::findOrFail($id);
        $namaDir = str_replace(' ', '_', $data->nama);

        // Path direktori
        $baseDir = public_path('img/tendik/' . $namaDir);

        // Hapus direktori dan semua isinya
        if (File::exists($baseDir)) {
            File::deleteDirectory($baseDir);
        }

        // Hapus data dari database
        $data->delete();

        return redirect()->route('tendik.index')->with('success', 'Data berhasil dihapus');
    }
}
