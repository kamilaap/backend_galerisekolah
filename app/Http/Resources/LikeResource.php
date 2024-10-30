<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
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
            'photo' => $this->photo->judul ?? 'Tidak ada foto',
            'user' => $this->user->name ?? 'Tidak ada user',
            'created_at' => $this->created_at->format('d/m/Y'),
        ];
    }
}
