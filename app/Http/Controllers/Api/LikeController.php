<?php

namespace App\Http\Controllers\Api;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LikeResource;

class LikeController extends Controller
{
    public function index()
    {
        $likes = Like::with('photo', 'user')->get();
    return LikeResource::collection($likes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo_id' => 'required|exists:photos,id',
        ]);

        $like = Like::create([
            'photo_id' => $request->photo_id,
            'user_id' => auth()->id(),
        ]);

        return response()->json(['message' => 'Like berhasil ditambahkan!', 'data' => $like]);
    }

    public function destroy($id)
    {
        $like = Like::findOrFail($id);
        $like->delete();

        return response()->json(['message' => 'Like berhasil dihapus!']);
    }

    // Get likes for a specific photo
    public function getPhotoLikes($photoId)
    {
        $likes = Like::with('user')
            ->where('photo_id', $photoId)
            ->get();

        return response()->json([
            'status' => true,
            'data' => $likes->map(function($like) {
                return [
                    'id' => $like->id,
                    'user_name' => $like->user->name,
                    'created_at' => $like->created_at->format('d/m/Y')
                ];
            }),
            'total_likes' => $likes->count()
        ]);
    }

    // Toggle like for a specific photo
    public function toggleLike($photoId)
    {
        $userId = auth()->id();
        $existing = Like::where('photo_id', $photoId)
            ->where('user_id', $userId)
            ->first();

        if ($existing) {
            $existing->delete();
            $message = 'Photo unliked successfully';
            $isLiked = false;
        } else {
            Like::create([
                'photo_id' => $photoId,
                'user_id' => $userId
            ]);
            $message = 'Photo liked successfully';
            $isLiked = true;
        }

        $totalLikes = Like::where('photo_id', $photoId)->count();

        return response()->json([
            'status' => true,
            'message' => $message,
            'is_liked' => $isLiked,
            'total_likes' => $totalLikes
        ]);
    }
}
