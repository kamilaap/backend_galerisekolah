<?php

namespace App\Http\Controllers\Api;

use App\Models\User; // Pastikan untuk menggunakan model User
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Menampilkan profil pengguna
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Mengambil data pengguna yang sedang login
        return response()->json([
            'success' => true,
            'message' => 'Data Profile',
            'data' => auth()->guard('api')->user(),
        ], 200);
    }

    /**
     * Memperbarui profil pengguna
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'avatar' => 'nullable|image|max:2048' // Validasi untuk avatar
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Mengambil pengguna yang sedang login
        $user = auth()->guard('api')->user();

        // Memperbarui nama pengguna
        $user->name = $request->name;

        // Memperbarui avatar jika ada
        if ($request->file('avatar')) {
            // Hapus gambar lama jika ada
            if ($user->avatar) {
                Storage::disk('local')->delete('public/users/' . basename($user->avatar));
            }
            // Unggah gambar baru
            $image = $request->file('avatar');
            $image->storeAs('public/users', $image->hashName());
            $user->avatar = $image->hashName();
        }

        // Simpan perubahan
        try {
            $user->save();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ], 500);
        }

        // Mengembalikan respons JSON
        return response()->json([
            'success' => true,
            'message' => 'Data Profile Berhasil Diupdate!',
            'data' => $user,
        ], 201);
    }


    /**
     * Memperbarui password pengguna
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Mengambil pengguna yang sedang login
        $user = auth()->guard('api')->user();

        // Memperbarui password
        $user->password = Hash::make($request->password);
        $user->save();

        // Mengembalikan respons JSON
        return response()->json([
            'success' => true,
            'message' => 'Password Berhasil Diupdate!',
            'data' => $user, // Anda bisa menampilkan data yang relevan
        ], 201);
    }
}
