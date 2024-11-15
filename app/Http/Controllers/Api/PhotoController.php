<?php
namespace App\Http\Controllers\Api;

use App\Models\Photo;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    // Get all photos
    public function index(Request $request)
    {
        try {
            $query = Photo::query();

            if ($request->has('galery_id')) {
                $query->where('galery_id', $request->galery_id);
            }

            $photos = $query->get()->map(function($photo) {
                return [
                    'id' => $photo->id,
                    'judul' => $photo->judul,
                    'image' => $photo->image,  // Pastikan ini hanya path file, tanpa URL lengkap
                    'galery_id' => $photo->galery_id,
                    'created_at' => $photo->created_at
                ];
            });

            return response()->json($photos);
        } catch (\Exception $e) {
            \Log::error('Photo error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Store a new photo
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'judul' => 'required|string|max:255',
            'galery_id' => 'required|exists:galeries,id'
        ]);

        $photo = Photo::create([
            'image' => $request->file('image')->store('photos', 'public'),
            'judul' => $request->judul,
            'user_id' => Auth::id(),
            'galery_id' => $request->galery_id,
        ]);

        return response()->json($photo, 201);
    }

    // Show a single photo
    public function show($id)
    {
        try {
            $photo = Photo::with(['user', 'comments.user', 'likes.user'])->findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $photo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Update a photo
    public function update(Request $request, $id)
    {
        $photo = Photo::findOrFail($id);

        $request->validate([
            'image' => 'image|nullable',
            'judul' => 'string|max:255|nullable',
        ]);

        if ($request->hasFile('image')) {
            $photo->image = $request->file('image')->store('photos', 'public');
        }
        if ($request->has('judul')) {
            $photo->judul = $request->judul;
        }

        $photo->save();
        return response()->json($photo);
    }

    // Delete a photo
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();

        return response()->json(null, 204);
    }

    // Store a comment on a photo
    public function storeComment(Request $request, $photoId)
    {
        $request->validate(['comment' => 'required|string']);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'photo_id' => $photoId,
            'comment' => $request->comment,
        ]);

        return response()->json($comment, 201);
    }

    // Store a like on a photo
    public function storeLike($photo)
    {
        $like = Like::create([
            'user_id' => Auth::id(),
            'photo_id' => $photo,
        ]);

        return response()->json($like, 201);
    }

    // Remove a like from a photo
    public function destroyLike($photo)
    {
        $like = Like::where('user_id', Auth::id())->where('photo_id', $photo)->first();

        if ($like) {
            $like->delete();
            return response()->json(null, 204);
        }

        return response()->json(['message' => 'Like not found.'], 404);
    }
}
