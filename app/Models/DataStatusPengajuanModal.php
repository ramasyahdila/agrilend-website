<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataStatusPengajuanModal extends Model
{
    use HasFactory;
    protected $table = 'data_status_pengajuan_modal';

    protected $primaryKey = 'id_status_pengajuan';
    public $timestamps = false;
    protected $fillable = [
        'id_status_pengajuan',
        'status_pengajuan',
    ];
}
