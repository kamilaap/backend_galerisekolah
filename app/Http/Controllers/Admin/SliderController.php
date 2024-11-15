<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * index
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sliders = Slider::latest()->paginate(5);
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * store
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'link' => 'required'
        ]);


        // Upload image
        $image = $request->file('image');
        $imagePath = $image->storeAs('slider', $image->hashName(), 'public'); // Simpan path gambar

        // Simpan data ke database
        $slider = Slider::create([
            'image' => $imagePath,
            'link' => $request->link
        ]);

        // Redirect berdasarkan status penyimpanan
        if ($slider) {
            return redirect()->route('admin.slider.index')->with('success', 'Data Berhasil Disimpan!');
        } else {
            return redirect()->route('admin.slider.index')->with('error', 'Data Gagal Disimpan!');
        }
    }

    /**
     * destroy
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Temukan slider berdasarkan id
        $slider = Slider::findOrFail($id);

        Storage::disk('public')->delete($slider->image); // Hapus image dari storage
        $slider->delete(); // Hapus data informasi dari database
        // Hapus data dari database
        $slider->delete();

        // Response berdasarkan hasil penghapusan
        if ($slider) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }
}
