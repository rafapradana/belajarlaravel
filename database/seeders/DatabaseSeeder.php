<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\siswa;
use App\Models\admin;
use App\Models\guru;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $admin1 = admin::factory()->dataadmin1()->create();
        $admin2 = admin::factory()->dataadmin2()->create();
        
        // Create siswa records with valid admin IDs
        siswa::factory()->count(5)->create(['id' => $admin1->id]);
        siswa::factory()->count(15)->create(['id' => $admin2->id]);
        
        // Create guru records with valid admin IDs
        guru::factory()->count(5)->create(['id' => $admin2->id]);  

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}