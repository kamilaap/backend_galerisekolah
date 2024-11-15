<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agenda;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AgendaController extends Controller
{
    use ValidatesRequests;

    /**
     * Index
     * Menampilkan daftar agenda dengan pagination
     */
    public function index(Request $request)
    {
        $agendas = Agenda::latest()->when($request->q, function ($query) use ($request) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        })->paginate(10);

        return view('admin.agenda.index', compact('agendas'));
    }
  // Menampilkan detail agenda
  public function show($id)
  {
      $agenda = Agenda::findOrFail($id);
      return view('web.agenda.show', compact('agenda'));
  }
    /**
     * Create
     * Menampilkan form untuk menambah agenda baru
     */
    public function create()
    {
        $categories = Kategori::latest()->get();
        return view('admin.agenda.create', compact('categories'));
    }

    /**
     * Store
     * Menyimpan data agenda baru
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'tanggal_post_agenda' => 'required|date',
            'status' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        // Simpan data agenda
        $agenda = Agenda::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'tanggal_post_agenda' => $request->tanggal_post_agenda,
            'status' => $request->status,
            'kategori_id' => $request->kategori_id,
            'users_id' => auth()->user()->id, // Mengaitkan dengan pengguna yang sedang login
        ]);

        return $agenda
            ? redirect()->route('admin.agenda.index')->with(['success' => 'Agenda Berhasil Disimpan!'])
            : redirect()->route('admin.agenda.index')->with(['error' => 'Agenda Gagal Disimpan!']);
    }

    /**
     * Edit
     * Menampilkan form untuk mengedit agenda
     */
    public function edit(Agenda $agenda)
    {
        $categories = Kategori::latest()->get();
        return view('admin.agenda.edit', compact('agenda', 'categories'));
    }

    /**
     * Update
     * Memperbarui data agenda
     */
    public function update(Request $request, Agenda $agenda)
    {
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'tanggal_post_agenda' => 'required|date',
            'status' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        // Update data agenda
        $agenda->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'tanggal_post_agenda' => $request->tanggal_post_agenda,
            'status' => $request->status,
            'kategori_id' => $request->kategori_id,
            'users_id' => auth()->user()->id, // Mengaitkan dengan pengguna yang sedang login
        ]);

        return $agenda
            ? redirect()->route('admin.agenda.index')->with(['success' => 'Agenda Berhasil Diupdate!'])
            : redirect()->route('admin.agenda.index')->with(['error' => 'Agenda Gagal Diupdate!']);
    }

    /**
     * Destroy
     * Menghapus data agenda
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return response()->json(['status' => 'success']);
    }
}
