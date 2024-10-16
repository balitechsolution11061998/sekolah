<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the classes from A to J for SMP 7, 8, and 9
        $kelasNames = [];
        for ($grade = 7; $grade <= 9; $grade++) {
            for ($i = 'A'; $i <= 'J'; $i++) {
                $kelasNames[] = 'SMP ' . $grade . ' ' . $i;
            }
        }

        // Insert sample data into the 'kelas' table
        foreach ($kelasNames as $index => $kelas) {
            DB::table('kelas')->insert([
                [
                    'kode_kelas' => 'SMP' . $grade . '-' . str_pad($index % 10 + 1, 2, '0', STR_PAD_LEFT), // Calculate the index for kode_kelas
                    'kelas' => $kelas,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}
