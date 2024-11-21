<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusan extends Model
{
    use HasFactory;
    protected $table = 'jurusan'; // Pastikan ini sesuai dengan nama tabel

    protected $fillable = ['nama', 'deskripsi'];

    public function galery()
    {
        return $this->hasOne(Galery::class); // Jika satu jurusan memiliki satu galeri
    }


    public function photos()
{
    return $this->hasMany(Jurusan::class, 'galery_id', 'id'); // Adjust the foreign key and local key as necessary
}
}
