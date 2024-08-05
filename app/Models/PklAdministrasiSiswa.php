<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PklAdministrasiSiswa extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'pkl_adminstrasi_siswa';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'nama',
        'nisn',
        'tempat_pkl',
        'path_rekap_kehadiran',
        'path_jurnal_pkl',
    ];
}
