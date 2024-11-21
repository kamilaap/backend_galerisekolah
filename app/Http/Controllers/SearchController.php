<?php

namespace App\Http\Controllers;
use App\Models\Informasi; // Import the Informasi model
use App\Models\Agenda; // Import the Agenda model
use App\Models\Galery; // Import the Galery model
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $keywords = explode(' ', $query); // Split the query into keywords

        // Search for Informasi
        $informasiResults = Informasi::where(function($q) use ($keywords) {
            foreach ($keywords as $keyword) {
                $q->orWhere('judul', 'LIKE', "%{$keyword}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$keyword}%");
            }
        })->with('kategori', 'user')->get();

        // Search for Agenda
        $agendaResults = Agenda::where(function($q) use ($keywords) {
            foreach ($keywords as $keyword) {
                $q->orWhere('judul', 'LIKE', "%{$keyword}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$keyword}%");
            }
        })->with('kategori', 'user')->get();

        // Search for Galery
        $galeryResults = Galery::where(function($q) use ($keywords) {
            foreach ($keywords as $keyword) {
                $q->orWhere('judul', 'LIKE', "%{$keyword}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$keyword}%");
            }
        })->with('kategori', 'user')->get();

        // Combine results
        $results = [
            'informasi' => $informasiResults,
            'agenda' => $agendaResults,
            'galery' => $galeryResults,
        ];

        return view('search.results', compact('results', 'query'));
    }
}
