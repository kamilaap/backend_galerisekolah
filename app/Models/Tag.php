<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function informasi()
    {
        return $this->morphedByMany(Informasi::class, 'taggable');
    }

    public function agenda()
    {
        return $this->morphedByMany(Agenda::class, 'taggable');
    }

    public function galeries()
    {
        return $this->morphedByMany(Galery::class, 'taggable');
    }

    public function photos()
    {
        return $this->morphedByMany(Photo::class, 'taggable');
    }
}
