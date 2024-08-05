<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPrestasi extends Model
{
    use HasFactory;

    protected $table = 'data_prestasi';

    protected $fillable = [
        'nama',
        'status',
        'kelas',
        'tanggal_lomba',
        'tempat_lomba',
        'peringkat',
        'nama_file',
    ];

    protected $dates = [
        'tanggal_lomba'
    ];
}
