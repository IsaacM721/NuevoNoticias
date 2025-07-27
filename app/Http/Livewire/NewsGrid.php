<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;

class NewsGrid extends Component
{
    public $category = '';
    public $tag = '';
    protected $posts = [];

    public function mount()
    {
        $this->posts = [
            [
                'titulo' => 'Mozart La Para lanza colaboración con Tokischa',
                'resumen' => 'El tema mezcla dembow y trap, ya tendencia en TikTok.',
                'categoria' => 'Farándula',
                'etiquetas' => ['#urbano'],
                'autor' => 'José Rodríguez',
                'fecha' => '25 de julio, 2025',
                'imagen' => 'https://via.placeholder.com/600x400',
            ],
            [
                'titulo' => 'Licey gana el clásico del Caribe',
                'resumen' => 'El equipo dominicano logró la victoria en un juego emocionante.',
                'categoria' => 'Deportes',
                'etiquetas' => ['#beisbol'],
                'autor' => 'Ana Pérez',
                'fecha' => '24 de julio, 2025',
                'imagen' => 'https://via.placeholder.com/600x400',
            ],
            [
                'titulo' => 'Gobierno anuncia nuevas medidas económicas',
                'resumen' => 'Las políticas buscan incentivar las inversiones extranjeras.',
                'categoria' => 'Economía',
                'etiquetas' => ['#corrupción'],
                'autor' => 'Luis Santana',
                'fecha' => '20 de julio, 2025',
                'imagen' => 'https://via.placeholder.com/600x400',
            ],
        ];
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
            return $okCat && $okTag;
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
