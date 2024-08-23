<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZipController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\fiqihController;
use App\Http\Controllers\lombaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\akhlakController;
use App\Http\Controllers\tafsirController;
use App\Http\Controllers\tahsinController;
use App\Http\Controllers\tajwidController;
use App\Http\Controllers\TendikController;
use App\Http\Controllers\DatabaseDashboard;
use App\Http\Controllers\tahfidzController;
use App\Http\Controllers\eventualController;
use App\Http\Controllers\DataKelasController;
use App\Http\Controllers\pelatihanController;
use App\Http\Controllers\DataMutasiController;
use App\Http\Controllers\PunishmentController;
use App\Http\Controllers\sertifikatController;
use App\Http\Controllers\JamaahSiswaController;
use App\Http\Controllers\DataPrestasiController;
use App\Http\Controllers\ProgresSiswaController;
use App\Http\Controllers\DataKelulusanController;
use App\Http\Controllers\PatroliAsramaController;
use App\Http\Controllers\PklAdministrasiSiswaController;
use App\Http\Controllers\PklAdministrasiSekolahController;

Route::view('/', 'welcome');

Route::get('/dashboard', [DatabaseDashboard::class, 'index'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('pkl', 'database.pkl.pkl')->name('pkl');

Route::view('sekolah-keasramaan', 'page.home.keasramaan')
    ->name('keasramaan');

Route::get('/progres/siswa/{nisn}', [ProgresSiswaController::class, 'index']);


Route::controller(PklAdministrasiSekolahController::class)->group(function () {
    Route::get('pkl/adm-sekolah', 'index')->name('pkl.sekolah.index');
    Route::get('pkl/adm-sekolah/create', 'create')->name('pkl.sekolah.create');
    Route::post('pkl/adm-sklh/create/data', 'store')->name('pkl.sekolah.store');
    Route::get('pkl/adm-sekolah/edit/{id}', 'edit')->name('pkl.sekolah.edit');
    Route::post('pkl/adm-sekolah/update/{id}', 'update')->name('pkl.sekolah.update');
    Route::delete('pkl/adm-sekolah/delete/{id}', 'destroy')->name('pkl.sekolah.destroy');
});

Route::controller(PklAdministrasiSiswaController::class)->group(function () {
    Route::get('pkl/adm-siswa', 'index')->name('pkl.siswa.index');
    Route::get('pkl/adm-siswa/create', 'create')->name('pkl.siswa.create');
    Route::post('pkl/adm-siswa/create/data', 'store')->name('pkl.siswa.store');
    Route::get('pkl/adm-siswa/edit/{id}', 'edit')->name('pkl.siswa.edit');
    Route::post('pkl/adm-siswa/update/{id}', 'update')->name('pkl.siswa.update');
    Route::delete('pkl/adm-siswa/delete/{id}', 'destroy')->name('pkl.siswa.destroy');
});

Route::controller(GuruController::class)->group(function () {
    Route::get('/guru', 'index')->name('guru.index');
    Route::get('/guru/create', 'create')->name('guru.create');
    Route::get('/guru/edit/{id}', 'edit')->name('guru.edit');
    Route::post('/guru/update/{id}', 'update')->name('guru.update');
    Route::post('/guru/create/data', 'store')->name('guru.store');
    Route::delete('/guru/delete/{id}', 'destroy')->name('guru.destroy');
    Route::get('/guru/download/{id}', 'download')->name('guru.download');
    Route::get('/guru/{id}/export-pdf', 'exportPdf')->name('guru.exportPdf');
    Route::get('/guru/{id}/download', 'downloadFile')->name('guru.download.file');
});

Route::controller(TendikController::class)->group(function () {
    Route::get('/tendik', 'index')->name('tendik.index');
    Route::get('/tendik/create', 'create')->name('tendik.create');
    Route::get('/tendik/edit/{id}', 'edit')->name('tendik.edit');
    Route::post('/tendik/create/data', 'store')->name('tendik.store');
    Route::delete('/tendik/delete/{id}', 'destroy')->name('tendik.destroy');
    Route::put('/tendik/update/{id}', 'update')->name('tendik.update');
    Route::get('/tendik/{id}/export-pdf', 'exportPdf')->name('tendik.exportPdf');
});

Route::controller(DataPrestasiController::class)->group(function () {
    Route::get('/data-prestasi', 'index')->name('prestasi.index');
    Route::get('/data-prestasi/create', 'create')->name('prestasi.create');
    Route::post('/data-prestasi/create/data', 'store')->name('prestasi.store');
    Route::get('/data-prestasi/edit/{id}', 'edit')->name('prestasi.edit');
    Route::post('/data-prestasi/update/{id}', 'update')->name('prestasi.update');
    Route::delete('/data-prestasi/delete/{id}', 'destroy')->name('prestasi.destroy');
    Route::get('/data-prestasi/export-pdf', [DataPrestasiController::class, 'exportPdf'])->name('prestasi.exportPdf');
});

Route::controller(SiswaController::class)->group(function () {
    Route::get('/siswa', 'index')->name('siswa.index');
    Route::get('/siswa/create', 'create')->name('siswa.create');
    Route::post('/siswa/create/data', 'store')->name('siswa.store');
    Route::get('/siswa/edit/{id}', 'edit')->name('siswa.edit');
    Route::post('/siswa/update/{id}', 'update')->name('siswa.update');
    Route::delete('/siswa/delete/{id}', 'destroy')->name('siswa.destroy');
    Route::get('/siswa/{id}/export-pdf', 'exportPdf')->name('siswa.exportPdf');
});

Route::controller(DataMutasiController::class)->group(function () {
    Route::get('/data-mutasi', 'index')->name('mutasi.index');
    Route::get('/data-mutasi/create', 'create')->name('mutasi.create');
    Route::post('/data-mutasi/create/data', 'store')->name('mutasi.store');
    Route::get('/data-mutasi/edit/{id}', 'edit')->name('mutasi.edit');
    Route::put('/data-mutasi/update/{id}', 'update')->name('mutasi.update');
    Route::delete('/mutasi/{id}', 'destroy')->name('mutasi.destroy');
    Route::get('/mutasi/export', 'exportPdf')->name('mutasi.export');
});

Route::controller(DataKelulusanController::class)->group(function () {
    Route::get('/kelulusan', 'index')->name('kelulusan.index');
    Route::get('/kelulusan/create', 'create')->name('kelulusan.create');
    Route::post('/kelulusan/create/data', 'store')->name('kelulusan.store');
    Route::get('/kelulusan/edit/{id}', 'edit')->name('kelulusan.edit');
    Route::post('/kelulusan/update/{id}', 'update')->name('kelulusan.update');
    Route::delete('/kelulusan/delete/{id}', 'destroy')->name('kelulusan.destroy');
    Route::get('/kelulusan/export/{id}', 'exportPdfCv')->name('kelulusan.export.data');
    Route::get('/kelulusan/export-pdf', 'exportPdf')->name('kelulusan.export');
});

Route::controller(DataKelasController::class)->group(function () {
    Route::post('/kelas/create/data', 'store')->name('kelas.store');
    Route::get('/kelas/edit/{id}', 'edit')->name('kelas.edit');
    Route::put('/kelas/update/{id}', 'update')->name('kelas.update');
    Route::delete('/kelas/delete/{id}', 'destroy')->name('kelas.destroy');
    Route::get('/kelas/export/{id}', 'exportPdfCv')->name('kelas.export.data');
    Route::get('/kelas/export-pdf', 'exportPdf')->name('kelas.export');
    Route::get('/kelas/upgrade', 'upgrade')->name('kelas.upgrade');
});
Route::get('/kelas', [DataKelasController::class, 'index'])->name('kelas.index');

Route::get('/api/siswa', [PunishmentController::class, 'getSiswaByAngkatan']);
Route::get('/api/siswa', [DataKelasController::class, 'getSiswaByAngkatan']);
Route::get('/api/siswa-lulus/', [DataKelasController::class, 'getSiswaLulusByAngkatan']);

Route::get('/kelas/create', [DataKelasController::class, 'create'])->name('kelas.create');

Route::get('/zip-file', [ZipController::class, 'zipFile']);
Route::get('/zip-file/guru/{nama}', [ZipController::class, 'zipFileGuru'])->name('file.guru');
Route::get('/zip-file/tendik/{nama}', [ZipController::class, 'zipFileTendik'])->name('file.tendik');
Route::get('/zip-file/siswa/{nama}', [ZipController::class, 'zipFileSiswa'])->name('file.siswa');
Route::get('/zip-file/pkl/sekolah/{id}', [ZipController::class, 'zipFilePklSekolah'])->name('file.pkl.sekolah');
Route::get('/zip-file/pkl/siswa/{id}', [ZipController::class, 'zipFilePklSiswa'])->name('file.siswa.sekolah');

Route::controller(PunishmentController::class)->group(function () {
    Route::get('/punishment', 'index')->name('punishment.index');
    Route::get('/punishment/create', 'create')->name('punishment.create');
    Route::post('/punishment/create/data', 'store')->name('punishment.store');
    Route::get('/punishment/{id}/edit', [PunishmentController::class, 'edit'])->name('punishment.edit');
    Route::put('/punishment/{id}', [PunishmentController::class, 'update'])->name('punishment.update');
    Route::delete('/punishment/delete/{id}', 'destroy')->name('punishment.destroy');
    Route::get('/punishment/export-pdf', 'exportPdf')->name('punishment.export');
});

Route::get('/kelas/export', [DataKelasController::class, 'exportPdf'])->name('kelas.export');




Route::controller(JamaahSiswaController::class)->group(function () {
    Route::get('/jamaah', 'index')->name('jamaah.index');
    Route::get('/jamaah/create', 'create')->name('jamaah.create');
    Route::post('/jamaah/create/data', 'store')->name('jamaah.store');
    Route::get('jamaah/{tanggal}/{kelas}/{sholat}/edit/{id}', [JamaahSiswaController::class, 'edit'])->name('jamaah.edit');
    Route::put('/jamaah/{id}', [JamaahSiswaController::class, 'update'])->name('jamaah.update');
    Route::delete('/jamaah/delete/{id}', 'destroy')->name('jamaah.destroy');
    Route::get('/jamaah/export-pdf', 'exportPdf')->name('jamaah.export');
    Route::put('/jamaah/{tanggal}/{kelas}/{sholat}/{id}', [JamaahSiswaController::class, 'update'])->name('jamaah.update');
    Route::get('/jamaah/{tanggal}/{kelas}/{sholat}/export-pdf/sholat', [JamaahSiswaController::class, 'exportPdfPerSholat'])->name('jamaah.exportPdf');
    Route::get('/jamaah/{tanggal}/{kelas}/export-pdf/hari', [JamaahSiswaController::class, 'exportPdfPerHari'])->name('jamaah.exportPdf.hari');
    Route::get('/jamaah/export-pdf-range/{start_date}/{end_date}/{kelas}', [JamaahSiswaController::class, 'exportPdfPerRange'])->name('jamaah.exportPdf.range');
});

Route::controller(PatroliAsramaController::class)->group(function () {
    Route::get('/patroli/asrama', 'index')->name('patroli.asrama.index');
    Route::get('/patroli/asrama/create', 'create')->name('patroli.asrama.create');
    Route::get('/patroli/asrama/{id}/edit', [PatroliAsramaController::class, 'edit'])->name('patroli.asrama.edit');

    Route::post('/patroli/asrama/create/data', 'store')->name('patroli.asrama.store');
    Route::put('/patroli/asrama/{id}', [PatroliAsramaController::class, 'update'])->name('patroli.asrama.update');
    Route::delete('/patroli/delete/{id}', 'destroy')->name('patroli.asrama.destroy');
    Route::get('/patroli/export-pdf', 'exportPdf')->name('patroli.asrama.export');
});


// Keasramaan Mufiz

Route::view('sekolah-keasramaan/al-quran', 'page.keasramaan.quran.quran')
    ->name('quran');

Route::view('sekolah-keasramaan/akademik', 'page.keasramaan.akademik.akademik')
    ->name('akademik');

Route::view('sekolah-keasramaan/jurnal-asrama', 'page.keasramaan.jurnal.jurnal')
    ->name('jurnal');


//clear
Route::controller(tahfidzController::class)->group(function () {
    Route::get('/sekolah-keasramaan/al-quran/tahfidz', 'index')->name('tahfidz');
    Route::get('/sekolah-keasramaan/al-quran/tahfidz/create', 'create')->name('tahfidz.create');
    Route::post('/sekolah-keasramaan/al-quran/tahfidz/store', 'store')->name('tahfidz.perform');
    Route::get('/sekolah-keasramaan/al-quran/tahfidz/edit/{id}', 'edit')->name('tahfidz.edit');
    Route::put('/sekolah-keasramaan/al-quran/tahfidz/update/{id}', 'update')->name('tahfidz.update');
    Route::delete('/sekolah-keasramaan/al-quran/tahfidz/delete/{id}', 'destroy')->name('tahfidz.delete');
});

//clear
Route::controller(tahsinController::class)->group(function () {
    Route::get('/sekolah-keasramaan/al-quran/tahsin', 'index')->name('tahsin');
    Route::get('/sekolah-keasramaan/al-quran/tahsin/create', 'create')->name('tahsin.create');
    Route::post('/sekolah-keasramaan/al-quran/tahsin/store', 'store')->name('tahsin.perform');
    Route::get('/sekolah-keasramaan/al-quran/tahsin/edit/{id}', 'edit')->name('tahsin.edit');
    Route::put('/sekolah-keasramaan/al-quran/tahsin/update/{id}', 'update')->name('tahsin.update');
    Route::delete('/sekolah-keasramaan/al-quran/tahsin/delete/{id}', 'destroy')->name('tahsin.delete');
});

//clear
Route::controller(sertifikatController::class)->group(function () {
    Route::get('/sekolah-keasramaan/al-quran/sertif', 'index')->name('sertifikat');
    Route::get('/sekolah-keasramaan/al-quran/sertif/create', 'create')->name('sertifikat.create');
    Route::post('/sekolah-keasramaan/al-quran/sertif/store', 'store')->name('sertifikat.perform');
    Route::get('/sekolah-keasramaan/al-quran/sertif/edit/{id}', 'edit')->name('sertifikat.edit');
    Route::put('/sekolah-keasramaan/al-quran/sertif/update/{id}', 'update')->name('sertifikat.update');
    Route::delete('/sekolah-keasramaan/al-quran/sertif/delete/{id}', 'destroy')->name('sertifikat.delete');
});

//clear in http://127.0.0.1:8000/sekolah-keasramaan/akademik/pelatihan/create
Route::controller(pelatihanController::class)->group(function () {
    Route::get('/sekolah-keasramaan/akademik/pelatihan', 'index')->name('pelatihan.index');
    Route::get('/sekolah-keasramaan/akademik/pelatihan/create', 'create')->name('pelatihan.create');
    Route::post('/sekolah-keasramaan/akademik/pelatihan/store', 'store')->name('pelatihan.store');
    Route::get('/sekolah-keasramaan/akademik/pelatihan/edit/{id}', 'edit')->name('pelatihan.edit');
    Route::put('/sekolah-keasramaan/akademik/pelatihan/update/{id}', 'update')->name('pelatihan.update');
    Route::delete('/sekolah-keasramaan/akademik/pelatihan/delete/{id}', 'destroy')->name('pelatihan.delete');
});

//clear
Route::controller(lombaController::class)->group(function () {
    Route::get('/sekolah-keasramaan/akademik/lomba', 'index')->name('lomba.index');
    Route::get('/sekolah-keasramaan/akademik/lomba/create', 'create')->name('lomba.create');
    Route::post('/sekolah-keasramaan/akademik/lomba/store', 'store')->name('lomba.store');
    Route::get('/sekolah-keasramaan/akademik/lomba/edit/{id}', 'edit')->name('lomba.edit');
    Route::put('/sekolah-keasramaan/akademik/lomba/update/{id}', 'update')->name('lomba.update');
    Route::delete('/sekolah-keasramaan/akademik/lomba/delete/{id}', 'destroy')->name('lomba.delete');
});

//clear
Route::controller(eventualController::class)->group(function () {
    Route::get('/sekolah-keasramaan/akademik/eventual', 'index')->name('eventual.index');
    Route::get('/sekolah-keasramaan/akademik/eventual/create', 'create')->name('eventual.create');
    Route::post('/sekolah-keasramaan/akademik/eventual/store', 'store')->name('eventual.store');
    Route::get('/sekolah-keasramaan/akademik/eventual/edit/{id}', 'edit')->name('eventual.edit');
    Route::put('/sekolah-keasramaan/akademik/eventual/update/{id}', 'update')->name('eventual.update');
    Route::delete('/sekolah-keasramaan/akademik/eventual/delete/{id}', 'destroy')->name('eventual.delete');
});


Route::controller(akhlakController::class)->group(function () {
    Route::get('/sekolah-keasramaan/jurnal-asrama/akhlak', 'index')->name('akhlak.index');
    Route::get('/sekolah-keasramaan/jurnal-asrama/akhlak/create', 'create')->name('akhlak.create');
    Route::post('/sekolah-keasramaan/jurnal-asrama/akhlak/store', 'store')->name('akhlak.store');
    Route::get('/sekolah-keasramaan/jurnal-asrama/akhlak/edit/{id}', 'edit')->name('akhlak.edit');
    Route::put('/sekolah-keasramaan/jurnal-asrama/akhlak/update/{id}', 'update')->name('akhlak.update');
    Route::delete('/sekolah-keasramaan/jurnal-asrama/akhlak/delete/{id}', 'destroy')->name('akhlak.delete');
});
Route::controller(fiqihController::class)->group(function () {
    Route::get('/sekolah-keasramaan/jurnal-asrama/fiqih', 'index')->name('fiqih.index');
    Route::get('/sekolah-keasramaan/jurnal-asrama/fiqih/create', 'create')->name('fiqih.create');
    Route::post('/sekolah-keasramaan/jurnal-asrama/fiqih/store', 'store')->name('fiqih.store');
    Route::get('/sekolah-keasramaan/jurnal-asrama/fiqih/edit/{id}', 'edit')->name('fiqih.edit');
    Route::put('/sekolah-keasramaan/jurnal-asrama/fiqih/update/{id}', 'update')->name('fiqih.update');
    Route::delete('/sekolah-keasramaan/jurnal-asrama/fiqih/delete/{id}', 'destroy')->name('fiqih.delete');
});
Route::controller(tafsirController::class)->group(function () {
    Route::get('/sekolah-keasramaan/jurnal-asrama/tafsir', 'index')->name('tafsir.index');
    Route::get('/sekolah-keasramaan/jurnal-asrama/tafsir/create', 'create')->name('tafsir.create');
    Route::post('/sekolah-keasramaan/jurnal-asrama/tafsir/store', 'store')->name('tafsir.store');
    Route::get('/sekolah-keasramaan/jurnal-asrama/tafsir/edit/{id}', 'edit')->name('tafsir.edit');
    Route::put('/sekolah-keasramaan/jurnal-asrama/tafsir/update/{id}', 'update')->name('tafsir.update');
    Route::delete('/sekolah-keasramaan/jurnal-asrama/tafsir/delete/{id}', 'destroy')->name('tafsir.delete');
});
Route::controller(tajwidController::class)->group(function () {
    Route::get('/sekolah-keasramaan/jurnal-asrama/tajwid', 'index')->name('tajwid.index');
    Route::get('/sekolah-keasramaan/jurnal-asrama/tajwid/create', 'create')->name('tajwid.create');
    Route::post('/sekolah-keasramaan/jurnal-asrama/tajwid/store', 'store')->name('tajwid.store');
    Route::get('/sekolah-keasramaan/jurnal-asrama/tajwid/edit/{id}', 'edit')->name('tajwid.edit');
    Route::put('/sekolah-keasramaan/jurnal-asrama/tajwid/update/{id}', 'update')->name('tajwid.update');
    Route::delete('/sekolah-keasramaan/jurnal-asrama/tajwid/delete/{id}', 'destroy')->name('tajwid.delete');
});

require __DIR__ . '/auth.php';
