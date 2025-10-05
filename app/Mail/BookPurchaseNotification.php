<?php

namespace App\Mail;

use App\Models\Book;
use App\Models\Purchase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookPurchaseNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $book;
    public $purchase;
    public $user;

    public function __construct(Book $book, Purchase $purchase)
    {
        $this->book = $book;
        $this->purchase = $purchase;
        $this->user = $purchase->user;
    }

  
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Book Purchase Confirmation - ' . $this->book->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.book-purchase',
            with: [
                'book' => $this->book,
                'purchase' => $this->purchase,
                'user' => $this->user,
            ]
        );
    }

   
    public function attachments(): array
    {
        return [];
    }
}