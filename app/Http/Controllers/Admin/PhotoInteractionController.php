<?php
namespace App\Http\Controllers\Admin;

use App\Models\Like;
use App\Models\Comment;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoInteractionController extends Controller
{
    // Tampilkan daftar komentar dan like
    public function index()
    {
        $comments = Comment::with('user', 'photo')->latest()->get();
        $likes = Like::with('user', 'photo')->latest()->get();
        $photos = Photo::with('user')->latest()->get();

        return view('admin.interactions.index', compact('comments', 'likes', 'photos'));
    }

    // Hapus komentar tertentu
    public function destroyComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }

    // Hapus like tertentu
    public function destroyLike($id)
    {
        $like = Like::findOrFail($id);
        $like->delete();

        return back()->with('success', 'Like berhasil dihapus.');
    }

    // Admin bisa membalas komentar
    public function replyToComment(Request $request, $commentId)
    {
        $request->validate(['reply' => 'required']);

        Comment::create([
            'user_id' => auth()->id(),
            'photo_id' => Comment::findOrFail($commentId)->photo_id,
            'comment' => $request->reply,
        ]);

        return back()->with('success', 'Balasan berhasil ditambahkan.');
    }
}
