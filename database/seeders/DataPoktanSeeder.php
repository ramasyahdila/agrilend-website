<?php

namespace Database\Seeders;

use App\Models\DataAkunPoktan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataPoktanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DataPemerintahSeeder::class);
        DataAkunPoktan::insert([
            'id_poktan' => 1,
            'username_poktan' => 'MLT1234',
            'password' => bcrypt('123'),
            'nama_poktan' => 'Poktan Melati',
            'alamat_poktan' => 'JL. Melati Desa Nogosari',
            'id_desa' => 1,
            'id_pemerintah' => 1,
            'no_tlp' => '081233333333',
        ]);
        DataAkunPoktan::insert([
            'id_poktan' => 2,
            'username_poktan' => 'LMJ1234',
            'password' => bcrypt('123'),
            'nama_poktan' => 'Poktan Anggur',
            'alamat_poktan' => 'JL. Anggur Desa Holywings',
            'id_desa' => 1,
            'id_pemerintah' => 1,
            'no_tlp' => '081233777333',
        ]);
    }
}
