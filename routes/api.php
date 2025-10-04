<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BooksController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Books API Routes
Route::prefix('books')->group(function () {
    Route::get('/', [BooksController::class, 'index']); // GET /api/books
    Route::post('/', [BooksController::class, 'store']); // POST /api/books
    Route::get('/latest', [BooksController::class, 'latest']); // GET /api/books/latest
    Route::get('/top-purchased', [BooksController::class, 'topPurchased']); // GET /api/books/top-purchased
    Route::get('/category/{categoryId}', [BooksController::class, 'byCategory']); // GET /api/books/category/{id}
    Route::get('/{id}', [BooksController::class, 'show']); // GET /api/books/{id}
    Route::put('/{id}', [BooksController::class, 'update']); // PUT /api/books/{id}
    Route::delete('/{id}', [BooksController::class, 'destroy']); // DELETE /api/books/{id}
});
