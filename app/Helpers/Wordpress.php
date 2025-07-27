<?php

namespace App\Helpers;

class Wordpress
{
    public static function image(array $post): string
    {
        return $post['_embedded']['wp:featuredmedia'][0]['source_url'] ?? 'https://via.placeholder.com/800x400?text=No+Image';
    }

    public static function category(array $post): string
    {
        return $post['_embedded']['wp:term'][0][0]['name'] ?? 'Sin categor\u00eda';
    }

    public static function tags(array $post): array
    {
        if (isset($post['_embedded']['wp:term'][1])) {
            return array_map(fn($tag) => $tag['name'], $post['_embedded']['wp:term'][1]);
        }
        return [];
    }
}
