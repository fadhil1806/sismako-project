<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tendik extends Model
{
    use HasFactory;

    protected $table = 'tendik';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama', 'no_nik', 'no_gtk', 'no_nuptk', 'tempat_tanggal_lahir', 'no_hp',
        'tanggal_lahir', 'jenis_kelamin', 'agama', 'alamat', 'status_kepegawaian',
        'no_rekening', 'posisi', 'email', 'pendidikan_terakhir', 'tanggal_masuk',
        'tanggal_keluar', 'foto', 'foto_ktp', 'foto_surat_keterangan_mengajar',
    ];

    protected $dates = [
        'tanggal_lahir', 'tanggal_masuk', 'tanggal_keluar',
    ];

    public function ijazah()
    {
        return $this->hasMany(IjazahTendik::class, 'id_tendik');
    }

    public function sertifikat()
    {
        return $this->hasMany(SertifikatTendik::class, 'id_tendik');
    }

    public function getFormattedDates()
    {
        return [
            'tanggal_lahir' => $this->tanggal_lahir instanceof Carbon ? $this->tanggal_lahir->format('Y-m-d') : $this->tanggal_lahir,
            'tanggal_masuk' => $this->tanggal_masuk instanceof Carbon ? $this->tanggal_masuk->format('Y-m-d') : $this->tanggal_masuk,
            'tanggal_keluar' => $this->tanggal_keluar instanceof Carbon ? $this->tanggal_keluar->format('Y-m-d') : $this->tanggal_keluar,
        ];
    }
}
