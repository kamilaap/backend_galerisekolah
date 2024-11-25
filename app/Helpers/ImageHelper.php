<?php

if (!function_exists('getImageUrl')) {
    function getImageUrl($imagePath) {
        if (empty($imagePath)) {
            return null;
        }

        if (str_starts_with($imagePath, 'http')) {
            return $imagePath;
        }

        if (str_starts_with($imagePath, '/storage/')) {
            $imagePath = str_replace('/storage/', '', $imagePath);
        }

        $baseUrl = config('app.url');
        if (!app()->environment('production')) {
            $baseUrl = str_replace('localhost', '10.0.2.2', $baseUrl);
        }

        return $baseUrl . '/storage/' . $imagePath;
    }
}
