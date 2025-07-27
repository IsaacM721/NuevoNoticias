<div>
    <div class="mb-4">
        <input type="search" wire:model.debounce.500ms="search" placeholder="Buscar..." class="w-full border rounded px-3 py-2" />
    </div>
    <div class="flex flex-wrap gap-2 mb-4">
        <button wire:click="setCategory('')" class="px-3 py-1 rounded text-sm {{ $category == '' ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200' }}">Todas</button>
        @foreach($categorias as $cat)
            <button wire:click="setCategory('{{ $cat }}')" class="px-3 py-1 rounded text-sm {{ $category == $cat ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200' }}">{{ $cat }}</button>
        @endforeach
    </div>
    <div class="flex flex-wrap gap-2 mb-6">
        @foreach($tags as $t)
            <button wire:click="setTag('{{ $t }}')" class="text-sm {{ $tag == $t ? 'text-blue-600' : 'text-gray-600 dark:text-gray-300' }} hover:underline">{{ $t }}</button>
        @endforeach
        @if($tag)
            <button wire:click="setTag('')" class="text-sm text-red-600 ml-2">Quitar filtro</button>
        @endif
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        @foreach($posts as $post)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-xl transition overflow-hidden flex flex-col">
                <img src="{{ $post['imagen'] }}" alt="{{ $post['titulo'] }}" class="h-48 w-full object-cover">
                <div class="p-4 flex flex-col flex-1">
                    <span class="text-xs bg-blue-500 text-white rounded px-2 py-1 self-start">{{ $post['categoria'] }}</span>
                    <h3 class="text-lg font-semibold mt-2">{{ $post['titulo'] }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-2 flex-1">{{ $post['resumen'] }}</p>
                    <div class="flex flex-wrap gap-1 text-xs mb-2">
                        @foreach($post['etiquetas'] as $et)
                            <span class="text-blue-500">{{ $et }}</span>
                        @endforeach
                    </div>
                    <span class="text-xs text-gray-500">{{ $post['autor'] }} - {{ $post['fecha'] }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>

