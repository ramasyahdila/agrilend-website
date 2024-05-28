<?php

namespace Database\Seeders;

use App\Models\DataAkunPetani;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataPetaniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DataPoktanSeeder::class);
        DataAkunPetani::insert([
            'id_petani' => 1,
            'username_petani' => 'qwerty12',
            'password' => bcrypt('123'),
            'nik' => '3514092222222222',
            'nama_petani' => 'Syahdiladarama',
            'ttl_petani' => '2024-05-06',
            'pekerjaan' => 'mahasiswa',
            'alamat_petani' => 'Jl. Melati no 23',
            'id_desa' => 1,
            'no_tlp' => '081244444444',
            'id_poktan' => 1,
        ]);
        DataAkunPetani::insert([
            'id_petani' => 2,
            'username_petani' => 'saya123',
            'password' => bcrypt('123'),
            'nik' => '3514095555555555',
            'nama_petani' => 'saya',
            'ttl_petani' => '1986-07-17',
            'pekerjaan' => 'buruh',
            'alamat_petani' => 'jl. jawa no3',
            'id_desa' => 1,
            'no_tlp' => '081288888888',
            'id_poktan' => 2,
        ]);
    }
}
