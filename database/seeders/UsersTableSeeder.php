<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Jobs\CreateUsersForRegionJob;
use App\Models\Region;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {

        CreateUsersForRegionJob::dispatch(300);

        $this->command->info('User creation jobs have been dispatched to the queue.');
    }
}
