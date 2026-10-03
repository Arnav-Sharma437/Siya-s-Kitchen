/**
 * Suyas Kitchen - Client Application Script
 * Vanilla JavaScript (No heavy frameworks)
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Sticky Header Scroll Effect
    const siteHeader = document.querySelector('.site-header');
    
    const handleScroll = () => {
        if (!siteHeader) return;
        if (window.scrollY > 40) {
            siteHeader.classList.add('scrolled');
        } else {
            siteHeader.classList.remove('scrolled');
        }
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll(); // Initial invocation

    // 2. Mobile Menu Toggle
    const mobileToggle = document.querySelector('.mobile-toggle');
    const mobileNav = document.querySelector('.mobile-nav');

    if (mobileToggle && mobileNav) {
        mobileToggle.addEventListener('click', () => {
            const isOpen = mobileNav.classList.toggle('open');
            mobileToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            mobileToggle.innerHTML = isOpen ? '✕' : '☰';
        });

        // Close menu when clicking outside or on a link
        document.addEventListener('click', (e) => {
            if (!mobileNav.contains(e.target) && !mobileToggle.contains(e.target) && mobileNav.classList.contains('open')) {
                mobileNav.classList.remove('open');
                mobileToggle.setAttribute('aria-expanded', 'false');
                mobileToggle.innerHTML = '☰';
            }
        });

        mobileNav.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileNav.classList.remove('open');
                mobileToggle.setAttribute('aria-expanded', 'false');
                mobileToggle.innerHTML = '☰';
            });
        });
    }

    // 3. Smooth scrolling for internal anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId && targetId !== '#') {
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
});
