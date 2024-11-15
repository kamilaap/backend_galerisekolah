<?php

namespace App\Http\Controllers;

use App\Models\Hashtag;

class HashtagController extends Controller
{
    public function show($name)
    {
        $hashtag = Hashtag::where('name', $name)->firstOrFail();

        $data = [
            'informasi' => $hashtag->informasi()->latest()->get(),
            'agenda' => $hashtag->agenda()->latest()->get(),
            'galery' => $hashtag->galery()->latest()->get(),
            'photo' => $hashtag->photo()->latest()->get(),
        ];

        return view('hashtags.show', compact('hashtag', 'data'));
    }
} 
