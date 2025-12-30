import './bootstrap';
import '../css/app.css';

// Mobile menu toggle
document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.querySelector('[aria-controls="mobile-menu"]');
    const mobileMenu = document.getElementById('mobile-menu');

    if (menuButton && mobileMenu) {
        // Hide menu by default
        mobileMenu.classList.add('hidden');

        menuButton.addEventListener('click', () => {
            const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';

            // Toggle aria-expanded
            menuButton.setAttribute('aria-expanded', !isExpanded);

            // Toggle mobile menu visibility
            mobileMenu.classList.toggle('hidden');

            // Toggle hamburger/close icons
            const icons = menuButton.querySelectorAll('svg');
            icons.forEach(icon => icon.classList.toggle('hidden'));
        });
    }
});