<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DataAkunPetani extends Authenticatable
{
    use HasFactory;

    protected $table = 'data_akun_petani'; // Ganti 'nama_tabel_anda' dengan nama tabel sebenarnya
    protected $primaryKey = 'id_petani';

    public $timestamps = false;

    protected $fillable = [
        'id_petani',
        'username_petani',
        'password',
        'nik',
        'nama_petani',
        'ttl_petani',
        'pekerjaan',
        'alamat_petani',
        'id_desa',
        'no_tlp',
        'id_poktan',
    ];

    public function DataDesa()
    {
        return $this->belongsTo(DataDesa::class, 'id_desa', 'id_desa');
    }

    public function DataAkunPoktan()
    {
        return $this->belongsTo(DataAkunPoktan::class, 'id_poktan', 'id_poktan');
    }
}