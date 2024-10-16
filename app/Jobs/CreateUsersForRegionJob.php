<?php

namespace App\Jobs;

use App\Models\Biaya;
use App\Models\BiayaSiswa;
use App\Models\Guru;
use App\Models\Role;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateUsersForRegionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 1200; // Timeout for the job
    protected $specialEmail = 'sulaksana60@gmail.com';
    protected $newAdminEmail = 'adibintang2167@gmail.com';
    protected $newAdminUsername = 'adicita179';
    protected $newAdminPassword = '08129911930';
    protected $batchSize = 1000;
    protected $totalUsers;
    private $currentYear;

    public function __construct($totalUsers)
    {
        $this->totalUsers = $totalUsers;
        $this->currentYear = date('Y');
    }

    private function generateIndonesianPhoneNumber(): string
    {
        $phoneNumber = '08' . rand(10000000, 99999999);
        return $phoneNumber;
    }

    public function handle(): void
    {
        $faker = Faker::create('id_ID');

        $roles = ['administrator', 'siswa', 'guru'];
        $roleIds = Role::whereIn('name', $roles)->pluck('id', 'name')->toArray();

        $kelas = DB::table('kelas')->pluck('id')->toArray();

        $nisnCounter = 1;

        for ($batch = 0; $batch < ceil($this->totalUsers / $this->batchSize); $batch++) {
            $usersBatch = [];
            $studentsBatch = [];
            $teachersBatch = [];

            for ($i = 1; $i <= $this->batchSize; $i++) {
                $index = ($batch * $this->batchSize) + $i;
                if ($index > $this->totalUsers) break;

                $email = ($index === 1) ? $this->specialEmail :
                         (($index === 2) ? $this->newAdminEmail : "user_{$index}@example.com");

                $fullName = $faker->name;
                $plainPassword = ($email === $this->newAdminEmail) ? $this->newAdminPassword :
                                (($email === $this->specialEmail) ? 'Superman2000@' : 'password');

                $usersBatch[] = [
                    'name' => $fullName,
                    'username' => ($email === $this->newAdminEmail) ? $this->newAdminUsername : strtolower(str_replace(' ', '', $fullName)) . $index,
                    'profile_picture' => '/storage/logo.png',
                    'email' => $email,
                    'password' => Hash::make($plainPassword),
                    'password_show' => $plainPassword,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                if ($index > 2) {
                    if ($index % 2 == 0) {
                        $nip = str_pad(rand(0, 9999999999999999), 18, '0', STR_PAD_LEFT);
                        $nuptk = str_pad(rand(0, 9999999999999999), 16, '0', STR_PAD_LEFT);

                        $teachersBatch[] = [
                            'user_id' => null,
                            'nama_lengkap' => $fullName,
                            'gelar' => 'S.Pd.',
                            'nip' => $nip,
                            'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                            'tempat_lahir' => $faker->city,
                            'tanggal_lahir' => $faker->dateTimeBetween('-50 years', '-30 years'),
                            'nuptk' => $nuptk,
                            'alamat' => $faker->address,
                            'avatar' => '/storage/default_avatar.png',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    } else {
                        $nisn = $this->currentYear . str_pad($nisnCounter++, 6, '0', STR_PAD_LEFT);
                        $nik = str_pad(rand(0, 9999999999999999), 16, '0', STR_PAD_LEFT);
                        $tingkatRombel = $kelas[array_rand($kelas)];

                        $studentsBatch[] = [
                            'nama_lengkap' => $fullName,
                            'nisn' => $nisn,
                            'nik' => $nik,
                            'tempat_lahir' => $faker->city,
                            'tanggal_lahir' => $faker->dateTimeBetween('-20 years', '-10 years'),
                            'tingkat_rombel' => $tingkatRombel,
                            'umur' => rand(10, 20),
                            'status' => 'Active',
                            'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                            'alamat' => $faker->address,
                            'no_telepon' => $this->generateIndonesianPhoneNumber(),
                            'kebutuhan_khusus' => null,
                            'disabilitas' => null,
                            'nomor_kip_pip' => null,
                            'nama_ayah' => 'Father of ' . $fullName,
                            'nama_ibu' => 'Mother of ' . $fullName,
                            'nama_wali' => null,
                            'foto_profile' => null,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            }

            DB::transaction(function () use ($usersBatch, $roleIds, $studentsBatch, $teachersBatch) {
                User::insert($usersBatch);

                $userIds = User::whereIn('email', array_column($usersBatch, 'email'))->pluck('id', 'email')->toArray();
                $roleAssignments = [];

                foreach ($usersBatch as $userData) {
                    $userId = $userIds[$userData['email']];
                    $userRole = ($userData['email'] === $this->specialEmail || $userData['email'] === $this->newAdminEmail) ?
                                $roleIds['administrator'] : $roleIds[array_rand($roleIds)];

                    $roleAssignments[] = [
                        'role_id' => $userRole,
                        'user_id' => $userId,
                        'user_type' => 'App\Models\User',
                    ];

                    if ($userRole == $roleIds['guru']) {
                        foreach ($teachersBatch as &$teacher) {
                            if ($teacher['user_id'] === null) {
                                $teacher['user_id'] = $userId;
                                break;
                            }
                        }
                    }
                }

                DB::table('role_user')->insert($roleAssignments);
                Student::insert($studentsBatch);
                Guru::insert($teachersBatch);
            });

            \Log::info("Batch {$batch} of " . ceil($this->totalUsers / $this->batchSize) . " completed. Users created: " . count($usersBatch));
        }

        $students = Student::all();
        $biayas = Biaya::all();

        foreach ($students as $student) {
            foreach ($biayas as $biaya) {
                $periode = $faker->randomElement(['bulanan', 'tahunan']);
                $jumlah = $faker->numberBetween(500000, 5000000);
                $is_angsur = $faker->boolean;
                $jumlah_angsuran_total = $is_angsur ? $faker->numberBetween(2, 12) : null;
                $jumlah_angsur = $is_angsur ? (int)($jumlah / $jumlah_angsuran_total) : null;
                $angsuran_terbayar = $is_angsur ? $faker->numberBetween(0, $jumlah_angsuran_total) : 0;

                $tanggal_mulai = $faker->date();
                $tanggal_akhir = ($periode == 'bulanan') ? $faker->dateTimeBetween($tanggal_mulai, '+1 month') : $faker->dateTimeBetween($tanggal_mulai, '+1 year');

                BiayaSiswa::create([
                    'biaya_id' => $biaya->id,
                    'siswa_id' => $student->id,
                    'periode' => $periode,
                    'jumlah' => $jumlah,
                    'is_angsur' => $is_angsur,
                    'jumlah_angsuran_total' => $jumlah_angsuran_total,
                    'jumlah_angsur' => $jumlah_angsur,
                    'angsuran_terbayar' => $angsuran_terbayar,
                    'tanggal_mulai' => $tanggal_mulai,
                    'tanggal_akhir' => $tanggal_akhir,
                ]);
            }
        }
    }
}
