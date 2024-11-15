<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    public function index()
    {
        $galeries = Galery::with(['photos' => function($query) {
            $query->select('id', 'galery_id', 'image');
        }])->get(['id', 'judul', 'deskripsi', 'kategori', 'created_at']);

        return view('web.galery.index', compact('galeries'));
    }

    public function show($id)
    {
        $galery = Galery::with('photos')->findOrFail($id);
        return view('web.galery.photo', compact('galery'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategori,id',
            'is_map' => 'required|boolean',
            // ... validasi lainnya
        ]);

        $galery = Galery::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'is_map' => $request->is_map,
            'tanggal' => $request->tanggal,
            'status' => 'active',
            'kategori_id' => $request->kategori_id,
            'users_id' => auth()->id(),
        ]);

        return redirect()->route('admin.galery.index')
            ->with('success', 'Galeri berhasil ditambahkan');
    }
}
