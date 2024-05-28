<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataStatusLaporan extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'data_status_laporan';

    protected $primaryKey = 'id_status_laporan';
    public $timestamps = false;
    protected $fillable = [
        'id_status_laporan',
        'status_laporan',
    ];
}
