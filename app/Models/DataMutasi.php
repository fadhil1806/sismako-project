<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMutasi extends Model
{
    use HasFactory;

    protected $table = 'data_mutasi';

    protected $fillable = [
        'nama',
        'status',
        'mutasi',
        'tanggal_mutasi',
        'asal_sekolah',
        'tujuan_berikutnya',
        'alasan',
        'path_dokumen_pendukung_tambahan'
    ];

    protected $dates = [
        'tanggal_mutasi'
    ];
}
