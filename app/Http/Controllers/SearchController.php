<?php
namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchByTag(Request $request)
    {
        $tag = Tag::where('slug', $request->tag)->firstOrFail();
        $type = $request->type;

        $results = [];
        if (!$type || $type === 'informasi') {
            $results['informasi'] = $tag->informasi;
        }
        if (!$type || $type === 'agenda') {
            $results['agenda'] = $tag->agenda;
        }
        if (!$type || $type === 'galeri') {
            $results['galeries'] = $tag->galeries;
        }

        return view('web.search.results', compact('results', 'tag', 'type'));
    }
}
