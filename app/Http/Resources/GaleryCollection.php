<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GaleryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection ?? [], // Pastikan collection tidak null
            'total_photo' => $this->collection ? $this->collection->count() : 0, // Pastikan collection tidak null
        ];
    }
}
