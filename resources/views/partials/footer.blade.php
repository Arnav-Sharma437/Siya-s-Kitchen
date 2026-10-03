<footer class="site-footer" id="contact">
    <div class="container">
        <div class="footer-grid">
            <!-- Brand Column -->
            <div class="footer-brand">
                <div class="footer-brand-logo">
                    <img src="{{ asset('images/suyas-logo.jpg') }}" alt="{{ config('restaurant.name') }} Logo">
                    <div class="brand-name-group">
                        <span class="brand-title" style="font-size: 1.25rem;">{{ config('restaurant.name') }}</span>
                        <span class="brand-subtitle">{{ config('restaurant.tagline') }}</span>
                    </div>
                </div>
                <p class="footer-brand-desc">
                    Authentic Indian cuisine in the heart of London. Fresh ingredients, traditional recipes and unforgettable flavours.
                </p>
                <div class="footer-social-links">
                    <a href="{{ config('restaurant.social.facebook') }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="Facebook">
                        <span style="font-weight: 700;">f</span>
                    </a>
                    <a href="{{ config('restaurant.social.instagram') }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="Instagram">
                        <span>📷</span>
                    </a>
                    <a href="{{ config('restaurant.social.tripadvisor') }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="Tripadvisor">
                        <span>🦉</span>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-col">
                <h4 class="footer-col-title">Quick Links</h4>
                <ul class="footer-links-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('menu') }}">Menu</a></li>
                    <li><a href="{{ route('home') }}#about">About</a></li>
                    <li><a href="{{ route('home') }}#gallery">Gallery</a></li>
                    <li><a href="{{ route('home') }}#contact">Contact</a></li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div class="footer-col">
                <h4 class="footer-col-title">Contact Us</h4>
                <div class="footer-contact-item">
                    <span class="footer-contact-icon">📍</span>
                    <span>{{ config('restaurant.contact.address') }}</span>
                </div>
                <div class="footer-contact-item">
                    <span class="footer-contact-icon">📞</span>
                    <a href="tel:{{ config('restaurant.contact.phone') }}">{{ config('restaurant.contact.phone') }}</a>
                </div>
                <div class="footer-contact-item">
                    <span class="footer-contact-icon">✉️</span>
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

        <!-- Bottom Bar with London Skyline Silhouette -->
        <div class="footer-bottom">
            <p>&copy; 2024 {{ config('restaurant.name') }} {{ config('restaurant.tagline') }}. All rights reserved.</p>
            
            <div class="footer-bottom-links">
                <a href="#privacy">Privacy Policy</a>
                <span style="color: rgba(255,255,255,0.2);">|</span>
                <a href="#terms">Terms & Conditions</a>
            </div>
        </div>
    </div>
</footer>
