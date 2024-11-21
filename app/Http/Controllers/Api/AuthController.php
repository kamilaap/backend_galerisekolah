<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  // Register
  public function register(Request $request)
  {
      try {
          $validator = Validator::make($request->all(), [
              'name' => 'required|string|max:255',
              'email' => 'required|string|email|max:255|unique:users',
              'password' => 'required|string|min:6',
              'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
              'role' => 'required|string|in:user,petugas' // Validasi role
          ]);

          if ($validator->fails()) {
              return response()->json([
                  'status' => false,
                  'message' => 'Validation error',
                  'errors' => $validator->errors()
              ], 401);
          }

          $avatarPath = $request->hasFile('avatar')
              ? $request->file('avatar')->store('users', 'public')
              : null;

          $user = User::create([
              'name' => $request->name,
              'email' => $request->email,
              'password' => Hash::make($request->password),
              'avatar' => $avatarPath,
              'role' => $request->role // Simpan role
          ]);

          return response()->json([
              'status' => true,
              'message' => 'User registered successfully',
              'token' => $user->createToken('API TOKEN')->plainTextToken,
              'user' => $user
          ], 200);
      } catch (\Throwable $th) {
          return response()->json([
              'status' => false,
              'message' => $th->getMessage()
          ], 500);
      }
  }


    // Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Buat token untuk API
            $token = $user->createToken('auth-token')->plainTextToken;

            // Tentukan redirect berdasarkan role
            $redirect = $user->role === 'admin' ? '/admin/dashboard' : '/';

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'role' => $user->role,
                'token' => $token,
                'redirect' => $redirect
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah'
        ], 401);
    }

public function logout()
    {
       auth()->user()->tokens()->delete();
       return response()->json([
        'status' => true,
        'message' => 'User Logged out',
        'data' => [],
       ],200);

    }
}
