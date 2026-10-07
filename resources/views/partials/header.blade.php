<header class="site-header">
    <div class="container">
        <div class="nav-wrapper">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-logo" aria-label="{{ config('restaurant.name') }}" title="{{ config('restaurant.name') }}">
                <img src="{{ asset('images/siyas-logo.jpg') }}" alt="{{ config('restaurant.name') }} Logo" class="brand-logo-img">
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="desktop-nav" aria-label="Main Navigation">
                <ul class="nav-links">
                    <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('menu') }}" class="nav-link {{ request()->routeIs('menu*') ? 'active' : '' }}">Menu</a></li>
                    <li><a href="{{ route('home') }}#about" class="nav-link">About</a></li>
                    <li><a href="{{ route('home') }}#gallery" class="nav-link">Gallery</a></li>
                    <li><a href="{{ route('home') }}#contact" class="nav-link">Contact</a></li>
                </ul>
            </nav>

            <!-- Location & Action CTA -->
            <div class="nav-actions">
                <div class="location-badge" title="Location">
                    <svg class="nav-svg-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                    <span>{{ config('restaurant.contact.location_label') }}</span>
                </div>
                <!-- Live Cart Trigger Button -->
                <button type="button" class="nav-cart-btn" id="headerCartBtn" aria-label="View Shopping Cart">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
                        <path d="M3 6h18"/>
                        <path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                    <span class="cart-badge-count global-cart-count">0</span>
                </button>

                <a href="{{ route('menu') }}" class="btn btn-primary nav-order-btn">
                    <span>Order Now</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
                
                <!-- Mobile Navigation Toggle -->
                <button class="mobile-toggle" aria-label="Toggle navigation menu" aria-expanded="false">
                    <svg class="toggle-icon-open" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Navigation Overlay -->
    <div class="mobile-nav" id="mobileNav">
        <div class="mobile-nav-top">
            <a href="{{ route('home') }}" class="brand-logo" aria-label="{{ config('restaurant.name') }}">
                <img src="{{ asset('images/siyas-logo.jpg') }}" alt="{{ config('restaurant.name') }} Logo" class="brand-logo-img" style="width: 48px; height: 48px;">
            </a>
            <button type="button" class="mobile-nav-close" id="mobileNavCloseBtn" aria-label="Close menu">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="mobile-nav-links">
            <a href="{{ route('home') }}" class="mobile-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('menu') }}" class="mobile-nav-item {{ request()->routeIs('menu*') ? 'active' : '' }}">Digital Menu</a>
            <a href="{{ route('home') }}#about" class="mobile-nav-item">About Us</a>
            <a href="{{ route('home') }}#gallery" class="mobile-nav-item">Gallery</a>
            <a href="{{ route('home') }}#contact" class="mobile-nav-item">Contact & Hours</a>
        </div>
        <div class="mobile-nav-footer">
            <p class="mobile-nav-address">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
                {{ config('restaurant.contact.address') }}
            </p>
            <a href="{{ route('menu') }}" class="btn btn-primary" style="width: 100%; justify-content: center;">
                <span>Explore Full Menu</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</header>
