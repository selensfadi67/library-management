<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookPurchaseNotification;

class PurchaseController extends Controller
{
    /**
     * Store a newly created purchase.
     */
    public function store(Request $request, string $lang, Book $book)
    {
        if (!Auth::check()) {
            return redirect()->route('customer.login', $lang)
                ->with('error', __('messages.login_required'));
        }

        $user = Auth::user();

        // Check if user already purchased this book
        $existingPurchase = Purchase::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->first();

        if ($existingPurchase) {
            return redirect()->route('books.show', [$lang, $book])
                ->with('error', __('messages.already_purchased'));
        }

        // Check if user has enough balance
        if ($user->balance < $book->price) {
            return redirect()->route('books.show', [$lang, $book])
                ->with('error', __('messages.insufficient_balance'));
        }

        // Deduct balance and create purchase
        $user->decrement('balance', $book->price);
        
        $purchase = Purchase::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
        ]);

        // Send email notification
        try {
            Mail::to($user->email)->send(new BookPurchaseNotification($book, $purchase));
        } catch (\Exception $e) {
            // Log the error but don't fail the purchase
            \Log::error('Failed to send purchase email: ' . $e->getMessage());
        }

        return redirect()->route('books.show', [$lang, $book])
            ->with('success', __('messages.purchase_successful') . ' ' . __('messages.email_sent') ?? 'Email sent with your book!');
    }
}
