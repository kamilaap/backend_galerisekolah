<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Tabel yang digunakan
    protected $table = 'kategori';

    // Kolom yang dapat diisi
    protected $fillable = ['judul', 'deskripsi'];

    // Casting tipe data untuk atribut
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    /**
     * Mutator: Set judul to be capitalized before saving to the database.
     */
    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = ucfirst($value);
    }

    /**
     * Mutator: Set deskripsi to always be stored as lowercase.
     */
    public function setDeskripsiAttribute($value)
    {
        $this->attributes['deskripsi'] = strtolower($value);
    }

    /**
     * Accessor: Get judul in uppercase format when retrieving from the database.
     */
    public function getJudulAttribute($value)
    {
        return strtoupper($value);
    }

    /**
     * Relasi: Kategori memiliki banyak agenda, galeri, dan informasi.
     */
    public function agenda()
    {
        return $this->hasMany(Agenda::class, 'kategori_id');
    }

    public function galery()
    {
        return $this->hasMany(Galery::class, 'kategori_id'); // Ensure this matches your actual model name
    }

    public function informasi()
    {
        return $this->hasMany(Informasi::class, 'kategori_id');
    }
}
