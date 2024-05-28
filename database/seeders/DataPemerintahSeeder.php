<?php

namespace Database\Seeders;

use App\Models\DataAkunPemerintah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataPemerintahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DataDesaSeeder::class);
        DataAkunPemerintah::insert([
            'id_pemerintah' => 1,
            'username_pemerintah' => 'LMJ123',
            'password' => bcrypt('123'),
            'nama_pemerintah' => 'Dinas Lumajang',
            'id_kota' => 1,
            'no_tlp' => '081222222222',
        ]);
    }
}
