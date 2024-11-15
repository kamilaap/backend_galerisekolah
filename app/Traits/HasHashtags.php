<?php

namespace App\Traits;

use App\Models\Hashtag;

trait HasHashtags
{
    private function processHashtags($content)
    {
        preg_match_all('/#(\w+)/', $content, $matches);

        $hashtags = [];
        foreach ($matches[1] as $tag) {
            $hashtags[] = Hashtag::firstOrCreate(['name' => strtolower($tag)]);
        }

        return $hashtags;
    }
}
