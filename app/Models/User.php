<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
 
    use HasFactory, Notifiable, HasApiTokens;

    
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'balance',
    ];

   
    protected $hidden = [
        'password',
        'remember_token',
    ];

   
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'balance' => 'decimal:2',
    ];

    public function isAdmin(): bool
    {
        return $this->is_admin ?? false;
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }
}
