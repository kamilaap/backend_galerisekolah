<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Kategori::latest()->when(request()->q, function ($query) {
            $query->where('judul', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.kategori.index', compact('categories')); // Make sure to keep 'categories' here
    }

    /**
     * Show the form for creating a new kategori.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Kategori::all(); // Assuming you have a Category model
        return view('admin.kategori.create', compact('categories'));
    }

    /**
     * Store a newly created kategori in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255|unique:kategori,judul',
            'deskripsi' => 'required|string|max:1000',
        ]);

        // Save to DB
        $kategori = Kategori::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($kategori) {
            return redirect()->route('admin.kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('admin.kategori.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified kategori.
     *
     * @param \App\Models\Kategori $kategory
     * @return \Illuminate\View\View
     */
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified kategori in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kategori $kategori
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'judul' => 'required|unique:kategori,judul,' . $kategori->id,
            'deskripsi' => 'required',
        ]);

        // Update data
        $kategori->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($kategori) {
            return redirect()->route('admin.kategori.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('admin.kategori.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified kategori from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return response()->json(['status' => 'success']);
    }
}
