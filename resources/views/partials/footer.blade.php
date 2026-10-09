<footer class="site-footer" id="contact">
    <div class="container">
        <div class="footer-grid">
            <!-- Brand Column -->
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="footer-brand-logo" aria-label="{{ config('restaurant.name') }}" title="{{ config('restaurant.name') }}">
                    <img src="{{ asset('images/siyas-logo.jpg') }}" alt="{{ config('restaurant.name') }} Logo">
                </a>
                <p class="footer-brand-desc">
                    Authentic Gujarati delicacies, Surti snacks, and North Indian curries in Harrow, London.
                </p>
                <div class="footer-tribute-pill">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#D9531E" stroke="#D9531E">
                        <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                    </svg>
                    <span>In Cherished Memory of Siya</span>
                </div>
                <div class="footer-social-links" style="margin-top: 1rem;">
                    <!-- Facebook -->
                    <a href="{{ config('restaurant.social.facebook') }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="Facebook">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                        </svg>
                    </a>
                    <!-- Instagram -->
                    <a href="{{ config('restaurant.social.instagram') }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="Instagram">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                        </svg>
                    </a>
                    <!-- Tripadvisor / Dining Reviews -->
                    <a href="{{ config('restaurant.social.tripadvisor') }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="Tripadvisor">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <circle cx="6.5" cy="14.5" r="2.5"/>
                            <circle cx="17.5" cy="14.5" r="2.5"/>
                            <path d="M12 2C6.5 2 2 6.5 2 12c0 3.2 1.5 6 3.9 7.8l-1.9 2.2h16l-1.9-2.2C20.5 18 22 15.2 22 12c0-5.5-4.5-10-10-10zm-5.5 15c-1.4 0-2.5-1.1-2.5-2.5S5.1 12 6.5 12s2.5 1.1 2.5 2.5S7.9 17 6.5 17zm5.5-3c-.8 0-1.5-.7-1.5-1.5S11.2 11 12 11s1.5.7 1.5 1.5-.7 1.5-1.5 1.5zm5.5 3c-1.4 0-2.5-1.1-2.5-2.5s1.1-2.5 2.5-2.5 2.5 1.1 2.5 2.5-1.1 2.5-2.5 2.5z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-col">
                <h4 class="footer-col-title">Explore</h4>
                <ul class="footer-links-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('menu') }}">Digital Menu</a></li>
                    <li><a href="{{ route('about') }}">About Us & Tribute</a></li>
                    <li><a href="{{ route('gallery') }}">Food Gallery</a></li>
                    <li><a href="{{ route('contact') }}">Contact & Location</a></li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div class="footer-col">
                <h4 class="footer-col-title">Harrow Location</h4>
                <div class="footer-contact-item">
                    <svg class="footer-contact-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                    <span>{{ config('restaurant.contact.address') }}</span>
                </div>
                <div class="footer-contact-item">
                    <svg class="footer-contact-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                    <a href="tel:{{ config('restaurant.contact.phone') }}">{{ config('restaurant.contact.formatted_phone') }}</a>
                </div>
                <div class="footer-contact-item">
                    <svg class="footer-contact-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="16" x="2" y="4" rx="2"/>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                    </svg>
                    <a href="mailto:{{ config('restaurant.contact.email') }}">{{ config('restaurant.contact.email') }}</a>
                </div>
            </div>

            <!-- Opening Hours -->
            <div class="footer-col">
                <h4 class="footer-col-title">Opening Hours</h4>
                <div class="footer-hours-row">
                    <span>Mon – Thu</span>
                    <span>{{ config('restaurant.opening_hours.mon_thu') }}</span>
                </div>
                <div class="footer-hours-row">
                    <span>Fri – Sat</span>
                    <span>{{ config('restaurant.opening_hours.fri_sat') }}</span>
                </div>
                <div class="footer-hours-row">
                    <span>Sun</span>
                    <span>{{ config('restaurant.opening_hours.sun') }}</span>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} {{ config('restaurant.name') }} {{ config('restaurant.tagline') }}. Dedicated with love to Siya.</p>
            
            <div class="footer-bottom-links">
                <a href="{{ route('about') }}#tribute">Siya's Story</a>
                <span style="color: rgba(255,255,255,0.2);">|</span>
                <a href="{{ route('contact') }}">Find Us</a>
            </div>
        </div>
    </div>
</footer>
