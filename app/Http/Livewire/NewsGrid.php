<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\News;
use Illuminate\Support\Carbon;

class NewsGrid extends Component
{
    public $category = '';
    public $tag = '';
    public $search = '';
    protected $posts = [];

    public function mount()
    {
        $this->posts = News::latest()->get()->map(function ($n) {
            return [
                'titulo' => $n->title,
                'resumen' => $n->summary,
                'categoria' => $n->category,
                'etiquetas' => array_filter(array_map('trim', explode(',', (string) $n->tags))),
                'autor' => $n->author_name,
                'fecha' => $n->published_at ? Carbon::parse($n->published_at)->format('d \d\e F, Y') : '',
                'imagen' => $n->image_url ?: 'https://via.placeholder.com/600x400',
            ];
        })->toArray();

        if (empty($this->posts)) {
            $this->posts = [
                [
                    'titulo' => 'Luis Abinader anuncia aumento salarial',
                    'resumen' => 'El presidente informó un incremento para empleados públicos.',
                    'categoria' => 'Política',
                    'etiquetas' => ['#corrupción'],
                    'autor' => 'Redacción',
                    'fecha' => '01 de julio, 2025',
                    'imagen' => 'https://via.placeholder.com/600x400',
                ],
                [
                    'titulo' => 'Mozart La Para lanza tema con Tokischa',
                    'resumen' => 'La colaboración promete ser la sensación del verano.',
                    'categoria' => 'Farándula',
                    'etiquetas' => ['#urbano'],
                    'autor' => 'Ana Pérez',
                    'fecha' => '15 de junio, 2025',
                    'imagen' => 'https://via.placeholder.com/600x400',
                ],
                [
                    'titulo' => 'Licey gana clásico del Caribe',
                    'resumen' => 'Los Tigres se alzaron con el campeonato en un partido histórico.',
                    'categoria' => 'Deportes',
                    'etiquetas' => ['#Licey'],
                    'autor' => 'José Rodríguez',
                    'fecha' => '10 de febrero, 2025',
                    'imagen' => 'https://via.placeholder.com/600x400',
                ],
            ];
        }
    }

    public function setCategory($cat)
    {
        $this->category = $cat;
    }

    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    public function getFilteredPostsProperty()
    {
        return collect($this->posts)->filter(function ($post) {
            $okCat = $this->category ? $post['categoria'] === $this->category : true;
            $okTag = $this->tag ? in_array($this->tag, $post['etiquetas']) : true;
            $query = strtolower($this->search);
            $okSearch = $query ? str_contains(strtolower($post['titulo']), $query) || str_contains(strtolower($post['categoria']), $query) : true;
            return $okCat && $okTag && $okSearch;
        });
    }

    public function render()
    {
        $categorias = collect($this->posts)->pluck('categoria')->unique();
        $tags = collect($this->posts)->pluck('etiquetas')->flatten()->unique();
        return view('livewire.news-grid', [
            'posts' => $this->filteredPosts,
            'categorias' => $categorias,
            'tags' => $tags,
        ]);
    }
}

