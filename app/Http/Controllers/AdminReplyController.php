<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminReplyController extends Controller
{
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return back()->with('error', 'Unauthorized action');
        }

        $request->validate([
            'comment_id' => 'required|exists:comments,id',
            'reply' => 'required|string'
        ]);

        Reply::create([
            'comment_id' => $request->comment_id,
            'user_id' => auth()->id(),
            'reply' => $request->reply
        ]);

        return back()->with('success', 'Balasan berhasil ditambahkan');
    }

    public function destroy(Reply $reply)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized action'], 403);
        }

        try {
            $reply->delete();

            if (request()->wantsJson()) {
                return response()->json(['success' => true]);
            }

            return back()->with('success', 'Balasan berhasil dihapus');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus balasan'], 500);
            }

            return back()->with('error', 'Gagal menghapus balasan');
        }
    }
}
