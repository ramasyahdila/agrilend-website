<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPembayaran extends Model
{
    use HasFactory;
    protected $table = 'data_pembayaran';

    protected $primaryKey = 'id_pembayaran';
    public $timestamps = false;
    protected $fillable = [
        'id_pembayaran',
        'tgl_pembayaran',
        'id_tagihan',
        'id_metode_bayar',
    ];
}
