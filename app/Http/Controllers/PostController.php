<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    public function show(string $slug)
    {
        $post = News::where('slug', $slug)->firstOrFail();

        return view('post', [
            'post' => $post,
        ]);
    }
}
