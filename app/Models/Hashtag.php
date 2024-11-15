<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    protected $fillable = ['name'];

    public function informasi()
    {
        return $this->belongsToMany(Informasi::class, 'informasi_hashtag');
    }

    public function agenda()
    {
        return $this->belongsToMany(Agenda::class, 'agenda_hashtag');
    }

    public function galery()
    {
        return $this->belongsToMany(Galery::class, 'galery_hashtag');
    }

    public function photo()
    {
        return $this->belongsToMany(Photo::class, 'photo_hashtag');
    }
}
