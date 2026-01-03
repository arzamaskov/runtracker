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

// Modal functionality
document.addEventListener('DOMContentLoaded', function() {
    // Open modal
    document.querySelectorAll('[data-open-modal]').forEach(button => {
        button.addEventListener('click', function() {
            const modalId = this.getAttribute('data-open-modal');
            const modal = document.getElementById(modalId);
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
            }

            if (modal) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        });
    });

    // Close modal
    document.querySelectorAll('[data-modal-close], [data-modal-backdrop]').forEach(element => {
        element.addEventListener('click', function() {
            const modal = this.closest('[id$="-modal"]');
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }
        });
    });

    // Close on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('[id$="-modal"]:not(.hidden)').forEach(modal => {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            });
        }
    });
});

