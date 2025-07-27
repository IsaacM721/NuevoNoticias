@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <form method="POST" action="{{ route('login') }}" class="max-w-sm mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
        @csrf
        <h2 class="text-xl mb-4 font-semibold text-center">Iniciar Sesión</h2>
        <div class="mb-4">
            <input type="email" name="email" placeholder="Email" required class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <input type="password" name="password" placeholder="Contraseña" required class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Entrar</button>
    </form>
</div>
@endsection
