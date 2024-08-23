<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tahsin extends Model
{
    use HasFactory;
    protected $table = 'tahsin';
    protected $fillable = [
        'tanggal',
        'siswa_id',
        'surat',
        'ayat',
        'predikat',
        'pengajar',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('tanggal', [$startDate, $endDate]);
    }
}
