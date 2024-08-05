<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PklAdministrasiSekolah extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'pkl_adminstrasi_sekolah';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'tahun_ajaran',
        'nama_perusahaan',
        'path_foto_siswa_dan_perusahaan',
        'path_foto_mov',
    ];
}
