<?php

use App\Http\Controllers\DatabaseDashboard;
use App\Http\Controllers\DataKelasController;
use App\Http\Controllers\DataKelulusanController;
use App\Http\Controllers\DataMutasiController;
use App\Http\Controllers\DataPrestasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PklAdministrasiSekolahController;
use App\Http\Controllers\PklAdministrasiSiswaController;
use App\Http\Controllers\PunishmentController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TendikController;
use App\Http\Controllers\ZipController;

Route::view('/', 'welcome');

Route::get('/dashboard', [DatabaseDashboard::class, 'index'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('pkl', 'database.pkl.pkl')
    ->name('pkl');



Route::controller(PklAdministrasiSekolahController::class)->group(function () {
    Route::get('pkl/adm-sekolah', 'sekolah')->name('pkl.sekolah.index');
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
    Route::get('/guru/export/{id}', 'export')->name('guru.export');
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

Route::controller(PunishmentController::class)->group(function() {
    Route::get('/punishment', 'index')->name('punishment.index');
    Route::get('/punishment/create', 'create')->name('punishment.create');
    Route::post('/punishment/create/data', 'store')->name('punishment.store');
    Route::get('/punishment/{id}/edit', [PunishmentController::class, 'edit'])->name('punishment.edit');
Route::put('/punishment/{id}', [PunishmentController::class, 'update'])->name('punishment.update');
Route::delete ('/punishment/delete/{id}', 'destroy')->name('punishment.destroy');
Route::get('/punishment/export-pdf', 'exportPdf')->name('punishment.export');
});

Route::get('/kelas/export', [DataKelasController::class, 'exportPdf'])->name('kelas.export');

require __DIR__ . '/auth.php';
