<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumentasiJamaahSiswa extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'dokumentasi_jamaah_siswa';

    // Kolom yang dapat diisi
    protected $fillable = [
        'kelas',
        'tanggal',
        'sholat',
        'path_dokumentasi',
    ];

    // Relasi dengan model JamaahSiswa
    public function jamaahSiswa()
    {
        return $this->hasMany(JamaahSiswa::class, 'dokumentasi_jamaah');
    }
}
