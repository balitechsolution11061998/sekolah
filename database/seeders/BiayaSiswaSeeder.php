<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Biaya;
use App\Models\BiayaSiswa;
use App\Models\Student;
use Faker\Factory as Faker;

class BiayaSiswaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get all students and all fees
        $students = Student::all();  // Assuming Siswa is your student model
        $biayas = Biaya::all();  // Assuming Biaya is your fee model

        foreach ($students as $student) {
            foreach ($biayas as $biaya) {
                // Randomly choose if the fee is to be paid monthly or yearly
                $periode = $faker->randomElement(['bulanan', 'tahunan']);

                // Define the total amount for the fee
                $jumlah = $faker->numberBetween(500000, 5000000);  // Example: between Rp. 500,000 and Rp. 5,000,000

                // Randomly decide if the fee is to be paid in installments
                $is_angsur = $faker->boolean;

                // If paying in installments, calculate the number of installments and installment amount
                if ($is_angsur) {
                    $jumlah_angsuran_total = $faker->numberBetween(2, 12);  // Example: between 2 and 12 installments
                    $jumlah_angsur = (int)($jumlah / $jumlah_angsuran_total);
                    $angsuran_terbayar = $faker->numberBetween(0, $jumlah_angsuran_total);  // Example: some installments may already be paid
                } else {
                    $jumlah_angsur = null;
                    $jumlah_angsuran_total = null;
                    $angsuran_terbayar = 0;
                }

                // Calculate start and end dates for the fee period
                $tanggal_mulai = $faker->date();
                $tanggal_akhir = ($periode == 'bulanan')
                    ? $faker->dateTimeBetween($tanggal_mulai, '+1 month')
                    : $faker->dateTimeBetween($tanggal_mulai, '+1 year');

                // Insert the fee data for the student
                BiayaSiswa::create([
                    'biaya_id' => $biaya->id,
                    'siswa_id' => $student->id,
                    'periode' => $periode,
                    'jumlah' => $jumlah,
                    'tanggal_mulai' => $tanggal_mulai,
                    'tanggal_akhir' => $tanggal_akhir,
                    'status' => $angsuran_terbayar == $jumlah_angsuran_total ? 'lunas' : 'belum_lunas',  // Status depends on whether all installments are paid
                    'is_angsur' => $is_angsur,
                    'jumlah_angsur' => $jumlah_angsur,
                    'jumlah_angsuran_total' => $jumlah_angsuran_total,
                    'angsuran_terbayar' => $angsuran_terbayar,
                ]);
            }
        }
    }
}
