<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class WebProfileController extends Controller
{
    public function index()
    {
        return view('web.profile.index');
    }

    public function edit()
    {
        return view('web.profile.edit');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->route('web.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function destroy()
    {
        $user = Auth::user();
        $user->delete();

        Auth::logout();
        return redirect()->route('welcome')->with('success', 'Akun berhasil dihapus');
    }
}
