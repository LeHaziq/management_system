<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        User::create([
            'name' => 'admin',
            'email' => 'admin@mysoft.care',
            'password' => '1234', // password
        ])->assignRole('admin');

        Project::factory()->count(20)->create();
    }
}
