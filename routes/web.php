<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PurchaseController;

Route::redirect('/', '/en');

// Route::get('/login', function () {
//     return redirect('/en/admin/login');
// })->name('login');


Route::prefix('{lang}')->group(function () {

    // 🏠 Public Routes
            Route::get('/', function () {
                $latestBooks = \App\Models\Book::with('category')->latest()->limit(4)->get();
                $topPurchasedBooks = \App\Models\Book::with('category')
                    ->withCount('purchases')
                    ->orderBy('purchases_count', 'desc')
                    ->limit(4)
                    ->get();
                return view('home', compact('latestBooks', 'topPurchasedBooks'));
            })->name('home');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    // 📚 Public Book Routes
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

            // 🔐 Customer Authentication Routes
            Route::prefix('customer')->group(function () {
                Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
                Route::post('/login', [CustomerAuthController::class, 'login'])->name('customer.login.post');
                Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register');
                Route::post('/register', [CustomerAuthController::class, 'register'])->name('customer.register.post');
                Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
            });

            // 🛒 Purchase Routes (require customer authentication)
            Route::middleware('auth.custom')->group(function () {
                Route::post('/books/{book}/purchase', [PurchaseController::class, 'store'])->name('purchase.store');
            });

    // 🧑‍💼 Admin Authentication Routes
    Route::prefix('admin')->group(function () {
        // Login routes (accessible without authentication)
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');

        // Protected admin routes
        Route::middleware(['auth.custom', 'admin'])->group(function () {
            Route::get('/', function () {
                $stats = [
                    'books_count' => \App\Models\Book::count(),
                    'categories_count' => \App\Models\Category::count(),
                    'users_count' => \App\Models\User::where('is_admin', false)->count(),
                    'purchases_count' => \App\Models\Purchase::count(),
                ];
                return view('admin.dashboard', compact('stats'));
            })->name('admin.dashboard');

            // Admin User Management
            Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
            Route::get('/users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
            Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');
            Route::get('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.users.show');
            Route::get('/users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
            Route::put('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
            Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');

            Route::get('/purchases', function () {
                $purchases = \App\Models\Purchase::with(['user', 'book.category'])->latest()->paginate(request('per_page', 10));
                return view('admin.purchases', compact('purchases'));
            })->name('admin.purchases');

            // Admin Book Management
            Route::get('/books', [AdminBookController::class, 'index'])->name('admin.books.index');
            Route::get('/books/create', [AdminBookController::class, 'create'])->name('admin.books.create');
            Route::post('/books', [AdminBookController::class, 'store'])->name('admin.books.store');
            Route::get('/books/{book}', [AdminBookController::class, 'show'])->name('admin.books.show');
            Route::get('/books/{book}/edit', [AdminBookController::class, 'edit'])->name('admin.books.edit');
            Route::put('/books/{book}', [AdminBookController::class, 'update'])->name('admin.books.update');
            Route::delete('/books/{book}', [AdminBookController::class, 'destroy'])->name('admin.books.destroy');

            // Admin Category Management
            Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
            Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
            Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
            Route::get('/categories/{category}', [AdminCategoryController::class, 'show'])->name('admin.categories.show');
            Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
            Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
            Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');

            Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
        });
    });
});


