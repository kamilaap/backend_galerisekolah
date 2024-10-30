<?php

namespace App\Http\Controllers\API;
use App\Http\Resources\GaleryResource;
use App\Http\Resources\GaleryCollection;
use App\Models\Galery;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
class GaleryController extends BaseController
{
    public function index()
    {
        $galeries = Galery::with('kategori', 'user', 'photos')->get();
        return new GaleryCollection($galeries);
    }

    public function show($id)
    {
        $galery = Galery::with('kategori', 'user', 'photos')->findOrFail($id);
    return new GaleryResource($galery);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        $galery = Galery::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'kategori_id' => $request->kategori_id,
            'users_id' => auth()->id(),
        ]);

        return response()->json(['message' => 'Galery berhasil ditambahkan!', 'data' => $galery]);
    }

    public function update(Request $request, $id)
    {
        $galery = Galery::findOrFail($id);

        $galery->update($request->only(['judul', 'deskripsi', 'tanggal', 'kategori_id']));

        return response()->json(['message' => 'Galery berhasil diperbarui!', 'data' => $galery]);
    }

    public function destroy($id)
    {
        $galery = Galery::findOrFail($id);
        $galery->delete();

        return response()->json(['message' => 'Galery berhasil dihapus!']);
    }
}
