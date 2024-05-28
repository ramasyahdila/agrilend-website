<?php

namespace Database\Seeders;

use App\Models\DataDesa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DataKotaSeeder::class);
        DataDesa::insert([
            'id_desa' => 1,
            'desa' => 'Nogosari',
            'id_kota' => 1,
        ]);
    }
}
