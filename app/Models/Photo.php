<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'galery_id',
        'user_id',
        'image',
        'judul'
    ];
// Tambahkan relationship ini
public function user()
{
    return $this->belongsTo(User::class);
}
    public function galery()
    {
        return $this->belongsTo(Galery::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Cek apakah foto disukai oleh user tertentu
     */
    public function isLikedBy($user)
    {
        if (!$user) {
            return false;
        }

        return $this->likes()
            ->where('user_id', $user->id)
            ->exists();
    }

    /**
     * Hitung jumlah like
     */
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    /**
     * Hitung jumlah view
     */
    public function getViewsCountAttribute()
    {
        return $this->views()->count();
    }

    /**
     * Hitung jumlah komentar
     */
    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }
    public function getImageAttribute($image)
    {
        return asset('storage/' . $image); // Menyusun URL gambar dengan benar
    }
}
