<div class="container mx-auto p-4" x-data="{ openForm: false }">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Administrar Noticias</h2>
        <button @click="openForm = true; $wire.new()" class="bg-blue-600 text-white px-3 py-1 rounded">Nueva</button>
    </div>

    <div class="mb-6" x-show="openForm" @click.away="openForm = false">
        <form wire:submit.prevent="save" class="bg-white dark:bg-gray-800 p-4 rounded shadow">
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <input wire:model="title" type="text" placeholder="Título" class="border rounded px-2 py-1" required>
                <input wire:model="image_url" type="text" placeholder="URL de imagen" class="border rounded px-2 py-1">
                <input wire:model="category" type="text" placeholder="Categoría" class="border rounded px-2 py-1">
                <input wire:model="tags" type="text" placeholder="Etiquetas" class="border rounded px-2 py-1">
                <input wire:model="author_name" type="text" placeholder="Autor" class="border rounded px-2 py-1">
                <input wire:model="published_at" type="date" class="border rounded px-2 py-1">
            </div>
            <textarea wire:model="summary" placeholder="Resumen" class="w-full border rounded px-2 py-1 mb-2"></textarea>
            <textarea wire:model="content" placeholder="Contenido" class="w-full border rounded px-2 py-1 mb-2"></textarea>
            <div class="flex justify-end space-x-2">
                <button type="button" @click="openForm = false" class="px-3 py-1 bg-gray-300 rounded">Cancelar</button>
                <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded">Guardar</button>
            </div>
        </form>
    </div>

    <table class="min-w-full bg-white dark:bg-gray-800 rounded shadow">
        <thead>
            <tr>
                <th class="p-2 border-b">Título</th>
                <th class="p-2 border-b">Categoría</th>
                <th class="p-2 border-b">Publicado</th>
                <th class="p-2 border-b"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($newsList as $n)
                <tr class="border-b">
                    <td class="p-2">{{ $n->title }}</td>
                    <td class="p-2">{{ $n->category }}</td>
                    <td class="p-2">{{ optional($n->published_at)->format('Y-m-d') }}</td>
                    <td class="p-2 text-right space-x-2">
                        <button @click="openForm = true" wire:click="edit({{ $n->id }})" class="text-blue-600">Editar</button>
                        <button wire:click="delete({{ $n->id }})" class="text-red-600" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

