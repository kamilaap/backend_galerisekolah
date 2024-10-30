<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Agenda extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model.
     *
     * @var string
     */
    protected $table = 'agenda';

    /**
     * Field yang bisa diisi secara massal (mass assignment).
     *
     * @var array
     */
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'tanggal_post_agenda',
        'status',
        'kategori_id',
        'users_id',
    ];
 /**
     * Relasi: Informasi belongs to a kategori and a user.
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Mendefinisikan relasi dengan model User (petugas yang mengelola agenda).
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
     * Accessor untuk format tanggal post agenda
     */
    public function getTanggalPostAgendaAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
}
