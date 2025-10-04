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

    /**
     * Create a new message instance.
     */
    public function __construct(Book $book, Purchase $purchase)
    {
        $this->book = $book;
        $this->purchase = $purchase;
        $this->user = $purchase->user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Book Purchase Confirmation - ' . $this->book->title,
        );
    }

    /**
     * Get the message content definition.
     */
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

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}