<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class PurchaseFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'book_id' => \App\Models\Book::factory(),
        ];
    }
}
