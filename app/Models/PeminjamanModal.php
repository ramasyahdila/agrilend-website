<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanModal extends Model
{
    protected $table = 'data_pengajuan_modal'; // Sesuaikan dengan nama tabel pada database

    protected $primaryKey = 'id_pengajuan'; // Sesuaikan dengan nama kolom kunci utama pada tabel

    protected $fillable = [
        'id_petani',
        'jml_pinjam',
        'bunga',
        'jml_diterima',
        'tgl_pinjam',
        'tenggat_kembali',
        'id_status_pengajuan',
    ]; // Attribut yang dapat diisi secara massal

    // Relasi dengan model DataAkunPetani
    public function petani()
    {
        return $this->belongsTo(DataAkunPetani::class, 'id_petani', 'id_petani');
    }
    public function status()
    {
        return $this->belongsTo(StatusPengajuanModal::class, 'id_status_pengajuan');
    }
    // Aktifkan timestamp
    public $timestamps = false;
}
