/*
 * Kimlay admin — light interactions
 * Mobile sidebar toggle, confirm dialogs on delete forms, dismissable/auto
 * hiding success alerts.
 */

(() => {
    'use strict';

    /* ------------------------------------------------ Mobile sidebar */
    const shell = document.querySelector('[data-admin-shell]');
    const burger = document.getElementById('adminBurger');

    const closeNav = () => {
        document.body.classList.remove('nav-open');
        shell?.classList.remove('nav-open');
        burger?.setAttribute('aria-expanded', 'false');
    };

    burger?.addEventListener('click', () => {
        const open = document.body.classList.toggle('nav-open');
        burger.setAttribute('aria-expanded', String(open));
        shell?.classList.toggle('nav-open', open);
    });

    document.addEventListener('click', (event) => {
        if (!shell?.classList.contains('nav-open')) return;
        const sidebar = document.querySelector('.admin-sidebar');
        if (!sidebar?.contains(event.target) && event.target !== burger) {
            closeNav();
        }
    });

    /* ------------------------------------------- Delete confirmations */
    document.querySelectorAll('[data-confirm]').forEach((form) => {
        const message = form.dataset.confirm || 'Are you sure?';
        form.addEventListener('submit', (event) => {
            if (!window.confirm(message)) {
                event.preventDefault();
            }
        });
    });

    /* --------------------------------------- Auto-hide success alerts */
    document.querySelectorAll('[data-autohide]').forEach((alert) => {
        let timer = null;

        const fade = () => {
            if (!alert.isConnected) return;
            alert.style.transition = 'opacity 0.4s ease';
            alert.style.opacity = '0';
            window.setTimeout(() => alert.remove(), 400);
        };

        const start = () => {
            timer = window.setTimeout(fade, 4000);
        };

        const cancel = () => {
            if (timer) window.clearTimeout(timer);
        };

        alert.addEventListener('pointerenter', cancel);
        alert.addEventListener('pointerleave', start);

        window.setTimeout(start, 300);
    });
})();