<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KategoriResource extends JsonResource
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
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
            // Tampilkan jumlah agenda, galeri, dan informasi yang terkait
            'jumlah_agenda' => $this->agenda->count(),
            'jumlah_galery' => $this->galery->count(),
            'jumlah_informasi' => $this->informasi->count(),
        ];
    }
}
