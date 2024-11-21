<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PhotoController extends Controller
{
    use ValidatesRequests;

    /**
     * Index
     * Menampilkan daftar foto dengan pagination
     */
    public function index(Request $request)
    {
        $photos = Photo::with('galery')->latest()->when($request->q, function ($query) use ($request) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        })->paginate(10);

        return view('admin.photo.index', compact('photos'));
    }

    /**
     * Create
     * Menampilkan form untuk menambah foto baru
     */
    public function create()
    {
        $galeries = Galery::latest()->get();
        return view('admin.photo.create', compact('galeries'));
    }

    /**
     * Store
     * Menyimpan data foto baru
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'galery_id' => 'required|exists:galery,id',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'judul' => 'required|string|max:255',
        ]);

        // Menyimpan file gambar
        $imagePath = $request->file('image')->store('images/photos', 'public');

        // Simpan data foto
        $photo = Photo::create([
            'galery_id' => $request->galery_id,
            'image' => $imagePath,
            'judul' => $request->judul,
            'user_id' => auth()->user()->id, // Mengaitkan dengan pengguna yang sedang login
        ]);
$photo->save();
        return $photo
            ? redirect()->route('admin.photo.index')->with(['success' => 'Foto Berhasil Disimpan!'])
            : redirect()->route('admin.photo.index')->with(['error' => 'Foto Gagal Disimpan!']);
    }

    /**
     * Edit
     * Menampilkan form untuk mengedit foto
     */
    public function edit(Photo $photo)
    {
        $galeries = Galery::latest()->get();
        return view('admin.photo.edit', compact('photo', 'galeries'));
    }

    /**
     * Update
     * Memperbarui data foto
     */
    public function update(Request $request, Photo $photo)
    {
        $this->validate($request, [
            'galery_id' => 'required|exists:galery,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'judul' => 'required|string|max:255',
        ]);

        // Jika ada gambar baru yang diupload
        if ($request->hasFile('image')) {
            // Menghapus gambar lama dari storage
            Storage::disk('public')->delete($photo->image);

            // Menyimpan file gambar baru
            $imagePath = $request->file('image')->store('images/photos', 'public');
            $photo->image = $imagePath; // Memperbarui path gambar
        }

        // Update data foto
        $photo->update([
            'galery_id' => $request->galery_id,
            'judul' => $request->judul,
            'user_id' => auth()->user()->id, // Mengaitkan dengan pengguna yang sedang login
        ]);

        return $photo
            ? redirect()->route('admin.photo.index')->with(['success' => 'Foto Berhasil Diupdate!'])
            : redirect()->route('admin.photo.index')->with(['error' => 'Foto Gagal Diupdate!']);
    }

    /**
     * Destroy
     * Menghapus data foto
     */
    public function destroy(Photo $photo)
    {
        // Menghapus gambar dari storage
        Storage::disk('public')->delete($photo->image);

        $photo->delete();

        return response()->json(['status' => 'success']);
    }
}
