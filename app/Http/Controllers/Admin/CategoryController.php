<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index(string $lang)
    {
        $categories = Category::withCount('books')->paginate(request('per_page', 10));
        return view('admin.categories.index', compact('categories', 'lang'));
    }

    
    public function create(string $lang)
    {
        return view('admin.categories.create', compact('lang'));
    }

    public function store(Request $request, string $lang)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($request->only('name'));

        return redirect()->route('admin.categories.index', $lang)
            ->with('success', __('messages.category_created'));
    }

    public function show(string $lang, Category $category)
    {
        $category->load('books');
        return view('admin.categories.show', compact('category', 'lang'));
    }

    public function edit(string $lang, Category $category)
    {
        return view('admin.categories.edit', compact('category', 'lang'));
    }

    public function update(Request $request, string $lang, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($request->only('name'));

        return redirect()->route('admin.categories.index', $lang)
            ->with('success', __('messages.category_updated'));
    }

   
    public function destroy(string $lang, Category $category)
    {
        if ($category->books()->count() > 0) {
            return redirect()->route('admin.categories.index', $lang)
                ->with('error', __('messages.category_has_books'));
        }

        $category->delete();

        return redirect()->route('admin.categories.index', $lang)
            ->with('success', __('messages.category_deleted'));
    }
}
