<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'price' => 12.99,
                'category_id' => Category::where('name', 'Fiction')->first()->id,
                'description' => 'A classic American novel set in the Jazz Age, exploring themes of wealth, love, and the American Dream.',
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'price' => 14.99,
                'category_id' => Category::where('name', 'Fiction')->first()->id,
                'description' => 'A powerful story of racial injustice and childhood innocence in the American South.',
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'price' => 13.99,
                'category_id' => Category::where('name', 'Science Fiction')->first()->id,
                'description' => 'A dystopian social science fiction novel about totalitarian control and surveillance.',
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'price' => 11.99,
                'category_id' => Category::where('name', 'Romance')->first()->id,
                'description' => 'A romantic novel of manners that critiques the British landed gentry.',
            ],
            [
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'price' => 12.99,
                'category_id' => Category::where('name', 'Fiction')->first()->id,
                'description' => 'A coming-of-age story about teenage rebellion and alienation.',
            ],
            [
                'title' => 'The Da Vinci Code',
                'author' => 'Dan Brown',
                'price' => 15.99,
                'category_id' => Category::where('name', 'Mystery')->first()->id,
                'description' => 'A mystery thriller involving secret societies and religious conspiracies.',
            ],
            [
                'title' => 'Steve Jobs',
                'author' => 'Walter Isaacson',
                'price' => 16.99,
                'category_id' => Category::where('name', 'Biography')->first()->id,
                'description' => 'The exclusive biography of Apple co-founder Steve Jobs.',
            ],
            [
                'title' => 'Sapiens',
                'author' => 'Yuval Noah Harari',
                'price' => 17.99,
                'category_id' => Category::where('name', 'History')->first()->id,
                'description' => 'A brief history of humankind from the Stone Age to the present.',
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'price' => 14.99,
                'category_id' => Category::where('name', 'Self-Help')->first()->id,
                'description' => 'An easy and proven way to build good habits and break bad ones.',
            ],
            [
                'title' => 'The Lean Startup',
                'author' => 'Eric Ries',
                'price' => 15.99,
                'category_id' => Category::where('name', 'Business')->first()->id,
                'description' => 'A methodology for developing businesses and products through validated learning.',
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'price' => 18.99,
                'category_id' => Category::where('name', 'Technology')->first()->id,
                'description' => 'A handbook of agile software craftsmanship.',
            ],
            [
                'title' => 'The 7 Habits of Highly Effective People',
                'author' => 'Stephen R. Covey',
                'price' => 16.99,
                'category_id' => Category::where('name', 'Self-Help')->first()->id,
                'description' => 'A business and self-help book offering principles for personal effectiveness.',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
