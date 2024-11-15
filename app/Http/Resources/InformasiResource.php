<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InformasiResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'tanggal' => $this->tanggal,
            'status' => $this->status,
            'image' => $this->image,
            'kategori' => [
                'id' => $this->kategori->id,
                'judul' => $this->kategori->judul,
            ],
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
