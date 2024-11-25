<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    protected $table = 'profil_sekolah';
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            \Log::info('Saving ProfilSekolah:', $model->toArray());
        });

        static::saved(function ($model) {
            \Log::info('ProfilSekolah saved:', $model->toArray());
        });
    }
}
