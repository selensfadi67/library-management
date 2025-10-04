<?php

namespace Database\Seeders;

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
        // Create admin user if it doesn't exist
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'is_admin' => true,
                'password' => bcrypt('password'),
            ]
        );

        // Create regular users
        User::factory(5)->create();

        // Seed categories first
        $this->call(CategorySeeder::class);
        
        // Then seed books
        $this->call(BookSeeder::class);
    }
}
