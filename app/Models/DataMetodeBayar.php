<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMetodeBayar extends Model
{
    use HasFactory;
    
    protected $table = 'data_metode_bayar';

    protected $primaryKey = 'id_metode_bayar';
    public $timestamps = false;
    protected $fillable = [
        'id_metode_bayar',
        'metode_bayar',
    ];
}
