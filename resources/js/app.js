import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('mobile-menu');

    if (toggle && menu) {
        toggle.addEventListener('click', function() {
            const isOpen = !menu.classList.contains('hidden');

            menu.classList.toggle('hidden');
            toggle.setAttribute('aria-expanded', !isOpen);
        });
    }
});
