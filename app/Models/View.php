<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = [
        'photo_id',
        'ip_address',
        'user_agent'
    ];

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}
