// Sidebar toggle for mobile
const toggle = document.getElementById('sidebar-toggle');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebar-overlay');
const closeBtn = document.getElementById('sidebar-close');

function openSidebar() {
    sidebar.classList.remove('-translate-x-full');
    overlay.classList.remove('hidden');
    toggle.classList.add('hidden');  // Скрыть гамбургер
}

function closeSidebar() {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
    toggle.classList.remove('hidden');  // Показать гамбургер
}

toggle.addEventListener('click', openSidebar);
closeBtn.addEventListener('click', closeSidebar);
overlay.addEventListener('click', closeSidebar);
