<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agenda;
use App\Models\Galery;
use App\Models\Informasi;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Controllers\Controller;
class LandingPageController extends Controller
{
    public function index()
    {
        $agenda = Agenda::orderBy('tanggal', 'desc')->take(5)->get();
        $galeries = Galery::with('photos')->get(); // Mengambil galeri beserta foto-fotonya
        $informasi = Informasi::all();
        $title = "Selamat Datang di Web Galeri Sekolah";
        $sliders = Slider::all();

        return view('welcome', compact('agenda', 'galeries', 'informasi', 'sliders'));
    }

    // Menampilkan detail agenda
    public function show($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('web.agenda.show', compact('agenda'));
    }

    // Menampilkan detail informasi
    public function showInformasi($id)
    {
        $informasi = Informasi::findOrFail($id);
        return view('admin.informasi.show', compact('informasi'));
    }
}
