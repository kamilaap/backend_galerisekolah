<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        $title = 'Profil Sekolah';
        $profil = ProfilSekolah::first() ?? new ProfilSekolah();

        return view('admin.profil-sekolah.index', compact('title', 'profil'));
    }

    public function edit()
    {
        $title = 'Edit Profil Sekolah';
        $profil = ProfilSekolah::first() ?? new ProfilSekolah();

        return view('admin.profil-sekolah.edit', compact('title', 'profil'));
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'deskripsi' => 'required',
                'visi' => 'required',
                'misi' => 'required',
                'video_url' => 'nullable|url',
                'welcome_title' => 'required',
                'welcome_subtitle' => 'required',
                'welcome_description' => 'nullable'
            ]);

            \Log::info('Update request data:', $request->all());

            $profil = ProfilSekolah::first();
            if (!$profil) {
                $profil = new ProfilSekolah();
                \Log::info('Creating new ProfilSekolah instance');
            } else {
                \Log::info('Updating existing ProfilSekolah:', ['id' => $profil->id]);
            }

            $profil->fill($request->all());
            $saved = $profil->save();

            \Log::info('Save result:', ['success' => $saved]);

            if (!$saved) {
                throw new \Exception('Failed to save profile');
            }

            return redirect()
                ->route('admin.profil-sekolah.index')
                ->with('success', 'Profil sekolah berhasil diperbarui');
        } catch (\Exception $e) {
            \Log::error('Error updating profile:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    }
}
