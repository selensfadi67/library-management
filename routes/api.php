<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BooksController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('books')->group(function () {
    Route::get('/', [BooksController::class, 'index']); 
    Route::post('/', [BooksController::class, 'store']); 
    Route::get('/latest', [BooksController::class, 'latest']);
    Route::get('/top-purchased', [BooksController::class, 'topPurchased']); 
    Route::get('/category/{categoryId}', [BooksController::class, 'byCategory']);
    Route::get('/{id}', [BooksController::class, 'show']); 
    Route::put('/{id}', [BooksController::class, 'update']); 
    Route::delete('/{id}', [BooksController::class, 'destroy']); 
});
