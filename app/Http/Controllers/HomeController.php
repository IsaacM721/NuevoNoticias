<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Helpers\Wordpress;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $url = rtrim(config('services.wordpress.url'), '/') . '/wp-json/wp/v2/posts?_embed';
        $response = Http::get($url);
        $posts = [];
        if ($response->successful()) {
            $posts = collect($response->json())->map(function ($p) {
                return [
                    'slug' => $p['slug'],
                    'title' => $p['title']['rendered'],
                    'excerpt' => strip_tags($p['excerpt']['rendered']),
                    'image' => Wordpress::image($p),
                    'category' => Wordpress::category($p),
                    'tags' => Wordpress::tags($p),
                    'author' => $p['_embedded']['author'][0]['name'] ?? 'Autor',
                    'date' => Carbon::parse($p['date'])->format('d \d\e F, Y'),
                ];
            })->toArray();
        }

        if (empty($posts)) {
            $posts = [
                [
                    'slug' => 'luis-abinader-anuncia-aumento-salarial',
                    'title' => 'Luis Abinader anuncia aumento salarial',
                    'excerpt' => 'El presidente informó un incremento para empleados públicos.',
                    'image' => 'https://via.placeholder.com/800x400',
                    'category' => 'Política',
                    'tags' => ['#corrupción'],
                    'author' => 'Redacción',
                    'date' => '01 de julio, 2025',
                ],
                [
                    'slug' => 'mozart-la-para-lanza-tema-con-tokischa',
                    'title' => 'Mozart La Para lanza tema con Tokischa',
                    'excerpt' => 'La colaboración promete ser la sensación del verano.',
                    'image' => 'https://via.placeholder.com/800x400',
                    'category' => 'Farándula',
                    'tags' => ['#urbano'],
                    'author' => 'Ana Pérez',
                    'date' => '15 de junio, 2025',
                ],
                [
                    'slug' => 'licey-gana-clasico-del-caribe',
                    'title' => 'Licey gana clásico del Caribe',
                    'excerpt' => 'Los Tigres se alzaron con el campeonato en un partido histórico.',
                    'image' => 'https://via.placeholder.com/800x400',
                    'category' => 'Deportes',
                    'tags' => ['#Licey'],
                    'author' => 'José Rodríguez',
                    'date' => '10 de febrero, 2025',
                ],
            ];
        }

        return view('home', ['posts' => $posts]);
    }
}
