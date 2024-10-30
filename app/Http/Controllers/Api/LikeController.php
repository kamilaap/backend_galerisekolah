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
}
