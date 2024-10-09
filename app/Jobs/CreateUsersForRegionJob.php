<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CreateUsersForRegionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 1200; // Timeout for the job
    protected $specialEmail = 'sulaksana60@gmail.com'; // Special email for superadministrator
    protected $batchSize = 1000; // Number of users per batch
    protected $totalUsers; // Total number of users to create

    /**
     * Create a new job instance.
     *
     * @param int $totalUsers
     */
    public function __construct($totalUsers)
    {
        $this->totalUsers = $totalUsers;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Fetch the roles 'administrator', 'siswa', and 'guru'
        $roles = ['administrator', 'siswa', 'guru'];
        $roleIds = Role::whereIn('name', $roles)->pluck('id', 'name')->toArray();

        // Expanded list of Indonesian names
        $indonesianFirstNames = [
            'Ahmad', 'Budi', 'Citra', 'Dewi', 'Eka', 'Fajar', 'Gita', 'Hadi', 'Ika', 'Joko',
            // Add more names as needed
        ];

        $indonesianLastNames = [
            'Pratama', 'Sari', 'Putra', 'Wijaya', 'Halim', 'Susanto', 'Sutrisno', 'Santoso',
            // Add more names as needed
        ];

        // Generate users in batches
        for ($batch = 0; $batch < ceil($this->totalUsers / $this->batchSize); $batch++) {
            $usersBatch = [];
            for ($i = 1; $i <= $this->batchSize; $i++) {
                $index = ($batch * $this->batchSize) + $i;
                if ($index > $this->totalUsers) {
                    break;
                }

                // Assign special email for the first user
                $email = ($index === 1) ? $this->specialEmail : "user_{$index}@example.com";

                // Randomly select Indonesian names
                $firstName = $indonesianFirstNames[array_rand($indonesianFirstNames)];
                $lastName = $indonesianLastNames[array_rand($indonesianLastNames)];
                $fullName = "$firstName $lastName";

                // Prepare user data for batch insert
                $plainPassword = ($email === $this->specialEmail) ? 'Superman2000@' : 'password';
                $usersBatch[] = [
                    'name' => $fullName,
                    'username' => strtolower($firstName) . $index,
                    'profile_picture' => '/storage/logo.png',
                    'email' => $email,
                    'password' => Hash::make($plainPassword),
                    'password_show' => $plainPassword,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Insert users in bulk
            DB::transaction(function () use ($usersBatch, $roleIds) {
                User::insert($usersBatch);

                // Prepare role assignments in bulk
                $roleAssignments = [];
                $userIds = User::whereIn('email', array_column($usersBatch, 'email'))->pluck('id', 'email')->toArray();

                foreach ($usersBatch as $userData) {
                    $userId = $userIds[$userData['email']];
                    $userRole = ($userData['email'] === $this->specialEmail) ? $roleIds['administrator'] : $roleIds[array_rand($roleIds)];
                    $roleAssignments[] = [
                        'role_id' => $userRole,
                        'user_id' => $userId,
                        'user_type' => 'App\Models\User',
                    ];
                }

                // Insert role assignments in bulk
                DB::table('role_user')->insert($roleAssignments);
            });

            // Log batch progress
            \Log::info("Batch $batch of users created.");
        }
    }
}
