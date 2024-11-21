<?php
namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Galery;
use App\Models\Informasi;
use App\Models\Slider;
use App\Models\Photo;
use App\Models\Jurusan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $agenda = Agenda::orderBy('tanggal', 'desc')->take(5)->get();
        $informasi = Informasi::all();
        $title = "Selamat Datang di Web Galeri Sekolah";
        $sliders = Slider::all(); // Atau query sesuai dengan kebutuhan Anda

     // Ambil semua jurusan
     $jurusan = Jurusan::all();

     // Ambil semua foto dari galeri yang sesuai dengan galery_id jurusan
     $jurusanPhotos = Photo::where('galery_id', 2)->get(); // Mengambil foto berdasarkan galery_id yang sesuai

     // Mengambil 3 foto terbaru dengan jumlah views, likes, dan comments
     $latestPhotos = Photo::withCount(['likes', 'views', 'comments'])->latest()->take(3)->get();

     $galeries = Galery::all(); // Ambil semua galeri



     return view('welcome', compact('sliders', 'agenda', 'jurusanPhotos', 'informasi', 'galeries', 'jurusan', 'latestPhotos'));
    }

    public function showGalleryPhotos($id)
    {
         // Retrieve the gallery with its photos and comments
    $galery = Galery::with(['photos.comments.user'])->findOrFail($id);

    // Increment the view count for each photo
    foreach ($galery->photos as $photo) {
        // Log the view in the database
        $photo->views()->create(); // This creates a new record in the views table

        // Count the views for each photo
        $photo->view_count = $photo->views()->count(); // Count the views for display
    }

    return view('web.galery.photo', compact('galery'));
    }

    public function fullInformasi()
    {
        // Ambil semua galeri dengan foto terkait
        $informasi = Informasi::all();
        return view('web.informasi.index', compact('informasi'));
    }



    public function fullGallery()
    {
        // Ambil semua galeri dengan foto terkait
        $galeries = Galery::with('photos')->get();
        return view('web.galery.index', compact('galeries'));
    }
    public function fullAgenda()
    {
        // Ambil semua agenda yang tersedia
        $agenda = Agenda::orderBy('tanggal', 'desc')->get();

        return view('web.agenda.index', compact('agenda'));
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
        $informasi = Informasi::find($id);
        return view('web.informasi.show', compact('informasi'));
    }
    public function showJurusan($id)
    {
        $jurusan = Jurusan::find($id);
        return view('web.jurusan.show', compact('jurusan'));
    }
    public function downloadPhoto($id)
    {
        try {
            $photo = Photo::findOrFail($id);
            // Hapus 'storage/' dari awal path dan 'public/' jika ada
            $path = str_replace(['storage/', 'public/'], '', parse_url($photo->image, PHP_URL_PATH));

            // Cek apakah file exists
            if (!Storage::disk('public')->exists($path)) {
                return back()->with('error', 'File tidak ditemukan');
            }

            // Dapatkan extension dari path file
            $extension = pathinfo($path, PATHINFO_EXTENSION);

            // Buat nama file yang aman untuk download menggunakan Str::slug()
            $fileName = Str::slug($photo->judul) . '.' . $extension;

            // Download file
            return response()->download(
                storage_path('app/public/' . $path),
                $fileName
            );
        } catch (\Exception $e) {
            Log::error('Download error: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengunduh foto');
        }
    }

    public function downloadInformasiPhoto($id)
    {
        try {
            $informasi = Informasi::findOrFail($id);
            $path = str_replace(['storage/', 'public/'], '', parse_url($informasi->image, PHP_URL_PATH));

            if (!Storage::disk('public')->exists($path)) {
                return back()->with('error', 'File tidak ditemukan');
            }

            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $fileName = Str::slug($informasi->judul) . '.' . $extension;

            return response()->download(
                storage_path('app/public/' . $path),
                $fileName
            );
        } catch (\Exception $e) {
            Log::error('Download error: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengunduh foto');
        }
    }

    public function showByDate($date)
    {
        $agendas = Agenda::whereDate('tanggal', $date)->get();
        return view('web.agenda.show-by-date', compact('agendas', 'date'));
    }
}
