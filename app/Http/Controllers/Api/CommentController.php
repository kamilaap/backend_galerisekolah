<?php

namespace App\Http\Controllers\API;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\CommentResource;
use Illuminate\Foundation\Validation\ValidatesRequests;


class CommentController extends BaseController
{
    use ValidatesRequests;
    public function index()
    {
        $comments = Comment::with('photo', 'user')->get();
        return CommentResource::collection($comments); // Mengembalikan kumpulan komentar
    }

    public function show($id)
    {
        $comment = Comment::with('photo', 'user')->findOrFail($id);
    return new CommentResource($comment); // Mengembalikan satu komentar
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $this->validate($request, [
            'photo_id' => 'required|exists:photos,id', // Ensure the photo_id is provided and exists
            'comment' => 'required|string|max:1000', // Validate the comment
        ]);

        // Create the comment
        Comment::create([
            'photo_id' => $request->photo_id,
            'comment' => $request->comment,
            'user_id' => auth()->user()->id, // Associate the comment with the logged-in user
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Komentar berhasil dihapus!']);
    }
}
