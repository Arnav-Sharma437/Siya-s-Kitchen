<!-- =========================================================================
     MOBILE APP BOTTOM NAVIGATION BAR (iOS / Android Native App Feel)
     ========================================================================= -->
<nav class="mobile-app-bottom-bar" aria-label="Mobile Navigation">
    <div class="app-bottom-bar-inner">
        <!-- 1. Home -->
        <a href="{{ route('home') }}" class="app-bottom-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <svg class="app-nav-icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            <span class="app-nav-label">Home</span>
        </a>

        <!-- 2. Digital Menu -->
        <a href="{{ route('menu') }}" class="app-bottom-nav-item {{ request()->routeIs('menu*') ? 'active' : '' }}">
            <svg class="app-nav-icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/>
                <path d="M6 6h10M6 10h10M6 14h6"/>
            </svg>
            <span class="app-nav-label">Menu</span>
        </a>

        <!-- 3. Search -->
        <a href="{{ route('menu') }}#search" class="app-bottom-nav-item" id="appBottomSearchTrigger">
            <svg class="app-nav-icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/>
                <path d="m21 21-4.3-4.3"/>
            </svg>
            <span class="app-nav-label">Search</span>
        </a>

        <!-- 4. Basket / Cart -->
        <button type="button" class="app-bottom-nav-item app-cart-trigger-btn" id="appBottomCartBtn" aria-label="Open Cart">
            <div class="app-nav-cart-icon-wrap">
                <svg class="app-nav-icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
                    <path d="M3 6h18"/>
                    <path d="M16 10a4 4 0 0 1-8 0"/>
                </svg>
                <span class="app-cart-badge global-cart-count">0</span>
            </div>
            <span class="app-nav-label">Basket</span>
        </button>
    </div>
</nav>
