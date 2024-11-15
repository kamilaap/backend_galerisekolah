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
        try {
            $validateUser = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6',
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & password do not match our records.'
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            // Kirim role dalam respons
            $message = $user->role === 'petugas' ? 'Petugas logged in successfully' : 'User logged in successfully';

            return response()->json([
                'status' => true,
                'message' => $message,
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'role' => $user->role // Tambahkan role ke response
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
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
