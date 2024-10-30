<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model.
     *
     * @var string
     */
    protected $table = 'galery';

    /**
     * Field yang bisa diisi secara massal (mass assignment).
     *
     * @var array
     */
    protected $fillable = [
        'judul',
        'deskripsi',
        'is_map',
        'tanggal',
        'status',
        'kategori_id',
        'users_id',
    ];
   // Model Galery.php
public function photos()
{
    return $this->hasMany(Photo::class);
}

    /**
     * Mendefinisikan relasi dengan model Kategori.
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Mendefinisikan relasi dengan model User (petugas yang mengelola galery).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Accessor untuk format tanggal
     */
    public function getTanggalAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    /**
     * Mutator untuk memastikan `is_map` disimpan sebagai boolean
     */
    public function setIsMapAttribute($value)
    {
        $this->attributes['is_map'] = $value ? true : false;
    }
}
