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

// Swipe to open/close sidebar
let touchStartX = 0;
let touchStartY = 0;
let touchEndX = 0;

document.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
    touchStartY = e.changedTouches[0].screenY;
}, { passive: true });

document.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].screenX;
    const touchEndY = e.changedTouches[0].screenY;

    const diffX = touchEndX - touchStartX;
    const diffY = Math.abs(touchEndY - touchStartY);

    // Swipe must be horizontal (diffX > diffY) and at least 80px
    if (Math.abs(diffX) > 80 && diffX > diffY) {
        const isSidebarOpen = !sidebar.classList.contains('-translate-x-full');

        // Swipe right from left edge (< 50px) to open
        if (diffX > 0 && touchStartX < 50 && !isSidebarOpen) {
            openSidebar();
        }
        // Swipe left to close
        else if (diffX < 0 && isSidebarOpen) {
            closeSidebar();
        }
    }
}, { passive: true });
