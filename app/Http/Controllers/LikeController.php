<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike(Photo $photo)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first'
            ]);
        }

        $like = $photo->likes()->where('user_id', auth()->id())->first();

        if ($like) {
            $like->delete();
            $isLiked = false;
        } else {
            $photo->likes()->create([
                'user_id' => auth()->id()
            ]);
            $isLiked = true;
        }

        return response()->json([
            'success' => true,
            'liked' => $isLiked,
            'likes_count' => $photo->likes()->count()
        ]);
    }
}
