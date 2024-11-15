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
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar && Storage::exists('public/' . str_replace('storage/', '', $user->avatar))) {
                Storage::delete('public/' . str_replace('storage/', '', $user->avatar));
            }

            // Upload avatar baru
            $avatar = $request->file('avatar');
            $filename = 'avatars/' . time() . '_' . $user->id . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public', $filename);
            $data['avatar'] = 'storage/' . $filename;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('web.profile')->with('success', 'Profile berhasil diperbarui');
    }

    public function destroy()
    {
        $user = Auth::user();
        $user->delete();

        Auth::logout();
        return redirect()->route('welcome')->with('success', 'Akun berhasil dihapus');
    }
}
