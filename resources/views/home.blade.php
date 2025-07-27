@extends('layouts.app')

@php use App\Helpers\Wordpress; @endphp

@section('content')
<div class="container mx-auto px-4 py-6 space-y-6">
    @if(count($posts))
        @php $featured = $posts[0]; $others = array_slice($posts,1); @endphp

        @php
            $categories = collect($posts)->pluck('category')->unique();
            $tags = collect($posts)->pluck('tags')->flatten()->unique();
        @endphp
        <div class="flex flex-wrap gap-2 mb-4">
            @foreach($categories as $cat)
                <span class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded text-sm">{{ $cat }}</span>
            @endforeach
        </div>
        <div class="flex flex-wrap gap-2 mb-6">
            @foreach($tags as $tag)
                <span class="text-sm text-blue-600">{{ $tag }}</span>
            @endforeach
        </div>

        <div class="md:flex bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
            <img src="{{ $featured['image'] }}" alt="{{ $featured['title'] }}" class="w-full md:w-1/2 h-64 object-cover">
            <div class="p-6 md:w-1/2 flex flex-col">
                <span class="text-xs bg-blue-600 text-white rounded px-2 py-1 self-start">{{ $featured['category'] }}</span>
                <h2 class="text-2xl font-bold mt-2">{{ $featured['title'] }}</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-300 flex-1">{{ $featured['excerpt'] }}</p>
                <div class="flex flex-wrap gap-1 text-xs mb-2">
                    @foreach($featured['tags'] as $t)
                        <span class="text-blue-500">{{ $t }}</span>
                    @endforeach
                </div>
                <span class="text-xs text-gray-500 mb-2">{{ $featured['author'] }} - {{ $featured['date'] }}</span>
                <a href="{{ route('post.show', $featured['slug']) }}" class="text-blue-600 hover:underline">Leer más</a>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach($others as $post)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-xl transition overflow-hidden flex flex-col">
                    <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="h-48 w-full object-cover">
                    <div class="p-4 flex flex-col flex-1">
                        <span class="text-xs bg-blue-500 text-white rounded px-2 py-1 self-start">{{ $post['category'] }}</span>
                        <h3 class="text-lg font-semibold mt-2">{{ $post['title'] }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-2 flex-1">{{ $post['excerpt'] }}</p>
                        <div class="flex flex-wrap gap-1 text-xs mb-2">
                            @foreach($post['tags'] as $et)
                                <span class="text-blue-500">{{ $et }}</span>
                            @endforeach
                        </div>
                        <span class="text-xs text-gray-500">{{ $post['author'] }} - {{ $post['date'] }}</span>
                        <a href="{{ route('post.show', $post['slug']) }}" class="text-blue-600 hover:underline mt-2">Leer más</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
