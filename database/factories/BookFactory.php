<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class BookFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'price' => fake()->randomFloat(2, 10, 100),
            'category_id' => \App\Models\Category::factory(),
            'description' => fake()->paragraph(3),
            'image' => fake()->imageUrl(400, 600, 'books'),
        ];
    }
}
