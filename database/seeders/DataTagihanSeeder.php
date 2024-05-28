<?php

namespace Database\Seeders;

use App\Models\DataTagihan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataTagihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DataPengajuanModalSeeder::class);
        DataTagihan::insert([
            'id_tagihan' => 1,
            'id_pengajuan' => 1,
            'id_status_tagihan' => 1,
        ]);
        DataTagihan::insert([
            'id_tagihan' => 2,
            'id_pengajuan' => 1,
            'id_status_tagihan' => 1,
        ]);
    }
}
