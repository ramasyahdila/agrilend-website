<?php

namespace Database\Seeders;

use App\Models\DataMetodeBayar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataMetodeBayarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataMetodeBayar::insert([
            'id_metode_bayar' => 1,
            'metode_bayar' => 'Transfer',
        ]);
        DataMetodeBayar::insert([
            'id_metode_bayar' => 2,
            'metode_bayar' => 'Tunai',
        ]);
    }
}
