<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\IjazahGuru;
use Illuminate\Http\Request;
use App\Models\SertifikatGuru;
use Illuminate\Support\Facades\File;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Illuminate\Support\Facades\Storage;

use ZipStream\ZipStream;
use ZipStream\Option\Archive;


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

        // Pastikan direktori tujuan ada
        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0777, true);
        }

        // Pindahkan file ke direktori tujuan
        $file->move(public_path($fullPath), $imageFileName);

        return $fullPath . $imageFileName;
    }
    public function createDirectoryIfNotExists($directory)
    {
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'no_nik' => 'required',
            'no_gtk' => 'required',
            'no_nuptk' => 'required',
            'tempat_tanggal_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'nama_lulusan_pt' => 'required',
            'nama_jurusan_pt' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'mapel' => 'required',
            'gelar' => 'required',
            'email' => 'required',
            'no_rekening' => 'required',
            'status_kepegawaian' => 'required',
            'tanggal_masuk' => 'required',
            'foto' => 'required',
            'foto_ktp' => 'required',
            'foto_surat_keterangan_mengajar' => 'required',
            'ijazah_smp' => 'required',
            'ijazah_sma' => 'required'
        ], [
            'nama.required' => 'Nama wajib diisi',
            'no_nik.required' => 'Nomor NIK wajib diisi',
            'no_gtk.required' => 'Nomor GTK wajib diisi',
            'no_nuptk.required' => 'Nomor NUPTK wajib diisi',
            'tempat_tanggal_lahir.required' => 'Tempat dan tanggal lahir wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
            'agama.required' => 'Agama wajib diisi',
            'nama_lulusan_pt.required' => 'Nama lulusan PT wajib diisi',
            'nama_jurusan_pt.required' => 'Nama jurusan PT wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'mapel.required' => 'Mapel wajib diisi',
            'gelar.required' => 'Gelar wajib diisi',
            'email.required' => 'Email wajib diisi',
            'no_rekening.required' => 'Nomor rekening wajib diisi',
            'status_kepegawaian.required' => 'Status kepegawaian wajib diisi',
            'tanggal_masuk.required' => 'Tanggal masuk wajib diisi',
            'foto.required' => 'Foto wajib diisi',
            'foto_ktp.required' => 'Foto KTP wajib diisi',
            'foto_surat_keterangan_mengajar.required' => 'Foto surat keterangan mengajar wajib diisi',
            'ijazah_smp.required' => 'Foto Ijazah SMP wajib diisi',
            'ijazah_sma.required' => 'Foto Ijazah SMA wajib diisi',
        ]);

        $nama = $request->nama;
        $namaDir = str_replace(' ', '_', $nama);
        $baseDir = public_path("img/guru/{$namaDir}");
        // Create base directory
        $this->createDirectoryIfNotExists($baseDir);

        // Create subdirectories
        $this->createDirectoryIfNotExists("{$baseDir}/ijazah");
        $this->createDirectoryIfNotExists("{$baseDir}/sertifikat");

        $imageNamaFoto = null;
        $imageNamaFotoKtp = null;
        $imageNamaFotoSk = null;

        if ($request->hasFile('foto')) $imageNamaFoto = $this->fileSetup($request->file('foto'), $nama, 'Foto-', $namaDir);

        if ($request->hasFile('foto_ktp')) $imageNamaFotoKtp = $this->fileSetup($request->file('foto_ktp'), $nama, 'Foto-KTP-', $namaDir);

        if ($request->hasFile('foto_surat_keterangan_mengajar')) $imageNamaFotoSk = $this->fileSetup($request->file('foto_surat_keterangan_mengajar'), $nama, 'Foto-SK-Mengajar-', $namaDir);

        // Create Guru record with validated and uploaded files
        $guru = Guru::create(array_merge(
            $validatedData, // Include validated data
            [
                'foto' => $imageNamaFoto,
                'foto_ktp' => $imageNamaFotoKtp,
                'foto_surat_keterangan_mengajar' => $imageNamaFotoSk,
            ]
        ));

        $idGuru = $guru->id;

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
                    'id_guru' => $idGuru,
                    'jenis_ijazah' => $jenisIjazah,
                    'nama_file' => $imageNamaFile
                ];
            }
        }

        if (!empty($ijazahData)) IjazahGuru::insert($ijazahData);

        $sertifikatData = [];

        if ($request->hasFile('foto_sertifikat')) {
            $files = $request->file('foto_sertifikat');
            $sertifikatDir = 'img/guru/' . $namaDir . '/sertifikat';

            foreach ($files as $index => $file) {
                $imageNamaSertifikat = $this->fileSetup($file, $nama, 'Sertifikat-' . ($index + 1) . '-', $namaDir, '/sertifikat');
                $sertifikatData[] = ['id_guru' => $idGuru, 'nama_file' => $imageNamaSertifikat];
            }
        }

        if (!empty($sertifikatData)) SertifikatGuru::insert($sertifikatData);

        return redirect()->route('guru.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $data = Guru::findOrFail($id);
        $namaDir = str_replace(' ', '_', $data->nama);

        // Path direktori
        $baseDir = public_path('img/guru/' . $namaDir);

        // Hapus direktori dan semua isinya
        if (File::exists($baseDir)) {
            File::deleteDirectory($baseDir);
        }

        // Hapus data dari database
        $data->delete();

        return redirect()->route('guru.index')->with('success', 'Data berhasil dihapus');
    }
    public function edit($id)
    {
        $guru = Guru::with('ijazah', 'sertifikat')->findOrFail($id);
        return view('database.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'no_nik' => 'required',
            'no_gtk' => 'required',
            'no_nuptk' => 'required',
            'tempat_tanggal_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'nama_lulusan_pt' => 'required',
            'nama_jurusan_pt' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'mapel' => 'required',
            'gelar' => 'required',
            'email' => 'required',
            'no_rekening' => 'required',
            'status_kepegawaian' => 'required',
            'tanggal_masuk' => 'required',
            'foto' => 'required',
            'foto_ktp' => 'required',
            'foto_surat_keterangan_mengajar' => 'required',
            'ijazah_smp' => 'required',
            'ijazah_sma' => 'required'
        ], [
            'nama.required' => 'Nama wajib diisi',
            'no_nik.required' => 'Nomor NIK wajib diisi',
            'no_gtk.required' => 'Nomor GTK wajib diisi',
            'no_nuptk.required' => 'Nomor NUPTK wajib diisi',
            'tempat_tanggal_lahir.required' => 'Tempat dan tanggal lahir wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
            'agama.required' => 'Agama wajib diisi',
            'nama_lulusan_pt.required' => 'Nama lulusan PT wajib diisi',
            'nama_jurusan_pt.required' => 'Nama jurusan PT wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'mapel.required' => 'Mapel wajib diisi',
            'gelar.required' => 'Gelar wajib diisi',
            'email.required' => 'Email wajib diisi',
            'no_rekening.required' => 'Nomor rekening wajib diisi',
            'status_kepegawaian.required' => 'Status kepegawaian wajib diisi',
            'tanggal_masuk.required' => 'Tanggal masuk wajib diisi',
            'foto.required' => 'Foto wajib diisi',
            'foto_ktp.required' => 'Foto KTP wajib diisi',
            'foto_surat_keterangan_mengajar.required' => 'Foto surat keterangan mengajar wajib diisi',
            'ijazah_smp.required' => 'Foto Ijazah SMP wajib diisi',
            'ijazah_sma.required' => 'Foto Ijazah SMA wajib diisi',
        ]);

        $guru = Guru::findOrFail($id);

        // Menghapus folder lama jika ada
        $oldDirname = str_replace(' ', '_', $guru->nama);
        $baseDirOld = public_path('img/guru/' . $oldDirname);
        if (File::exists($baseDirOld)) {
            File::deleteDirectory($baseDirOld);
        }

        $nama = $request->nama;
        $namaDir = str_replace(' ', '_', $nama);
        $baseDir = public_path("img/guru/{$namaDir}");
        // Create base directory
        $this->createDirectoryIfNotExists($baseDir);

        // Create subdirectories
        $this->createDirectoryIfNotExists("{$baseDir}/ijazah");
        $this->createDirectoryIfNotExists("{$baseDir}/sertifikat");

        $imageNamaFoto = null;
        $imageNamaFotoKtp = null;
        $imageNamaFotoSk = null;

        if ($request->hasFile('foto')) $imageNamaFoto = $this->fileSetup($request->file('foto'), $nama, 'Foto-', $namaDir);

        if ($request->hasFile('foto_ktp')) $imageNamaFotoKtp = $this->fileSetup($request->file('foto_ktp'), $nama, 'Foto-KTP-', $namaDir);

        if ($request->hasFile('foto_surat_keterangan_mengajar')) $imageNamaFotoSk = $this->fileSetup($request->file('foto_surat_keterangan_mengajar'), $nama, 'Foto-SK-Mengajar-', $namaDir);

        $guru = Guru::findOrFail($id);
        // Update the Guru record with validated data
        $guru->update(array_merge(
            $validatedData, // Include validated data
            [
                'tanggal_keluar' => $request->tanggal_keluar, // Update nullable field
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
        if (!empty($ijazahData)) {
            IjazahGuru::insert($ijazahData);
        }

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

        if (!empty($sertifikatData)) {
            SertifikatGuru::insert($sertifikatData);
        }


        return redirect()->route('guru.index')->with('success', 'Data berhasil di update');
    }

    public function exportPdf($id)
    {
        $guru = Guru::findOrFail($id);

        $html = View::make('template.guru_cv', compact('guru'))->render();

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

        return $dompdf->stream($guru->nama . '.pdf');
    }

    public function export($id)
    {
        $guru = Guru::findOrFail($id);
        return view('database.guru.export', compact('guru'));
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
                // Membuat file ZIP sementara
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

    public function downloadFile($id)
    {
        $guru = Guru::with('ijazah', 'sertifikat')->findOrFail($id);

        $directories = [
            'ijazah' => $guru->ijazah,
            'sertifikat' => $guru->sertifikat
        ];

        // Paths for photos
        $photos = [
            'foto' => $guru->foto,
            'foto_ktp' => $guru->foto_ktp,
            'foto_surat_keterangan_mengajar' => $guru->foto_surat_keterangan_mengajar
        ];

        // Create a temporary file to store the zip
        $zipFileName = 'guru_files_' . $guru->id . '.zip';
        $zipFilePath = storage_path('app/temp/' . $zipFileName);

        // Ensure the temp directory exists
        if (!Storage::disk('local')->exists('temp')) {
            Storage::disk('local')->makeDirectory('temp');
        }

        // Initialize zip archive
        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            // Add ijazah and sertifikat files
            foreach ($directories as $dir => $files) {
                foreach ($files as $file) {
                    $filePath = public_path('storage/' . $file->nama_file);
                    if (is_file($filePath)) {
                        $zip->addFile($filePath, $dir . '/' . basename($filePath));
                    }
                }
            }

            // Add photos
            foreach ($photos as $photoKey => $photoPath) {
                $filePath = public_path('storage/' . $photoPath);
                if (is_file($filePath)) {
                    $zip->addFile($filePath, 'photos/' . basename($filePath));
                }
            }

            $zip->close();

            // Download the created zip file
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return back()->with('error', 'Failed to create zip file');
        }
    }
}
