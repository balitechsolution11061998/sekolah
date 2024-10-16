<?php

namespace App\Jobs;

use App\Models\Guru;
use App\Models\User;
use App\Models\Role;
use App\Models\Student; // Import the Student model
use Illuminate\Support\Facades\Hash;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker; // Import Faker

class CreateUsersForRegionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 1200; // Timeout for the job
    protected $specialEmail = 'sulaksana60@gmail.com'; // Special email for superadministrator
    protected $newAdminEmail = 'adibintang2167@gmail.com'; // New admin email
    protected $newAdminUsername = 'adicita179'; // New admin username
    protected $newAdminPassword = '08129911930'; // New admin password
    protected $batchSize = 1000; // Number of users per batch
    protected $totalUsers; // Total number of users to create
    private $currentYear;

    /**
     * Create a new job instance.
     *
     * @param int $totalUsers
     */
    public function __construct($totalUsers)
    {
        $this->totalUsers = $totalUsers;
        $this->currentYear = date('Y'); // Get the current year
    }
    private function generateIndonesianPhoneNumber(): string
    {
        $phoneNumber = '08' . rand(10000000, 99999999); // Random 10 digits after '08'
        return $phoneNumber; // Return a simple format
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Create a Faker instance
        $faker = Faker::create('id_ID'); // Specify Indonesian locale

        // Fetch the roles 'administrator', 'siswa', and 'guru'
        $roles = ['administrator', 'siswa', 'guru'];
        $roleIds = Role::whereIn('name', $roles)->pluck('id', 'name')->toArray();

        // Fetch available kelas (classes)
        $kelas = DB::table('kelas')->pluck('kode_kelas', 'id')->toArray();

        // NISN counter
        $nisnCounter = 1;

        // Generate users in batches
        for ($batch = 0; $batch < ceil($this->totalUsers / $this->batchSize); $batch++) {
            $usersBatch = [];
            $studentsBatch = []; // To hold students data
            $teachersBatch = []; // To hold teachers data

            for ($i = 1; $i <= $this->batchSize; $i++) {
                $index = ($batch * $this->batchSize) + $i;
                if ($index > $this->totalUsers) {
                    break;
                }

                // Assign special email for the first user
                if ($index === 1) {
                    $email = $this->specialEmail;
                } elseif ($index === 2) {
                    $email = $this->newAdminEmail; // New admin email for the second user
                } else {
                    $email = "user_{$index}@example.com";
                }

                // Generate a random name using Faker
                $fullName = $faker->name; // Generates a random name

                // Prepare user data for batch insert
                if ($email === $this->newAdminEmail) {
                    $plainPassword = $this->newAdminPassword; // Use specified password for new admin
                } elseif ($email === $this->specialEmail) {
                    $plainPassword = 'Superman2000@'; // Password for super administrator
                } else {
                    $plainPassword = 'password'; // Default password
                }

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

                // Check if the user is a 'guru' or 'siswa'
                if ($index > 2) { // Assuming all users after the second are students
                    if ($index % 2 == 0) { // Example condition to assign some users as teachers
                        // Prepare teacher data
                        $nip = str_pad(rand(0, 9999999999999999), 18, '0', STR_PAD_LEFT); // Generate 18-digit NIP
                        $nuptk = str_pad(rand(0, 9999999999999999), 16, '0', STR_PAD_LEFT); // Generate 16-digit NUPTK

                        $teachersBatch[] = [
                            'user_id' => null, // To be filled after user insert
                            'nama_lengkap' => $fullName,
                            'gelar' => 'S.Pd.', // Example title
                            'nip' => $nip,
                            'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                            'tempat_lahir' => $faker->city,
                            'tanggal_lahir' => $faker->dateTimeBetween('-50 years', '-30 years'), // Random birthdate
                            'nuptk' => $nuptk,
                            'alamat' => $faker->address,
                            'avatar' => '/storage/default_avatar.png', // Placeholder avatar
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    } else {
                        // Prepare student data
                        $nisn = $this->currentYear . str_pad($nisnCounter++, 6, '0', STR_PAD_LEFT); // Generate NISN
                        $nik = str_pad(rand(0, 9999999999999999), 16, '0', STR_PAD_LEFT); // Generate 16-digit NIK

                        $tingkatRombel = $kelas[array_rand($kelas)]; // Randomly assign a class
                        $studentsBatch[] = [
                            'nama_lengkap' => $fullName,
                            'nisn' => $nisn,
                            'nik' => $nik,
                            'tempat_lahir' => $faker->city,
                            'tanggal_lahir' => $faker->dateTimeBetween('-20 years', '-10 years'), // Random birthdate
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

            // Insert users in bulk
            DB::transaction(function () use ($usersBatch, $roleIds, $studentsBatch, $teachersBatch) {
                User::insert($usersBatch);

                // Prepare role assignments in bulk
                $roleAssignments = [];
                $userIds = User::whereIn('email', array_column($usersBatch, 'email'))->pluck('id', 'email')->toArray();

                foreach ($usersBatch as $userData) {
                    $userId = $userIds[$userData['email']];
                    $userRole = ($userData['email'] === $this->specialEmail) ? $roleIds['administrator'] :
                                ($userData['email'] === $this->newAdminEmail ? $roleIds['administrator'] : $roleIds[array_rand($roleIds)]);
                    $roleAssignments[] = [
                        'role_id' => $userRole,
                        'user_id' => $userId,
                        'user_type' => 'App\Models\User',
                    ];

                    // If the user is a teacher, store the user_id in teachersBatch
                    if (in_array($userRole, [$roleIds['guru']])) {
                        // Find the last teacher in the batch and assign user_id
                        if (!empty($teachersBatch)) {
                            $teachersBatch[array_key_last($teachersBatch)]['user_id'] = $userId; // Set the user_id for the last teacher
                        }
                    }
                }

                // Insert role assignments in bulk
                DB::table('role_user')->insert($roleAssignments);

                // Insert students and teachers in bulk if any
                if (!empty($studentsBatch)) {
                    Student::insert($studentsBatch);
                }

                if (!empty($teachersBatch)) {
                    Guru::insert($teachersBatch);
                }
            });

            // Log batch progress
            \Log::info("Batch {$batch} of " . ceil($this->totalUsers / $this->batchSize) . " completed. Users created: " . count($usersBatch));
        }
    }
}
