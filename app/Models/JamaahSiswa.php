<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamaahSiswa extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'jamaah_siswa';

    // Kolom yang dapat diisi
    protected $fillable = [
        'dokumentasi_jamaah',
        'id_siswa',
        'status_jamaah',
    ];

    // Relasi dengan model DokumentasiJamaahSiswa
    public function dokumentasiJamaahSiswa()
    {
        return $this->belongsTo(DokumentasiJamaahSiswa::class, 'dokumentasi_jamaah');
    }

    // Relasi dengan model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
