<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
   
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiction'],
            ['name' => 'Non-Fiction'],
            ['name' => 'Science Fiction'],
            ['name' => 'Mystery'],
            ['name' => 'Romance'],
            ['name' => 'Thriller'],
            ['name' => 'Biography'],
            ['name' => 'History'],
            ['name' => 'Self-Help'],
            ['name' => 'Business'],
            ['name' => 'Technology'],
            ['name' => 'Health & Fitness'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
