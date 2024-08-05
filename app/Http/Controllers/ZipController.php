<?php
namespace App\Http\Controllers;

use App\Models\PklAdministrasiSekolah;
use App\Models\PklAdministrasiSiswa;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use ZipArchive;

class ZipController extends Controller
{
    public function zipFileGuru($nama) {
        $zip = new ZipArchive;
        $fileName = $nama . '.zip';
        $folderPath = public_path('img/guru/' . str_replace(' ', '_', $nama));

        // Cek apakah folder ada
        if (!file_exists($folderPath) || !is_dir($folderPath)) {
            return response()->json(['error' => 'Folder tidak ditemukan'], 404);
        }

        if ($zip->open($fileName, ZipArchive::CREATE)) {
            $this->addFolderToZip($folderPath, $zip, strlen(public_path()) + 1);
            $zip->close();
        }

        $response = response()->download($fileName);

        // Hapus file setelah selesai diunduh
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function zipFileTendik($nama) {
        $zip = new ZipArchive;
        $fileName = $nama . '.zip';
        $folderPath = public_path('img/tendik/' . str_replace(' ', '_', $nama));

        // Cek apakah folder ada
        if (!file_exists($folderPath) || !is_dir($folderPath)) {
            return response()->json(['error' => 'Folder tidak ditemukan'], 404);
        }

        if ($zip->open($fileName, ZipArchive::CREATE)) {
            $this->addFolderToZip($folderPath, $zip, strlen(public_path()) + 1);
            $zip->close();
        }

        $response = response()->download($fileName);

        // Hapus file setelah selesai diunduh
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function zipFileSiswa($nama) {
        $zip = new ZipArchive;
        $fileName = $nama . '.zip';
        $folderPath = public_path('img/siswa/' . str_replace(' ', '_', $nama));

        // Cek apakah folder ada
        if (!file_exists($folderPath) || !is_dir($folderPath)) {
            return response()->json(['error' => 'Folder tidak ditemukan'], 404);
        }

        if ($zip->open($fileName, ZipArchive::CREATE)) {
            $this->addFolderToZip($folderPath, $zip, strlen(public_path()) + 1);
            $zip->close();
        }

        $response = response()->download($fileName);

        // Hapus file setelah selesai diunduh
        $response->deleteFileAfterSend(true);

        return $response;
    }

    public function zipFilePklSekolah($id)
{
    $sekolah = PklAdministrasiSekolah::findOrFail($id);
    $zip = new ZipArchive;
    $fileName = 'sekolah_' . $id . '.zip';

    // Tentukan jalur file
    $fotoSiswaDanPerusahaanPath = public_path($sekolah->path_foto_siswa_dan_perusahaan);
    $fotoMovPath = public_path($sekolah->path_foto_mov);

    // Cek apakah file ada
    if ((!file_exists($fotoSiswaDanPerusahaanPath) || !is_file($fotoSiswaDanPerusahaanPath)) &&
        (!file_exists($fotoMovPath) || !is_file($fotoMovPath))) {
        return response()->json(['error' => 'Files not found'], 404);
    }

    if ($zip->open($fileName, ZipArchive::CREATE) === TRUE) {
        // Tambahkan file ke arsip ZIP
        if (file_exists($fotoSiswaDanPerusahaanPath) && is_file($fotoSiswaDanPerusahaanPath)) {
            $zip->addFile($fotoSiswaDanPerusahaanPath, basename($fotoSiswaDanPerusahaanPath));
        }
        if (file_exists($fotoMovPath) && is_file($fotoMovPath)) {
            $zip->addFile($fotoMovPath, basename($fotoMovPath));
        }
        $zip->close();
    } else {
        return response()->json(['error' => 'Could not create ZIP file'], 500);
    }

    $response = response()->download($fileName);

    // Hapus file ZIP setelah selesai diunduh
    $response->deleteFileAfterSend(true);

    return $response;
}

public function zipFilePklSiswa($id)
{
    // Ambil data siswa berdasarkan ID
    $siswa = PklAdministrasiSiswa::findOrFail($id);
    $zip = new ZipArchive;
    $fileName = 'siswa_' . $id . '.zip';

    // Tentukan jalur file
    $rekapKehadiranPath = public_path($siswa->path_rekap_kehadiran);
    $jurnalPklPath = public_path($siswa->path_jurnal_pkl);

    // Cek apakah file ada
    if ((!file_exists($rekapKehadiranPath) || !is_file($rekapKehadiranPath)) &&
        (!file_exists($jurnalPklPath) || !is_file($jurnalPklPath))) {
        return response()->json(['error' => 'Files not found'], 404);
    }

    // Buat file ZIP dan tambahkan file ke dalamnya
    if ($zip->open($fileName, ZipArchive::CREATE) === TRUE) {
        if (file_exists($rekapKehadiranPath) && is_file($rekapKehadiranPath)) {
            $zip->addFile($rekapKehadiranPath, basename($rekapKehadiranPath));
        }
        if (file_exists($jurnalPklPath) && is_file($jurnalPklPath)) {
            $zip->addFile($jurnalPklPath, basename($jurnalPklPath));
        }
        $zip->close();
    } else {
        return response()->json(['error' => 'Could not create ZIP file'], 500);
    }

    // Unduh file ZIP dan hapus setelah selesai diunduh
    $response = response()->download($fileName);
    $response->deleteFileAfterSend(true);

    return $response;
}



    private function addFolderToZip($folder, $zip, $exclusiveLength) {
        $handle = opendir($folder);
        while (false !== ($f = readdir($handle))) {
            if ($f != '.' && $f != '..') {
                $filePath = "$folder/$f";
                $localPath = substr($filePath, $exclusiveLength);
                if (is_file($filePath)) {
                    $zip->addFile($filePath, $localPath);
                } elseif (is_dir($filePath)) {
                    // Tambahkan direktori kosong ke zip jika diperlukan
                    $zip->addEmptyDir($localPath);
                    $this->addFolderToZip($filePath, $zip, $exclusiveLength);
                }
            }
        }
        closedir($handle);
    }




}
