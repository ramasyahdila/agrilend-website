<?php

namespace Database\Seeders;

use App\Models\DataStatusTagihan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataStatusTagihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataStatusTagihan::insert([
            'id_status_tagihan' => 1,
            'status_tagihan' => 'Belum Bayar',
        ]);
        DataStatusTagihan::insert([
            'id_status_tagihan' => 2,
            'status_tagihan' => 'Tidak Bisa Bayar',
        ]);
        DataStatusTagihan::insert([
            'id_status_tagihan' => 3,
            'status_tagihan' => 'Belum Bayar Bunga',
        ]);
        DataStatusTagihan::insert([
            'id_status_tagihan' => 4,
            'status_tagihan' => 'Sudah Bayar Bunga',
        ]);
        DataStatusTagihan::insert([
            'id_status_tagihan' => 5,
            'status_tagihan' => 'Sudah Bayar',
        ]);
        DataStatusTagihan::insert([
            'id_status_tagihan' => 6,
            'status_tagihan' => 'Selesai',
        ]);
    }
}
