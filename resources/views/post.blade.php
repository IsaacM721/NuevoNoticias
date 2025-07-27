@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
            <img src="{{ $post->image_url ?: 'https://via.placeholder.com/800x400' }}" alt="{{ $post->title }}" class="w-full h-64 object-cover rounded mb-4">
            <div class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                <span>{{ $post->category }}</span>
                <span class="mx-2">|</span>
                <span>{{ $post->author_name }}</span>
                <span class="mx-2">|</span>
                <span>{{ optional($post->published_at)->format('d M Y') }}</span>
            </div>
            <div class="prose dark:prose-invert max-w-none">
                {!! $post->content !!}
            </div>
        </div>
    </div>
@endsection
