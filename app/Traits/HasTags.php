<?php

namespace App\Traits;

use App\Models\Tag;

trait HasTags
{
    public function processTags($content)
    {
        preg_match_all('/#(\w+)/', $content, $matches);

        $tags = [];
        foreach ($matches[1] as $tag) {
            $tags[] = Tag::firstOrCreate(['name' => strtolower($tag)]);
        }

        return $tags;
    }

    public function makeTagsClickable($content)
    {
        return preg_replace(
            '/#(\w+)/',
            '<a href="' . url('/tag/$1') . '" class="text-blue-600 hover:text-blue-800">#$1</a>',
            $content
        );
    }
} 
