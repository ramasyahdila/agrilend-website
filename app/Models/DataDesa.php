<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDesa extends Model
{
    use HasFactory;

    protected $table = 'data_desa';

    protected $primaryKey = 'id_desa';


    public $timestamps = false;
    protected $fillable = [
        'id_desa',
        'desa',
        'id_kota',
    ];
    public function DataKota()
    {
        return $this->belongsTo(DataKota::class, 'id_desa', 'id_desa');
    }
}