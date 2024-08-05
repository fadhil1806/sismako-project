<?php
namespace App\Models;

use App\Models\Tendik;
use Illuminate\Database\Eloquent\Model;

class SertifikatTendik extends Model
{
    protected $table = 'sertifikat_tendik';

    protected $fillable = [
        'id_tendik',
        'nama_file',
    ];

    public function tendik()
    {
        return $this->belongsTo(Tendik::class, 'id_tendik');
    }
}
