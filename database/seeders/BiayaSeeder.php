<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BiayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('biayas')->insert([
            [
                'kode_biaya' => 'B001',
                'nama_biaya' => 'SPP Bulanan',
                'jumlah' => 500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_biaya' => 'B002',
                'nama_biaya' => 'Biaya Seragam',
                'jumlah' => 750000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_biaya' => 'B003',
                'nama_biaya' => 'Uang Buku',
                'jumlah' => 300000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_biaya' => 'B004',
                'nama_biaya' => 'Biaya Kegiatan Tahunan',
                'jumlah' => 1000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
