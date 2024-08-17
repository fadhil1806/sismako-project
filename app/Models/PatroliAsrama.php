<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatroliAsrama extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'patroli_asrama';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'tanggal',
        'area',
        'dokumentasi',
        'status_patroli',
    ];
}
