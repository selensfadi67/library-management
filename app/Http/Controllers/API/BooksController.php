<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Book::with('category');
            
            if ($request->has('search') && $request->search) {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('title', 'like', "%{$searchTerm}%")
                      ->orWhere('author', 'like', "%{$searchTerm}%")
                      ->orWhere('description', 'like', "%{$searchTerm}%")
                      ->orWhereHas('category', function($categoryQuery) use ($searchTerm) {
                          $categoryQuery->where('name', 'like', "%{$searchTerm}%");
                      });
                });
            }
            
          
            if ($request->has('category_id') && $request->category_id) {
                $query->where('category_id', $request->category_id);
            }
        
            if ($request->has('min_price') && $request->min_price) {
                $query->where('price', '>=', $request->min_price);
            }
            
            if ($request->has('max_price') && $request->max_price) {
                $query->where('price', '<=', $request->max_price);
            }
         
            $sortBy = $request->get('sort', 'latest');
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
            
            $perPage = $request->get('per_page', 15);
            $books = $query->paginate($perPage);
            
            return response()->json([
                'success' => true,
                'message' => 'Books retrieved successfully',
                'data' => $books
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving books',
                'error' => $e->getMessage()
            ], 500);
        }
    }

   
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'description' => 'required|string',
                'release_date' => 'nullable|date',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $request->only(['title', 'author', 'price', 'category_id', 'description', 'release_date']);

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('books', 'public');
            }

            $book = Book::create($data);
            $book->load('category');

            return response()->json([
                'success' => true,
                'message' => 'Book created successfully',
                'data' => $book
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating book',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $book = Book::with('category', 'purchases.user')->find($id);
            
            if (!$book) {
                return response()->json([
                    'success' => false,
                    'message' => 'Book not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Book retrieved successfully',
                'data' => $book
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving book',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $book = Book::find($id);
            
            if (!$book) {
                return response()->json([
                    'success' => false,
                    'message' => 'Book not found'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'description' => 'required|string',
                'release_date' => 'nullable|date',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $request->only(['title', 'author', 'price', 'category_id', 'description', 'release_date']);

            if ($request->hasFile('image')) {
              
                if ($book->image) {
                    Storage::disk('public')->delete($book->image);
                }
                $data['image'] = $request->file('image')->store('books', 'public');
            }

            $book->update($data);
            $book->load('category');

            return response()->json([
                'success' => true,
                'message' => 'Book updated successfully',
                'data' => $book
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating book',
                'error' => $e->getMessage()
            ], 500);
        }
    }

   
    public function destroy(string $id)
    {
        try {
            $book = Book::find($id);
            
            if (!$book) {
                return response()->json([
                    'success' => false,
                    'message' => 'Book not found'
                ], 404);
            }

            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }

            $book->delete();

            return response()->json([
                'success' => true,
                'message' => 'Book deleted successfully'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting book',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function latest(Request $request)
    {
        try {
            $limit = $request->get('limit', 4);
            $books = Book::with('category')
                ->latest()
                ->limit($limit)
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Latest books retrieved successfully',
                'data' => $books
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving latest books',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function topPurchased(Request $request)
    {
        try {
            $limit = $request->get('limit', 4);
            $books = Book::with('category')
                ->withCount('purchases')
                ->orderBy('purchases_count', 'desc')
                ->limit($limit)
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Top purchased books retrieved successfully',
                'data' => $books
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving top purchased books',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function byCategory(Request $request, $categoryId)
    {
        try {
            $category = Category::find($categoryId);
            
            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found'
                ], 404);
            }

            $perPage = $request->get('per_page', 15);
            $books = Book::with('category')
                ->where('category_id', $categoryId)
                ->paginate($perPage);

            return response()->json([
                'success' => true,
                'message' => 'Books by category retrieved successfully',
                'data' => $books,
                'category' => $category
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving books by category',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}