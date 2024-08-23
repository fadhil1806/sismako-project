<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    use HasFactory;

    protected $table = 'pelatihan';

    protected $fillable = [
        'tanggal',
        'siswa_id',
        'kegiatan',
        'keterangan',
        'undangan',
        'dokumentasi',
        'type',
    ];

    /**
     * Get the siswa that owns the pelatihan.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
