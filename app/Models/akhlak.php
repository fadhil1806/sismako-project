<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class akhlak extends Model
{
    use HasFactory;
    protected $table = 'akhlak';
    protected $fillable = [
        'tanggal',
        'kelas',
        'siswa_id',
        'materi',
        'type',
        'nisn',
    ];


    public function scopeNisn($value, $query){
        return $value->where('nisn', $query);
    }

    public function scopeType($query, $type){
        return $query->where('type', $type);
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('tanggal', [$startDate, $endDate]);
    }
}
