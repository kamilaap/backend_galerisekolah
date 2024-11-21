<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $table = 'informasi'; // Nama tabel

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'kategori_id',
        'status',
        'users_id', // Menambahkan users_id ke fillable
        'image',
    ];

    protected $casts = [
        'tanggal' => 'date:Y-m-d', // Mengatur format tanggal
    ];

    /**
     * Accessor untuk mendapatkan URL lengkap dari gambar
     */
    public function getImageAttribute($image)
    {
        return asset('storage/' . $image); // Menyusun URL gambar dengan benar
    }

    /**
     * Mutator: Lowercase status before saving.
     */
    public function setStatusAttribute($value)

    {
        $this->attributes['status'] = strtolower($value);
    }

    /**
     * Accessor: Capitalize judul when retrieving.
     */
    public function getJudulInfoAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Relasi: Informasi belongs to a kategori and a user.
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id'); // Mengubah 'created_by' menjadi 'users_id' sesuai field yang ada
    }

}
