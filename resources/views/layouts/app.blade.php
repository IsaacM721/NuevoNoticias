<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'NoticiasDM' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' };
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors min-h-full flex flex-col">
    <nav class="bg-white dark:bg-gray-800 shadow">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="font-bold text-xl text-blue-600">NoticiasDM</div>
            <div class="hidden md:flex items-center space-x-4">
                <input type="search" placeholder="Buscar..." class="border rounded px-2 py-1 text-sm">
                <a href="#" class="text-gray-700 dark:text-gray-200">Escritores</a>
                <a href="#" class="text-gray-700 dark:text-gray-200">Escritor</a>
                <button id="theme-toggle" class="text-gray-700 dark:text-gray-200 focus:outline-none">🌙</button>
            </div>
            <button class="md:hidden text-gray-700 dark:text-gray-200">☰</button>
        </div>
    </nav>
    <main class="flex-1">
        @yield('content')
    </main>
    <script src="{{ asset('js/dark-mode.js') }}"></script>
</body>
</html>
