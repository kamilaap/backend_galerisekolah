<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    // Tambahkan relasi likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Helper method untuk cek like
    public function hasLiked($photo)
    {
        return $this->likes()->where('photo_id', $photo->id)->exists();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getAvatarAttribute($value)
    {
        if (!$value) {
            return null;
        }

        return Storage::url($value);
    }
}
