@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6 space-y-6">
        @php $first = $posts[0] ?? null; @endphp
        @if($first)
            <div class="flex flex-col md:flex-row bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <img src="{{ App\Helpers\Wordpress::image($first) }}" alt="{{ $first['title']['rendered'] }}" class="w-full md:w-1/2 h-64 object-cover">
                <div class="p-4 flex flex-col">
                    <span class="text-sm text-blue-600 font-semibold">{{ App\Helpers\Wordpress::category($first) }}</span>
                    <h2 class="text-2xl font-bold mb-2">{!! $first['title']['rendered'] !!}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300 flex-1">{{ \Illuminate\Support\Str::limit(strip_tags($first['excerpt']['rendered']), 150) }}</p>
                    <a href="{{ url('/noticia/'.$first['slug']) }}" class="mt-4 text-blue-500 hover:underline">Leer más</a>
                </div>
            </div>
        @endif

        <div class="overflow-x-auto">
            <div class="flex space-x-2">
                @php $categories = collect($posts)->map(fn($p) => App\Helpers\Wordpress::category($p))->unique(); @endphp
                @foreach($categories as $cat)
                    <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-full text-sm">{{ $cat }}</span>
                @endforeach
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach($posts as $index => $post)
                @if($index == 0) @continue @endif
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden flex flex-col">
                    <img src="{{ App\Helpers\Wordpress::image($post) }}" alt="{{ $post['title']['rendered'] }}" class="h-48 w-full object-cover">
                    <div class="p-4 flex flex-col flex-1">
                        <span class="text-xs bg-blue-500 text-white rounded px-2 py-1 self-start">{{ App\Helpers\Wordpress::category($post) }}</span>
                        <h3 class="text-lg font-semibold mt-2">{!! $post['title']['rendered'] !!}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 flex-1">{{ \Illuminate\Support\Str::limit(strip_tags($post['excerpt']['rendered']), 100) }}</p>
                        <div class="flex flex-wrap gap-1 text-xs mb-2">
                            @foreach(App\Helpers\Wordpress::tags($post) as $tag)
                                <span class="text-blue-500">#{{ $tag }}</span>
                            @endforeach
                        </div>
                        <a href="{{ url('/noticia/'.$post['slug']) }}" class="text-blue-500 hover:underline mt-auto">Leer más</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
