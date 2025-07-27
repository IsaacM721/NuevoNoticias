<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class NewsManager extends Component
{
    public $newsList;

    public $newsId;
    public $title;
    public $summary;
    public $content;
    public $image_url;
    public $category;
    public $tags;
    public $author_name;
    public $published_at;

    protected $rules = [
        'title' => 'required',
        'summary' => 'nullable',
        'content' => 'nullable',
        'image_url' => 'nullable|url',
        'category' => 'nullable',
        'tags' => 'nullable',
        'author_name' => 'nullable',
        'published_at' => 'nullable|date',
    ];

    public function mount()
    {
        $this->loadNews();
    }

    public function loadNews()
    {
        $this->newsList = News::latest()->get();
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $this->newsId = $news->id;
        $this->title = $news->title;
        $this->summary = $news->summary;
        $this->content = $news->content;
        $this->image_url = $news->image_url;
        $this->category = $news->category;
        $this->tags = $news->tags;
        $this->author_name = $news->author_name;
        $this->published_at = optional($news->published_at)->format('Y-m-d');
    }

    public function new()
    {
        $this->reset(['newsId','title','summary','content','image_url','category','tags','author_name','published_at']);
    }

    public function save()
    {
        $this->validate();
        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'summary' => $this->summary,
            'content' => $this->content,
            'image_url' => $this->image_url,
            'category' => $this->category,
            'tags' => $this->tags,
            'author_name' => $this->author_name ?: (Auth::user()->name ?? 'Admin'),
            'published_at' => $this->published_at ? Carbon::parse($this->published_at) : now(),
        ];
        News::updateOrCreate(['id' => $this->newsId], $data);
        $this->new();
        $this->loadNews();
    }

    public function delete($id)
    {
        News::where('id',$id)->delete();
        $this->loadNews();
    }

    public function render()
    {
        return view('livewire.admin.news-manager');
    }
}
