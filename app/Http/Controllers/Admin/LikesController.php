<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function index()
    {
        $likes = Like::with(['user', 'photo'])->latest()->paginate(10);
        return view('admin.likes.index', compact('likes'));
    }

    public function destroy(Like $like)
    {
        $like->delete();
        return response()->json(['status' => 'success']);
    }
}
