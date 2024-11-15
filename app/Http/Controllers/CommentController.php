<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'photo_id' => 'required|exists:photos,id',
            'comment' => 'required|string|max:1000'
        ]);

        try {
            // Buat komentar baru
            Comment::create([
                'photo_id' => $request->photo_id,
                'user_id' => auth()->id(),
                'comment' => $request->comment
            ]);

            return back()->with('success', 'Komentar berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan komentar');
        }
    }

    public function destroy(Comment $comment)
    {
        if (auth()->id() === $comment->user_id || auth()->user()->role === 'admin') {
            try {
                // Hapus balasan terkait
                if ($comment->replies) {
                    $comment->replies()->delete();
                }

                // Hapus komentar
                $comment->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Komentar berhasil dihapus'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus komentar'
                ], 500);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Anda tidak memiliki izin untuk menghapus komentar ini'
        ], 403);
    }
}
