<!DOCTYPE html>
<html lang="es" class="h-full" x-data="{ open: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'NoticiasDM' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' };
    </script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @livewireStyles
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors min-h-full flex flex-col">
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between space-x-4">
            <div class="font-bold text-xl text-blue-600">NoticiasDM</div>
            <div class="flex-1 hidden md:block">
                <input type="search" placeholder="Buscar..." class="w-full border rounded px-3 py-1" />
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <a href="#" class="text-sm hover:underline">Escritores</a>
                <a href="{{ route('login') }}" class="text-sm hover:underline">Escritor</a>
                <livewire:theme-toggle />
            </div>
            <button class="md:hidden text-gray-700 dark:text-gray-200" @click="open = !open">☰</button>
        </div>
        <div class="md:hidden" x-show="open" @click.away="open = false">
            <nav class="px-4 py-2 bg-white dark:bg-gray-800 border-t space-y-4">
                <div>
                    <h3 class="text-sm font-semibold mb-1">Categorías</h3>
                    <ul class="space-y-1">
                        <li><a href="#" class="block px-2 py-1">Política</a></li>
                        <li><a href="#" class="block px-2 py-1">Economía</a></li>
                        <li><a href="#" class="block px-2 py-1">Deportes</a></li>
                        <li><a href="#" class="block px-2 py-1">Farándula</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold mb-1">Etiquetas</h3>
                    <ul class="flex flex-wrap gap-2">
                        <li><a href="#" class="px-2 py-1 bg-gray-200 dark:bg-gray-700 rounded text-sm">#corrupción</a></li>
                        <li><a href="#" class="px-2 py-1 bg-gray-200 dark:bg-gray-700 rounded text-sm">#beisbol</a></li>
                        <li><a href="#" class="px-2 py-1 bg-gray-200 dark:bg-gray-700 rounded text-sm">#urbano</a></li>
                    </ul>
                </div>
                <a href="#" class="block px-2 py-1">Escritores</a>
                <a href="{{ route('login') }}" class="block px-2 py-1">Escritor</a>
                <livewire:theme-toggle />
            </nav>
        </div>
    </header>
    <main class="flex-1">
        @yield('content')
    </main>
    @livewireScripts
</body>
</html>

