<?php

namespace App\Models;

use App\Models\IjazahGuru;
use App\Models\SertifikatGuru;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru'; // Sesuaikan dengan nama tabel di database Anda
    protected $primaryKey = 'id'; // Sesuaikan dengan nama kunci utama pada tabel 'guru'
    protected $fillable = [
        // Kolom-kolom yang dapat diisi secara massal
        'nama', 'no_nik', 'no_gtk', 'no_nuptk', 'tempat_tanggal_lahir', 'tanggal_lahir',
        'jenis_kelamin', 'agama', 'nama_lulusan_pt', 'nama_jurusan_pt', 'alamat',
        'no_hp', 'mapel', 'gelar', 'email', 'no_rekening', 'status_kepegawaian', 'foto',
        'tanggal_masuk', 'tanggal_keluar', 'foto_ktp', 'foto_surat_keterangan_mengajar'
    ];
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
        'tanggal_keluar' => 'date',
    ];
    public function ijazah()
    {
        return $this->hasMany(IjazahGuru::class, 'id_guru');
    }

    // Definisi relasi dengan tabel 'sertifikat_guru'
    public function sertifikat()
    {
        return $this->hasMany(SertifikatGuru::class, 'id_guru');
    }
}
