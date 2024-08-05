<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikatGuru extends Model
{
    use HasFactory;

    protected $table = 'sertifikat_guru'; // Nama tabel sesuai dengan yang Anda tentukan dalam migration
    protected $fillable = [
        'id_guru', 'nama_file',
    ];

    // Definisi relasi dengan tabel 'guru'
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}
