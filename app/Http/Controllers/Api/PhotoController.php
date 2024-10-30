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
    public function index()
    {
        $photos = Photo::with('user', 'comments', 'likes')->latest()->get();
        return response()->json($photos);
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
        $photo = Photo::with('user', 'comments.user', 'likes.user')->findOrFail($id);
        return response()->json($photo);
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
    public function storeLike($photoId)
    {
        $like = Like::create([
            'user_id' => Auth::id(),
            'photo_id' => $photoId,
        ]);

        return response()->json($like, 201);
    }

    // Remove a like from a photo
    public function destroyLike($photoId)
    {
        $like = Like::where('user_id', Auth::id())->where('photo_id', $photoId)->first();

        if ($like) {
            $like->delete();
            return response()->json(null, 204);
        }

        return response()->json(['message' => 'Like not found.'], 404);
    }
}
