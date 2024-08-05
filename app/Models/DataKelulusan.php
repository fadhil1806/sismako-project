<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKelulusan extends Model
{
    use HasFactory;

    protected $table = 'data_kelulusan';

    protected $fillable = [
        'tahun_pelajaran',
        'id_siswa',
        'jurusan',
        'tanggal_kelulusan',
        'angkatan',
        'karir_selanjutnya',
        'no_hp',
        'email',
        'path_foto',
    ];

    protected $dates = [
        'tanggal_kelulusan'
    ];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa'); // Ensure 'id_siswa' matches the column name
    }
}
