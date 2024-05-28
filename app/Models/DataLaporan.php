<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLaporan extends Model
{
    use HasFactory;
    protected $table = 'data_laporan';

    protected $primaryKey = 'id_laporan';
    public $timestamps = false;
    protected $fillable = [
        'id_laporan',
        'id_poktan',
        'id_status_laporan',
        'laporan',
    ];
}
