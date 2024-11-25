<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profile berhasil diperbarui!');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = auth()->user();

        // Hapus avatar lama jika ada
        if ($user->avatar && Storage::exists($user->avatar)) {
            Storage::delete($user->avatar);
        }

        // Upload avatar baru
        $avatarPath = $request->file('avatar')->store('public/avatars');
        $avatarPath = str_replace('public/', '', $avatarPath);

        $user->update([
            'avatar' => $avatarPath
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Avatar berhasil diperbarui!',
            'avatar_url' => Storage::url($avatarPath)
        ]);
    }
} 