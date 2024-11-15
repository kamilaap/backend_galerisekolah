<?php

namespace App\Http\Controllers\Admin;

use App\Models\Galery;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

class GaleryController extends Controller
{
    use ValidatesRequests;

    /**
     * Index
     * Menampilkan daftar galeri dengan pagination
     */
    public function index(Request $request)
    {
        $galeries = Galery::latest()->when($request->q, function ($query) use ($request) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        })->paginate(10);

        return view('admin.galery.index', compact('galeries'));
    }
    public function show($id)
    {
        $galery = Galery::with('photos')->findOrFail($id); // Increment the view count for each photo
        foreach ($galery->photos as $photo) {
            // Log the view in the database
            $photo->views()->create(); // This creates a new record in the views table

            // Count the views for each photo
            $photo->view_count = $photo->views()->count(); // Count the views for display
        }
        return view('web.galery.show', compact('galery'));
    }
    /**
     * Create
     * Menampilkan form untuk menambah galeri baru
     */
    public function create()
    {
        $categories = Kategori::latest()->get();
        return view('admin.galery.create', compact('categories'));
    }

    /**
     * Store
     * Menyimpan data galeri baru
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'nullable|string',
            'is_map' => 'boolean',
            'tanggal' => 'required|date',
            'status' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        // Simpan data galeri
        $galery = Galery::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'is_map' => $request->is_map,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'kategori_id' => $request->kategori_id,
            'users_id' => auth()->user()->id, // Mengaitkan dengan pengguna yang sedang login
        ]);

        return $galery
            ? redirect()->route('admin.galery.index')->with(['success' => 'Galeri Berhasil Disimpan!'])
            : redirect()->route('admin.galery.index')->with(['error' => 'Galeri Gagal Disimpan!']);
    }

    /**
     * Edit
     * Menampilkan form untuk mengedit galeri
     */
    public function edit(Galery $galery)
    {
        $categories = Kategori::latest()->get();
        return view('admin.galery.edit', compact('galery', 'categories'));
    }

    /**
     * Update
     * Memperbarui data galeri
     */
    public function update(Request $request, Galery $galery)
    {
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'nullable|string',
            'is_map' => 'boolean',
            'tanggal' => 'required|date',
            'status' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        // Update data galeri
        $galery->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'is_map' => $request->is_map,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'kategori_id' => $request->kategori_id,
            'users_id' => auth()->user()->id, // Mengaitkan dengan pengguna yang sedang login
        ]);

        return $galery
            ? redirect()->route('admin.galery.index')->with(['success' => 'Galeri Berhasil Diupdate!'])
            : redirect()->route('admin.galery.index')->with(['error' => 'Galeri Gagal Diupdate!']);
    }

    /**
     * Destroy
     * Menghapus data galeri
     */
    public function destroy(Galery $galery)
    {
        $galery->delete();

        return response()->json(['status' => 'success']);
    }
}
