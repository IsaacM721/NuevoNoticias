<div x-data="{ dark: localStorage.getItem('dark-mode') === 'true' }" x-init="$watch('dark', val => { localStorage.setItem('dark-mode', val); document.documentElement.classList.toggle('dark', val); });">
    <button @click="dark = !dark" class="text-gray-700 dark:text-gray-200 focus:outline-none">
        <span x-text="dark ? '☀️' : '🌙'"></span>
    </button>
</div>
