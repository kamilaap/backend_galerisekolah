<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function index()
    {
        $likes = Like::paginate(10); // Mengambil data likes dengan pagination
        return view('admin.likes.index', compact('likes'));
    }

    public function destroy($id)
    {
        $like = Like::find($id);

        if ($like) {
            $like->delete();

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus!']);
        }

        return response()->json(['status' => 'error', 'message' => 'Data gagal dihapus!']);
    }
}
