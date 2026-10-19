/*
 * Kimlay portfolio — interactions
 * Vanilla JS: navbar state, mobile menu, scroll reveals, stat counters,
 * active-section highlighting, service-card spotlight, back-to-top, form UX.
 */

(() => {
    'use strict';

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ---------------------------------------------------------- Navbar */
    const navbar = document.getElementById('navbar');
    const backToTop = document.getElementById('backToTop');

    const onScroll = () => {
        navbar?.classList.toggle('is-scrolled', window.scrollY > 24);
        backToTop?.classList.toggle('is-visible', window.scrollY > 640);
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    backToTop?.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: prefersReducedMotion ? 'auto' : 'smooth' });
    });

    /* ------------------------------------------------------ Mobile menu */
    const navToggle = document.getElementById('navToggle');
    const navLinks = document.getElementById('navLinks');

    const closeMenu = () => {
        document.body.classList.remove('nav-open');
        navToggle?.setAttribute('aria-expanded', 'false');
    };

    navToggle?.addEventListener('click', () => {
        const open = document.body.classList.toggle('nav-open');
        navToggle.setAttribute('aria-expanded', String(open));
    });

    navLinks?.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', closeMenu);
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') closeMenu();
    });

    /* ------------------------------------------------ Reveal on scroll */
    const revealEls = document.querySelectorAll('.reveal');

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        revealEls.forEach((el) => el.classList.add('is-visible'));
    } else {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-visible');
                revealObserver.unobserve(entry.target);
            });
        }, { threshold: 0.16, rootMargin: '0px 0px -36px 0px' });

        revealEls.forEach((el) => revealObserver.observe(el));
    }

    /* --------------------------------------------------------- Counters */
    const counters = document.querySelectorAll('[data-count]');

    const animateCounter = (el) => {
        const target = Number(el.dataset.count || 0);
        const suffix = el.dataset.suffix || '';
        const duration = 1500;
        const start = performance.now();

        const step = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.round(target * eased) + suffix;
            if (progress < 1) requestAnimationFrame(step);
        };

        el.textContent = '0' + suffix;
        requestAnimationFrame(step);
    };

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        counters.forEach((el) => {
            el.textContent = (el.dataset.count || '') + (el.dataset.suffix || '');
        });
    } else {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                animateCounter(entry.target);
                counterObserver.unobserve(entry.target);
            });
        }, { threshold: 0.6 });

        counters.forEach((el) => counterObserver.observe(el));
    }

    /* --------------------------------------------- Active section link */
    const sectionLinks = new Map();

    document.querySelectorAll('.navbar__link[data-nav-link]').forEach((link) => {
        const id = (link.getAttribute('href') || '').replace('#', '');
        if (id) sectionLinks.set(id, link);
    });

    const sections = [...sectionLinks.keys()]
        .map((id) => document.getElementById(id))
        .filter(Boolean);

    if (sections.length && 'IntersectionObserver' in window) {
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                sectionLinks.forEach((link) => link.classList.remove('is-active'));
                sectionLinks.get(entry.target.id)?.classList.add('is-active');
            });
        }, { rootMargin: '-40% 0px -55% 0px', threshold: 0 });

        sections.forEach((section) => sectionObserver.observe(section));
    }

    /* ------------------------------------------ Service card spotlight */
    document.querySelectorAll('.service-card').forEach((card) => {
        card.addEventListener('pointermove', (event) => {
            const rect = card.getBoundingClientRect();
            card.style.setProperty('--mx', (event.clientX - rect.left) + 'px');
            card.style.setProperty('--my', (event.clientY - rect.top) + 'px');
        });
    });

    /* -------------------------------------------------- Contact form UX */
    const form = document.getElementById('contactForm');

    form?.addEventListener('submit', () => {
        const button = form.querySelector('[data-contact-submit]');
        if (!button) return;
        button.disabled = true;
        const label = button.querySelector('span');
        if (label) label.textContent = 'Sending…';
    });
})();
