<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPengajuanModal extends Model
{
    use HasFactory;
    protected $table = 'data_pengajuan_modal';

    protected $primaryKey = 'id_pengajuan';
    public $timestamps = false;
    protected $fillable = [
        'id_pengajuan',
        'id_petani',
        'id_status_pengajuan',
        'jml_pinjam',
        'bunga',
        'jml_diterima',
        'tgl_pinjam',
        'tenggat_kembali',
    ];
}
