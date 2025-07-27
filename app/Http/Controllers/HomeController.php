<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $url = rtrim(config('services.wordpress.url'), '/').'/wp-json/wp/v2/posts?_embed';
        $response = Http::get($url);
        $posts = $response->successful() ? $response->json() : [];

        return view('home', [
            'posts' => $posts,
        ]);
    }
}
