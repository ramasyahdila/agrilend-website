<?php

namespace Database\Seeders;

use App\Models\DataStatusPengajuanModal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataStatusPengajuanModalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataStatusPengajuanModal::insert([
            'id_status_pengajuan' => 1,
            'status_pengajuan' => 'Belum Dikonfirmasi',
        ]);
        DataStatusPengajuanModal::insert([
            'id_status_pengajuan' => 2,
            'status_pengajuan' => 'Terkonfirmasi',
        ]);
        DataStatusPengajuanModal::insert([
            'id_status_pengajuan' => 3,
            'status_pengajuan' => 'Sudah Diterima',
        ]);
        DataStatusPengajuanModal::insert([
            'id_status_pengajuan' => 4,
            'status_pengajuan' => 'Ditolak',
        ]);
    }
}
