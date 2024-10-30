<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model.
     *
     * @var string
     */
    protected $table = 'photos';

    /**
     * Field yang bisa diisi secara massal (mass assignment).
     *
     * @var array
     */
    protected $fillable = [
        'galery_id',
        'image',
        'judul',
        'user_id',
    ];

    /**
     * Relasi: Photo belongs to Galery.
     */
    public function galery()
    {
        return $this->belongsTo(Galery::class);
    }

    /**
     * Relasi: Photo belongs to User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Photo has many Likes.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Relasi: Photo has many Comments.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Accessor: Mendapatkan URL gambar.
     */
    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
