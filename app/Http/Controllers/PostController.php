<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Helpers\Wordpress;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    public function show(string $slug)
    {
        $url = rtrim(config('services.wordpress.url'), '/') . '/wp-json/wp/v2/posts?slug=' . $slug . '&_embed';
        $response = Http::get($url);
        if (! $response->successful() || empty($response->json())) {
            abort(404);
        }

        $post = $response->json()[0];

        return view('post', [
            'post' => $post,
        ]);
    }
}
