<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use App\Models\Photo;
use App\Models\Like;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    public function show($id)
    {
        $photo = Photo::with(['comments.user', 'comments.replies.user'])->findOrFail($id);
        return view('web.galery.photo', compact('photo'));
    }

    public function like(Photo $photo)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please login to like photos',
                'redirect' => route('login')
            ], 401);
        }

        $user = Auth::user();
        $existingLike = $photo->likes()->where('user_id', $user->id)->first();

        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            $photo->likes()->create([
                'user_id' => $user->id
            ]);
            $liked = true;
        }

        return response()->json([
            'status' => 'success',
            'liked' => $liked,
            'likes_count' => $photo->likes()->count()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'galery_id' => 'required|exists:galery,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'judul' => 'required|string|max:255',
        ]);

        $image = $request->file('image');
        $imagePath = $image->store('images/photos', 'public');

        Photo::create([
            'galery_id' => $request->galery_id,
            'user_id' => auth()->id(),  // Tambahkan user_id dari user yang sedang login
            'image' => $imagePath,
            'judul' => $request->judul,
        ]);

        return redirect()->back()
            ->with('success', 'Foto berhasil ditambahkan');
    }
}
