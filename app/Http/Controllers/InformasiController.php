<?php

namespace App\Http\Controllers;

use App\Models\Informasi;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InformasiController extends Controller
{
    public function index()
    {
        $informasi = Informasi::latest()->get();
        return view('web.informasi.index', compact('informasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategori,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',

        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('informasi', 'public');
        }

        $informasi = Informasi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'kategori_id' => $request->kategori_id,
            'status' => 'active',
            'users_id' => auth()->id(),
            'image' => $imagePath
        ]);

       

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi berhasil ditambahkan');
    }

    public function show($id)
    {
        $informasi = Informasi::findOrFail($id);
        return view('web.informasi.show', compact('informasi'));
    }
}
