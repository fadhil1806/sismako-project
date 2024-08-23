<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sertifikat extends Model
{
    use HasFactory;
    protected $table = 'sertifikat';
    protected $fillable = [
        'tanggal',
        'siswa_id',
        'juz_30',
        'juz_29',
        'juz_28',
        'juz_umum',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
