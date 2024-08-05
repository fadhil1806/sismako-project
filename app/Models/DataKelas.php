<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKelas extends Model
{
    use HasFactory;

    protected $table = 'data_kelas';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Define the fillable properties
    protected $fillable = [
        'id_siswa', // Ensure this matches the field in the database
        'tahun_pelajaran',
        'no_urut',
        'kelas',
        'jurusan',
        'angkatan'
    ];

    // Define the relationship with Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa'); // Ensure 'id_siswa' matches the column name
    }
}

