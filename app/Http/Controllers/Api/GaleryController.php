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
        try {
            $validated = $request->validate([
                'judul' => 'required|string',
                'deskripsi' => 'nullable|string',
                'tanggal' => 'required|date',
                'kategori_id' => 'required|exists:kategori,id',
            ]);

            $galery = Galery::create([
                'judul' => $validated['judul'],
                'deskripsi' => $validated['deskripsi'],
                'tanggal' => $validated['tanggal'],
                'kategori_id' => $validated['kategori_id'],
                'users_id' => auth()->id(),
                'status' => 'active'
            ]);

            return $this->sendResponse(
                new GaleryResource($galery),
                'Galery berhasil ditambahkan!'
            );

        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $galery = Galery::findOrFail($id);

            if (auth()->id() !== $galery->users_id && auth()->user()->role !== 'admin') {
                return $this->sendError('Unauthorized', 'Anda tidak memiliki akses untuk mengubah galeri ini', 403);
            }

            $validated = $request->validate([
                'judul' => 'required|string',
                'deskripsi' => 'nullable|string',
                'tanggal' => 'required|date',
                'kategori_id' => 'required|exists:kategori,id',
            ]);

            $galery->update($validated);

            return $this->sendResponse(
                new GaleryResource($galery),
                'Galery berhasil diperbarui!'
            );

        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $galery = Galery::findOrFail($id);

            if (auth()->id() !== $galery->users_id && auth()->user()->role !== 'admin') {
                return $this->sendError('Unauthorized', 'Anda tidak memiliki akses untuk menghapus galeri ini', 403);
            }

            $galery->delete();

            return $this->sendResponse(
                null,
                'Galery berhasil dihapus!'
            );

        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }
}
