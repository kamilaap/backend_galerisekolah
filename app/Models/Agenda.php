<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
     * Casting untuk tanggal
     *
     * @var array
     */
    protected $dates = [
        'tanggal',
        'created_at',
        'updated_at'
    ];

    /**
     * Casting untuk format atribut.
     *
     * @var array
     */
    protected $casts = [
        'tanggal' => 'datetime:Y-m-d',
        'tanggal_post_agenda' => 'datetime:Y-m-d',
        'status' => 'boolean'
    ];

    /**
     * Relasi: Agenda belongs to a kategori and a user.
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
     * Mutator untuk memastikan tanggal selalu dalam format Carbon.
     *
     * @param string $value
     */
    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * Accessor untuk mendapatkan tanggal dalam format Carbon.
     *
     * @param string $value
     * @return \Carbon\Carbon
     */
    public function getTanggalAttribute($value)
    {
        return Carbon::parse($value);
    }

    /**
     * Accessor untuk format tanggal post agenda.
     *
     * @param string $value
     * @return string
     */
    public function getTanggalPostAgendaAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
}
