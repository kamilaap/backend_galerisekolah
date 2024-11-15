<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    protected $table = 'galery';

    protected $fillable = [
        'judul',
        'deskripsi',
        'is_map',
        'tanggal',
        'status',
        'kategori_id',
        'users_id'
    ];

    protected $casts = [
        'is_map' => 'boolean',
        'tanggal' => 'date'
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class, 'galery_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class, 'galery_hashtag');
    }
}
