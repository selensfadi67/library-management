<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    
    public function index(string $lang)
    {
        $query = Book::with('category');
      
        if (request()->has('search') && request()->search) {
            $searchTerm = request()->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('author', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhereHas('category', function($categoryQuery) use ($searchTerm) {
                      $categoryQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }
        
        if (request()->has('category') && request()->category) {
            $query->where('category_id', request()->category);
        }
      
        if (request()->has('min_price') && request()->min_price) {
            $query->where('price', '>=', request()->min_price);
        }
        
        if (request()->has('max_price') && request()->max_price) {
            $query->where('price', '<=', request()->max_price);
        }
     
        $sortBy = request()->get('sort', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            case 'author':
                $query->orderBy('author', 'asc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }
        
        $books = $query->paginate(12);
        $categories = Category::withCount('books')->get();
        
        return view('books.index', compact('books', 'categories', 'lang'));
    }

   
    public function show(string $lang, Book $book)
    {
        $book->load('category');
        $relatedBooks = Book::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->limit(4)
            ->get();
            
        return view('books.show', compact('book', 'relatedBooks', 'lang'));
    }
}
