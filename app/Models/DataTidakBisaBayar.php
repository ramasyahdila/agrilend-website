<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTidakBisaBayar extends Model
{
    use HasFactory;
    protected $table = 'data_tidak_bisa_bayar';

    protected $primaryKey = 'id_tidak_bisa_bayar';
    public $timestamps = false;
    protected $fillable = [
        'id_tidak_bisa_bayar',
        'tgl_kembali',
        'bunga',
        'id_tagihan',
        'id_metode_bayar',
    ];
}
