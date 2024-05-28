<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTagihan extends Model
{
    use HasFactory;
    protected $table = 'data_tagihan';

    protected $primaryKey = 'id_tagihan';
    public $timestamps = false;
    protected $fillable = [
        'id_tagihan',
        'id_pengajuan',
        'id_status_tagihan',
    ];
}
