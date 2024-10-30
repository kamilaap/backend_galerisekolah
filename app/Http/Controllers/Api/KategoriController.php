<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\KategoriResource;
use App\Http\Resources\KategoriCollection;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Tampilkan semua kategori
    public function index()
    {
        $kategori = Kategori::with(['agenda', 'galery', 'informasi'])->get();
        return new KategoriCollection($kategori);
    }

    // Tampilkan kategori berdasarkan ID
    public function show($id)
    {
        $kategori = Kategori::with(['agenda', 'galery', 'informasi'])->findOrFail($id);
        return new KategoriResource($kategori);
    }

    // Tambah kategori baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori = Kategori::create($validatedData);
        return (new KategoriResource($kategori))
            ->additional(['message' => 'Kategori berhasil ditambahkan.']);
    }

    // Perbarui kategori
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update($validatedData);
        return (new KategoriResource($kategori))
            ->additional(['message' => 'Kategori berhasil diperbarui.']);
    }

    // Hapus kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return response()->json(['message' => 'Kategori berhasil dihapus.']);
    }
}
