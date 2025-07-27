<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    public function show(string $slug)
    {
        $url = rtrim(config('services.wordpress.url'), '/')."/wp-json/wp/v2/posts?slug={$slug}&_embed";
        $response = Http::get($url);
        $data = $response->successful() ? $response->json() : [];
        $post = $data[0] ?? null;

        abort_unless($post, 404);

        return view('post', [
            'post' => $post,
        ]);
    }
}
