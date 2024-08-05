<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    // Define the table name if it's different from the plural form of the class name
    protected $table = 'siswa';

    // Define the primary key if it's different from 'id'
    protected $primaryKey = 'id';

    // If the primary key is not an incrementing integer, set the incrementing property to false
    public $incrementing = true;

    // Define the data type of the primary key if it's different from int
    // protected $keyType = 'bigint';

    // Define the fields that are mass assignable
    protected $fillable = [
        'tahun_pelajaran',
        'nama',
        'nisn',
        'nis',
        'tempat_tanggal_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'nama_ayah',
        'nama_ibu',
        'tanggal_masuk',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'no_hp_wali',
        'diterima_di_kelas',
        'angkatan',
        'asal_sekolah',
        'alamat_asal_sekolah',
        'path_ijazah',
        'path_surat_Kelulusan',
        'path_kk',
        'path_akta_kelahiran',
        'path_surat_pernyataan_calonPesertaDidik',
        'path_surat_pernyataan_wali',
        'path_surat_pernyataan_tidak_merokok',
        'status_siswa',
    ];

    protected $dates = ['tanggal_masuk'];

    // Define the relationship with RapotSiswa
    public function rapotSiswa()
    {
        return $this->hasMany(RapotSiswa::class, 'id_siswa', 'id');
    }

    // Define the relationship with FotoSiswa
    public function fotoSiswa()
    {
        return $this->hasMany(FotoSiswa::class, 'id_siswa', 'id');
    }

    public function dataKelas()
    {
        return $this->hasMany(DataKelas::class, 'siswa_id', 'id');
    }
}
