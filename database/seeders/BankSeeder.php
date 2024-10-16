<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            ['sandi_bank' => 'BMRI', 'nama_bank' => 'Bank Mandiri'],
            ['sandi_bank' => 'BRI', 'nama_bank' => 'Bank Rakyat Indonesia (BRI)'],
            ['sandi_bank' => 'BNI', 'nama_bank' => 'Bank Negara Indonesia (BNI)'],
            ['sandi_bank' => 'BCA', 'nama_bank' => 'Bank Central Asia (BCA)'],
            ['sandi_bank' => 'CIMB', 'nama_bank' => 'Bank CIMB Niaga'],
            ['sandi_bank' => 'BDMN', 'nama_bank' => 'Bank Danamon'],
            ['sandi_bank' => 'MAYB', 'nama_bank' => 'Bank Maybank Indonesia'],
            ['sandi_bank' => 'BTN', 'nama_bank' => 'Bank Tabungan Negara (BTN)'],
            ['sandi_bank' => 'PNBN', 'nama_bank' => 'Bank Permata'],
            ['sandi_bank' => 'BTPN', 'nama_bank' => 'Bank BTPN'],
            ['sandi_bank' => 'OCBC', 'nama_bank' => 'Bank OCBC NISP'],
            ['sandi_bank' => 'BMGA', 'nama_bank' => 'Bank Mega'],
            ['sandi_bank' => 'BANK', 'nama_bank' => 'Bank Jago'],
            ['sandi_bank' => 'BSIM', 'nama_bank' => 'Bank Sinarmas'],
            ['sandi_bank' => 'VICTORIA', 'nama_bank' => 'Bank Victoria International'],
        ];

        DB::table('banks')->insert($banks);
    }
}
