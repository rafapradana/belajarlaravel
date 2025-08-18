<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\siswa;
use App\Models\admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        admin::factory()->dataadmin1()->create();
        admin::factory()->dataadmin2()->create();
        siswa::factory()->count(5)->create(); 

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}