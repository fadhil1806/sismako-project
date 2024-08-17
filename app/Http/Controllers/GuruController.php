<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuruRequest;
use App\Models\Guru;
use App\Models\IjazahGuru;
use Illuminate\Http\Request;
use App\Models\SertifikatGuru;
use Illuminate\Support\Facades\File;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use ZipArchive;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    //
    public function index()
    {
        $guru = Guru::all();
        return view('database.guru.index', compact('guru'));
    }

    public function create()
    {
        return view('database.guru.add');
    }

    public function fileSetup($file, $nama, $prefix, $dir, $guruh = '')
    {
        $imageFileName = $prefix . str_replace(' ', '_', $nama) . '.' . $file->getClientOriginalExtension();
        $fullPath = 'img/guru/' . $dir . $guruh . '/';

        // Create the directory if it doesn't exist
        if (!is_dir($fullPath)) mkdir($fullPath, 0777, true);

        $file->move(public_path($fullPath), $imageFileName);
        return $fullPath . $imageFileName;
    }

    public function createDirectoryIfNotExists($directory)
    {
        if (!file_exists($directory)) mkdir($directory, 0777, true);
    }

    public function store(GuruRequest $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validated();
        $nama = str_replace(' ', '_', $request->nama);
        $baseDir = "img/guru/{$nama}";

        // Ensure base and subdirectories exist
        $this->createDirectoryIfNotExists(public_path($baseDir));
        $this->createDirectoryIfNotExists(public_path("{$baseDir}/ijazah"));
        $this->createDirectoryIfNotExists(public_path("{$baseDir}/sertifikat"));

        // Upload the main images
        $imageNamaFoto = $request->hasFile('foto') ? $this->fileSetup($request->file('foto'), $request->nama, 'Foto-', $nama) : null;
        $imageNamaFotoKtp = $request->hasFile('foto_ktp') ? $this->fileSetup($request->file('foto_ktp'), $request->nama, 'Foto-KTP-', $nama) : null;
        $imageNamaFotoSk = $request->hasFile('foto_surat_keterangan_mengajar') ? $this->fileSetup($request->file('foto_surat_keterangan_mengajar'), $request->nama, 'Foto-SK-Mengajar-', $nama) : null;

        // Create Guru record
        $guru = Guru::create(array_merge($validatedData, [
            'foto' => $imageNamaFoto,
            'foto_ktp' => $imageNamaFotoKtp,
            'foto_surat_keterangan_mengajar' => $imageNamaFotoSk,
        ]));

        // Prepare Ijazah data
        $ijazahData = [];
        $ijazahTypes = ['ijazah_smp' => 'SMP', 'ijazah_sma' => 'SMA', 'ijazah_s1' => 'S1', 'ijazah_s2' => 'S2'];

        foreach ($ijazahTypes as $fileKey => $jenisIjazah) {
            if ($request->hasFile($fileKey)) {
                $imageNamaFile = $this->fileSetup($request->file($fileKey), $request->nama, "Foto-Ijazah-{$jenisIjazah}-", $nama, '/ijazah');
                $ijazahData[] = ['id_guru' => $guru->id, 'jenis_ijazah' => $jenisIjazah, 'nama_file' => $imageNamaFile];
            }
        }
        if ($ijazahData) IjazahGuru::insert($ijazahData);

        // Prepare Sertifikat data
        $sertifikatData = [];
        if ($request->hasFile('foto_sertifikat')) {
            foreach ($request->file('foto_sertifikat') as $index => $file) {
                $imageNamaSertifikat = $this->fileSetup($file, $request->nama, 'Sertifikat-' . ($index + 1) . '-', $nama, '/sertifikat');
                $sertifikatData[] = ['id_guru' => $guru->id, 'nama_file' => $imageNamaSertifikat];
            }
        }
        if ($sertifikatData) SertifikatGuru::insert($sertifikatData);

        // Redirect with success message
        return redirect()->route('guru.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $data = Guru::findOrFail($id);
        $namaDir = str_replace(' ', '_', $data->nama);

        // Path direktori
        $baseDir = public_path('img/guru/' . $namaDir);

        // Hapus direktori dan semua isinya
        if (File::exists($baseDir)) File::deleteDirectory($baseDir);

        // Hapus data dari database
        $data->delete();

        return redirect()->route('guru.index')->with('success', 'Data berhasil dihapus');
    }
    public function edit($id)
    {
        $guru = Guru::with('ijazah', 'sertifikat')->findOrFail($id);
        return view('database.guru.edit', compact('guru'));
    }

    public function update(GuruRequest $request, $id)
    {
        $validatedData = $request->validated();

        $guru = Guru::findOrFail($id);

        // Menghapus folder lama jika ada
        $oldDirname = str_replace(' ', '_', $guru->nama);
        $baseDirOld = public_path('img/guru/' . $oldDirname);
        if (File::exists($baseDirOld)) {
            File::deleteDirectory($baseDirOld);
        }

        // Prepare new directory
        $nama = $request->nama;
        $namaDir = str_replace(' ', '_', $nama);
        $baseDir = public_path("img/guru/{$namaDir}");
        $this->createDirectoryIfNotExists($baseDir);
        $this->createDirectoryIfNotExists("{$baseDir}/ijazah");
        $this->createDirectoryIfNotExists("{$baseDir}/sertifikat");

        // Handle file uploads
        $imageNamaFoto = $request->hasFile('foto') ? $this->fileSetup($request->file('foto'), $nama, 'Foto-', $namaDir) : null;
        $imageNamaFotoKtp = $request->hasFile('foto_ktp') ? $this->fileSetup($request->file('foto_ktp'), $nama, 'Foto-KTP-', $namaDir) : null;
        $imageNamaFotoSk = $request->hasFile('foto_surat_keterangan_mengajar') ? $this->fileSetup($request->file('foto_surat_keterangan_mengajar'), $nama, 'Foto-SK-Mengajar-', $namaDir) : null;

        $guru = Guru::findOrFail($id);
        // Update the Guru record with validated data
        $guru->update(array_merge(
            $validatedData,
            [
                'tanggal_keluar' => $request->tanggal_keluar,
                'foto' => $imageNamaFoto,
                'foto_ktp' => $imageNamaFotoKtp,
                'foto_surat_keterangan_mengajar' => $imageNamaFotoSk,
            ]
        ));

        $idGuru = $id;

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
                    'id_guru' => $id,
                    'jenis_ijazah' => $jenisIjazah,
                    'nama_file' => $imageNamaFile
                ];
            }
        }

        //Delete data ijazah
        IjazahGuru::where('id_guru', $id)->delete();

        //Create new data ijazah
        if (!empty($ijazahData)) IjazahGuru::insert($ijazahData);

        $sertifikatData = [];

        //Delete data Sertifikat
        SertifikatGuru::where('id_guru', $id)->delete();

        if ($request->hasFile('foto_sertifikat')) {
            $files = $request->file('foto_sertifikat');
            $sertifikatDir = 'img/guru/' . $namaDir . '/sertifikat';

            foreach ($files as $index => $file) {
                $imageNamaSertifikat = $this->fileSetup($file, $nama, 'Sertifikat-' . ($index + 1) . '-', $namaDir, '/sertifikat');
                $sertifikatData[] = ['id_guru' => $idGuru, 'nama_file' => $imageNamaSertifikat];
            }
        }

        if (!empty($sertifikatData)) SertifikatGuru::insert($sertifikatData);


        return redirect()->route('guru.index')->with('success', 'Data berhasil di update');
    }


    public function exportPdf($id)
    {
        $guru = Guru::findOrFail($id);
        $html = View::make('template.guru_cv', compact('guru'))->render();

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream($guru->nama . '.pdf');
    }

    public function download($id, Request $request)
    {
        $guru = Guru::findOrFail($id);
        $fileType = $request->query('type');
        $filePath = '';

        switch ($fileType) {
            case 'foto':
                $filePath = public_path($guru->foto);
                break;
            case 'ktp':
                $filePath = public_path($guru->foto_ktp);
                break;
            case 'ijazah':
                $filePath = public_path($request->path);
                break;
            case 'sertifikat':
                return $this->downloadSertifikat($guru);
            case 'foto_surat_keterangan_mengajar':
                $filePath = public_path($guru->foto_surat_keterangan_mengajar);
                break;
            default:
                return redirect()->back()->with('error', 'Tipe file tidak valid.');
        }

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return response()->download($filePath);
    }

    protected function downloadSertifikat($guru)
    {
        $zipFileName = 'sertifikat_' . str_replace(' ', '_', $guru->nama) . '.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            foreach ($guru->sertifikat as $sertifikat) {
                $filePath = public_path($sertifikat['nama_file']);
                if (file_exists($filePath)) {
                    $zip->addFile($filePath, basename($filePath));
                }
            }
            $zip->close();
        } else {
            return redirect()->back()->with('error', 'Tidak dapat membuat file ZIP.');
        }

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function downloadFile($id)
    {
        $guru = Guru::with('ijazah', 'sertifikat')->findOrFail($id);

        $directories = [
            'ijazah' => $guru->ijazah,
            'sertifikat' => $guru->sertifikat
        ];

        $photos = [
            'foto' => $guru->foto,
            'foto_ktp' => $guru->foto_ktp,
            'foto_surat_keterangan_mengajar' => $guru->foto_surat_keterangan_mengajar
        ];

        $zipFileName = 'guru_files_' . $guru->id . '.zip';
        $zipFilePath = storage_path('app/temp/' . $zipFileName);

        if (!Storage::disk('local')->exists('temp')) {
            Storage::disk('local')->makeDirectory('temp');
        }

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($directories as $dir => $files) {
                foreach ($files as $file) {
                    $filePath = public_path('storage/' . $file->nama_file);
                    if (is_file($filePath)) {
                        $zip->addFile($filePath, $dir . '/' . basename($filePath));
                    }
                }
            }

            foreach ($photos as $photoKey => $photoPath) {
                $filePath = public_path('storage/' . $photoPath);
                if (is_file($filePath)) {
                    $zip->addFile($filePath, 'photos/' . basename($filePath));
                }
            }

            $zip->close();
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return back()->with('error', 'Failed to create zip file');
        }
    }
}
