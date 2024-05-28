<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataStatusTagihan extends Model
{
    use HasFactory;
    protected $table = 'data_status_tagihan';

    protected $primaryKey = 'id_status_tagihan';
    public $timestamps = false;
    protected $fillable = [
        'id_status_tagihan',
        'status_tagihan',
    ];
}
