<?php

namespace Database\Seeders;

use App\Models\DataKota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataKotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataKota::insert([
            'id_kota' => 1,
            'kota' => 'Lumajang',
        ]);
        DataKota::insert([
            'id_kota' => 2,
            'kota' => 'Jember',
        ]);
    }
}
