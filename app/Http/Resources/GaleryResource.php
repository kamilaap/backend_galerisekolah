<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GaleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'tanggal' => $this->tanggal,
            'status' => $this->status,
            'kategori' => $this->kategori->judul ?? 'Tidak ada kategori',
            'user' => $this->user->name ?? 'Tidak ada user',
            'photo_count' => $this->photos->count(),// Menambahkan pengecekan null
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
