document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('theme-toggle');
    if (!toggle) return;
    const html = document.documentElement;
    if (localStorage.getItem('dark-mode') === 'true') {
        html.classList.add('dark');
    }
    toggle.addEventListener('click', () => {
        html.classList.toggle('dark');
        localStorage.setItem('dark-mode', html.classList.contains('dark'));
    });
});
