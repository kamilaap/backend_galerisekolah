<?php

namespace App\Http\Controllers\Admin;

use App\Models\Informasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class InformasiController extends Controller
{
    use ValidatesRequests;

    /**
     * Index
     * Menampilkan daftar informasi dengan pagination
     */
    public function index(Request $request)
    {
        $informasi = Informasi::latest()->when($request->q, function ($query) use ($request) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        })->paginate(10);

        return view('admin.informasi.index', compact('informasi'));
    }
    public function show($id)
    {
        $informasi = Informasi::findOrFail($id);
        return view('web.informasi.show', compact('informasi'));
    }

    /**
     * Create
     * Menampilkan form untuk menambah informasi baru
     */
    public function create()
    {
        $categories = Kategori::latest()->get();
        return view('admin.informasi.create', compact('categories'));
    }

    /**
     * Store
     * Menyimpan data informasi baru
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'kategori_id' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required',
        ]);

        // Upload image
        $image = $request->file('image');
        $imagePath = $image->storeAs('informasi', $image->hashName(), 'public'); // Simpan path gambar

        // Simpan data informasi
        $informasi = Informasi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'kategori_id' => $request->kategori_id,
            'status' => $request->status,
            'users_id' => auth()->user()->id,
            'image' => $imagePath, // Simpan path gambar
        ]);

        return $informasi
            ? redirect()->route('admin.informasi.index')->with(['success' => 'Data Berhasil Disimpan!'])
            : redirect()->route('admin.informasi.index')->with(['error' => 'Data Gagal Disimpan!']);
    }

    /**
     * Edit
     * Menampilkan form untuk mengedit informasi
     */
    public function edit(Informasi $informasi)
    {
        $categories = Kategori::latest()->get();
        return view('admin.informasi.edit', compact('informasi', 'categories'));
    }

    /**
     * Update
     * Memperbarui data informasi
     */
    public function update(Request $request, Informasi $informasi)
    {
        $this->validate($request, [
            'judul' => 'required',
            'kategori_id' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required',
        ]);

        // Check jika ada image baru
        if ($request->hasFile('image')) {
            // Hapus image lama dari storage
            Storage::disk('public')->delete($informasi->image);
            // Upload image baru
            $image = $request->file('image');
            $imagePath = $image->storeAs('informasi', $image->hashName(), 'public'); // Simpan path gambar
            $informasi->image = $imagePath; // Update path gambar
        }

        // Update data informasi
        $informasi->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'kategori_id' => $request->kategori_id,
            'status' => $request->status,
            'users_id' => auth()->user()->id,
        ]);

        return $informasi
            ? redirect()->route('admin.informasi.index')->with(['success' => 'Data Berhasil Diupdate!'])
            : redirect()->route('admin.informasi.index')->with(['error' => 'Data Gagal Diupdate!']);
    }

    /**
     * Destroy
     * Menghapus data informasi
     */
    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);
        Storage::disk('public')->delete($informasi->image); // Hapus image dari storage
        $informasi->delete(); // Hapus data informasi dari database

        return $informasi
            ? response()->json(['status' => 'success'])
            : response()->json(['status' => 'error']);
    }
}
