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
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'is_map' => 'boolean',
            'tanggal' => 'required|date',
            'status' => 'required|string',
            'kategori_id' => 'required|integer',
            'users_id' => 'required|integer',
            'jurusan_id' => 'required|integer', // Pastikan ini divalidasi
        ]);

        $galery = new Galery();
        $galery->judul = $request->judul;
        $galery->deskripsi = $request->deskripsi;
        $galery->is_map = $request->is_map;
        $galery->tanggal = $request->tanggal;
        $galery->status = $request->status;
        $galery->kategori_id = $request->kategori_id;
        $galery->users_id = $request->users_id;
        $galery->jurusan_id = $request->jurusan_id; // Setel nilai ini dari permintaan
        $galery->save();

        return redirect()->route('galery.index')->with('success', 'Item galeri berhasil dibuat.');
    }
}
