<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'price',
        'category_id',
        'description',
        'image',
        'release_date',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'release_date' => 'date',
        ];
    }

    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }
}
