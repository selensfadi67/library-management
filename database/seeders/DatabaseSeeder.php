<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   
    public function run(): void
    {
       
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'is_admin' => true,
                'password' => bcrypt('password'),
            ]
        );

       
        User::factory(5)->create();

     
        $this->call(CategorySeeder::class);
        
    
        $this->call(BookSeeder::class);
    }
}
