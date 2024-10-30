<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::paginate(10); // Mengambil data comments dengan pagination
        return view('admin.comments.index', compact('comments'));
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);

        if ($comment) {
            $comment->delete();

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus!']);
        }

        return response()->json(['status' => 'error', 'message' => 'Data gagal dihapus!']);
    }
}
