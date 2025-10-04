<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Purchase Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .book-info {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .book-cover {
            width: 100px;
            height: 130px;
            background: #e0e0e0;
            border-radius: 5px;
            display: inline-block;
            margin-right: 20px;
            vertical-align: top;
        }
        .book-details {
            display: inline-block;
            width: calc(100% - 130px);
        }
        .price {
            color: #28a745;
            font-size: 24px;
            font-weight: bold;
        }
        .download-section {
            background: #e8f5e8;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
        }
        .download-btn {
            background: #28a745;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📚 Book Purchase Confirmed!</h1>
        <p>Thank you for your purchase, {{ $user->name }}!</p>
    </div>

    <div class="content">
        <h2>Purchase Details</h2>
        
        <div class="book-info">
            <div class="book-cover">
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;">
                @else
                    <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #999;">
                        📖
                    </div>
                @endif
            </div>
            <div class="book-details">
                <h3>{{ $book->title }}</h3>
                <p><strong>Author:</strong> {{ $book->author }}</p>
                <p><strong>Category:</strong> {{ $book->category->name }}</p>
                <p><strong>Price:</strong> <span class="price">${{ number_format($book->price, 2) }}</span></p>
                @if($book->release_date)
                    <p><strong>Release Date:</strong> {{ $book->release_date->format('M d, Y') }}</p>
                @endif
            </div>
        </div>

        <div class="download-section">
            <h3>📥 Download Your Book</h3>
            <p>Your electronic copy is ready for download!</p>
            <a href="#" class="download-btn">Download Book (PDF)</a>
            <p style="margin-top: 10px; font-size: 14px; color: #666;">
                <em>Note: This is a demo. In a real application, this would link to the actual book file.</em>
            </p>
        </div>

        <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <h3>Purchase Information</h3>
            <p><strong>Purchase ID:</strong> #{{ $purchase->id }}</p>
            <p><strong>Purchase Date:</strong> {{ $purchase->created_at->format('M d, Y H:i') }}</p>
            <p><strong>Your Remaining Balance:</strong> ${{ number_format($user->balance, 2) }}</p>
        </div>

        <div style="background: #fff3cd; padding: 15px; border-radius: 8px; border-left: 4px solid #ffc107;">
            <h4>📖 Book Description</h4>
            <p>{{ $book->description }}</p>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <p>Enjoy reading your new book!</p>
            <p>If you have any questions, please don't hesitate to contact our support team.</p>
        </div>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        <p>This is an automated message, please do not reply to this email.</p>
    </div>
</body>
</html>
