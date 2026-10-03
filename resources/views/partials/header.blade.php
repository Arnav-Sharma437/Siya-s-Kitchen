<header class="site-header">
    <div class="container">
        <div class="nav-wrapper">
            <!-- Brand Logo & Name -->
            <a href="{{ route('home') }}" class="brand-logo" title="{{ config('restaurant.name') }}">
                <img src="{{ asset('images/suyas-logo.jpg') }}" alt="{{ config('restaurant.name') }} Logo" class="brand-logo-img">
                <div class="brand-name-group">
                    <span class="brand-title">{{ config('restaurant.name') }}</span>
                    <span class="brand-subtitle">{{ config('restaurant.tagline') }}</span>
                </div>
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
                    <span class="location-icon">📍</span>
                    <span>{{ config('restaurant.contact.location_label') }}</span>
                </div>
                <a href="#order" class="btn btn-primary">
                    Order Now <span>&rarr;</span>
                </a>
                
                <!-- Mobile Navigation Toggle -->
                <button class="mobile-toggle" aria-label="Toggle navigation menu" aria-expanded="false">
                    ☰
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Navigation -->
    <div class="mobile-nav" id="mobileNav">
        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('menu') }}" class="nav-link {{ request()->routeIs('menu*') ? 'active' : '' }}">Menu</a>
        <a href="{{ route('home') }}#about" class="nav-link">About</a>
        <a href="{{ route('home') }}#gallery" class="nav-link">Gallery</a>
        <a href="{{ route('home') }}#contact" class="nav-link">Contact</a>
        <div class="mobile-nav-footer" style="padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.1); margin-top: 0.5rem;">
            <p style="color: var(--text-light-muted); font-size: 0.85rem; margin-bottom: 1rem;">📍 {{ config('restaurant.contact.address') }}</p>
            <a href="#order" class="btn btn-primary" style="width: 100%;">Order Now &rarr;</a>
        </div>
    </div>
</header>
