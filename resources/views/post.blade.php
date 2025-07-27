@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h1 class="text-3xl font-bold mb-4">{!! $post['title']['rendered'] !!}</h1>
            <img src="{{ App\Helpers\Wordpress::image($post) }}" alt="{{ $post['title']['rendered'] }}" class="w-full h-64 object-cover rounded mb-4">
            <div class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                <span>{{ App\Helpers\Wordpress::category($post) }}</span>
                <span class="mx-2">|</span>
                <span>{{ $post['_embedded']['author'][0]['name'] ?? '' }}</span>
                <span class="mx-2">|</span>
                <span>{{ \Carbon\Carbon::parse($post['date'])->format('d M Y') }}</span>
            </div>
            <div class="prose dark:prose-invert max-w-none">
                {!! $post['content']['rendered'] !!}
            </div>
        </div>
    </div>
@endsection
