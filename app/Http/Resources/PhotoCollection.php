<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PhotoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => PhotoResource::collection($this->collection), // Transform each photo with the PhotoResource
            'total_photos' => $this->collection->count(), // Count of photos in the collection
        ];
    }
}
