<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'id' => $this->id, // ID unik dari komentar
            'comment' => $this->comment, // Isi teks komentar
            'photo' => $this->photo->judul ?? 'Tidak ada foto', // Judul foto terkait atau pesan alternatif jika kosong
            'user' => $this->user->name ?? 'Tidak ada user', // Nama user yang memberi komentar atau pesan alternatif jika kosong
            'created_at' => $this->created_at->format('d/m/Y H:i'), // Format tanggal dan waktu saat komentar dibuat
        ];
    }
}
