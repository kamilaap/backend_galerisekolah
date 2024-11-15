<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function getPhotoComments($photoId)
    {
        $comments = Comment::with('user')
            ->where('photo_id', $photoId)
            ->latest()
            ->get()
            ->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'comment' => $comment->comment,
                    'user_name' => $comment->user->name,
                    'created_at' => $comment->created_at->format('d/m/Y H:i')
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $comments
        ]);
    }

    public function addComment(Request $request, $photoId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000'
        ]);

        $photo = Photo::findOrFail($photoId);

        $comment = Comment::create([
            'photo_id' => $photoId,
            'user_id' => auth()->id(),
            'comment' => $request->comment
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment added successfully',
            'data' => [
                'id' => $comment->id,
                'comment' => $comment->comment,
                'user_name' => auth()->user()->name,
                'created_at' => $comment->created_at->format('d/m/Y H:i')
            ]
        ]);
    }
}
