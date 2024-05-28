<?php

namespace Database\Seeders;

use App\Models\DataStatusLaporan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataStatusLaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataStatusLaporan::insert([
            'id_status_laporan' => 1,
            'status_laporan' => 'Belum Terkonfirmasi',
        ]);
        DataStatusLaporan::insert([
            'id_status_laporan' => 2,
            'status_laporan' => 'Terkonfirmasi',
        ]);
    }
}
