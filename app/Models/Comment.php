<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_id',
        'user_id',
        'comment',
    ];

    /**
     * Relasi: Comment belongs to Photo.
     */
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    /**
     * Relasi: Comment belongs to User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
