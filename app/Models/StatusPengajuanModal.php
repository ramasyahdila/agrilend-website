<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPengajuanModal extends Model
{
    use HasFactory;
    protected $table = 'data_status_pengajuan_modal'; // Sesuaikan dengan nama tabel pada database

    protected $primaryKey = 'id_status_pengajuan'; // Sesuaikan dengan nama kolom kunci utama pada tabel

    protected $fillable = [
        'status_pengajuan',

    ]; 

    public function peminjaman()
    {
        return $this->hasMany(PeminjamanModal::class, 'id_status_pengajuan');
    }
}
