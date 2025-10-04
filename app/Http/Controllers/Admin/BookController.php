<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $lang)
    {
        $books = Book::with('category')->paginate(request('per_page', 10));
        return view('admin.books.index', compact('books', 'lang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $lang)
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories', 'lang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $lang)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'release_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'author', 'price', 'category_id', 'description', 'release_date']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('books', 'public');
        }

        Book::create($data);

        return redirect()->route('admin.books.index', $lang)
            ->with('success', __('messages.book_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $lang, Book $book)
    {
        $book->load('category', 'purchases.user');
        return view('admin.books.show', compact('book', 'lang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $lang, Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories', 'lang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $lang, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'release_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'author', 'price', 'category_id', 'description', 'release_date']);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $data['image'] = $request->file('image')->store('books', 'public');
        }

        $book->update($data);

        return redirect()->route('admin.books.index', $lang)
            ->with('success', __('messages.book_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $lang, Book $book)
    {
        // Delete image if exists
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()->route('admin.books.index', $lang)
            ->with('success', __('messages.book_deleted'));
    }
}
