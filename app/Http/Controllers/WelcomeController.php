<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        // ... existing code ...

        return view('welcome', compact('profil', /* other variables */));
    }
}
