@extends('layouts.app')

@section('title', config('restaurant.name') . ' - Authentic Indian Cuisine • London')

@section('content')
<!-- =========================================================================
     HERO SECTION
     ========================================================================= -->
<section class="hero-section" id="hero">
    <div class="container">
        <div class="hero-grid">
            <!-- Left Hero Content -->
            <div class="hero-content">
                <div class="hero-eyebrow">
                    <span>{{ config('restaurant.subtitle') }}</span>
                    <span class="dot"></span>
                </div>
                <h1 class="hero-title">
                    Flavours<br>
                    That Feel Like<br>
                    <span class="highlight">Home</span>
                </h1>
                <p class="hero-description">
                    At {{ config('restaurant.name') }}, we bring you the true taste of India with fresh ingredients, traditional recipes and a warm, family-friendly atmosphere in the heart of London.
                </p>
                <div class="hero-buttons">
                    <a href="#order" class="btn btn-primary">
                        Order Now <span>&rarr;</span>
                    </a>
                    <a href="#menu-preview" class="btn btn-outline-glass">
                        View Menu
                    </a>
                </div>
            </div>

            <!-- Right Hero Visual & Decorative Badge -->
            <div class="hero-visual">
                <div class="hero-dish-wrapper">
                    <div class="hero-glow-ring"></div>
                    <!-- Hero Visual / Kadai Dish Preview -->
                    <img src="{{ asset('images/suyas-logo.jpg') }}" alt="Suyas Kitchen Special Signature Dish" class="hero-dish-img">
                    
                    <!-- Floating Script Accent Badge -->
                    <div class="hero-floating-badge">
                        <span class="heart-icon">♥</span>
                        <span class="script-text">Good Food</span>
                        <span class="badge-sub">Brings People Together</span>
                        <span class="heart-icon" style="margin-top: 0.2rem;">♥</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     FEATURE STRIP (Foundational preview - full features in next phase)
     ========================================================================= -->
<section class="feature-strip">
    <div class="container">
        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon-wrapper">🌿</div>
                <h3 class="feature-title">Fresh Ingredients</h3>
                <p class="feature-desc">Locally sourced with care</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon-wrapper">👨‍🍳</div>
                <h3 class="feature-title">Authentic Recipes</h3>
                <p class="feature-desc">Traditional Indian taste</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon-wrapper">❤️</div>
                <h3 class="feature-title">Family Friendly</h3>
                <p class="feature-desc">Warm & welcoming atmosphere</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon-wrapper">🛎️</div>
                <h3 class="feature-title">Perfect for Every Occasion</h3>
                <p class="feature-desc">Dine in • Takeaway • Catering</p>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     POPULAR DISHES (Foundational section structure - dynamic menu in next phase)
     ========================================================================= -->
<section class="section-padding" id="menu-preview">
    <div class="container">
        <div class="section-header">
            <div>
                <div class="section-eyebrow">Our Specialties</div>
                <h2 class="section-title">Popular Dishes</h2>
            </div>
            <a href="{{ route('menu') }}" class="btn btn-secondary">
                View Full Menu <span>&rarr;</span>
            </a>
        </div>

        <div class="dishes-grid">
            @forelse($featuredDishes as $dish)
            <div class="dish-card">
                <div class="dish-card-img-wrapper" style="display:flex; align-items:center; justify-content:center; background: #231B15; color: #D4A373;">
                    <span style="font-size: 2.5rem;">🍲</span>
                </div>
                <div class="dish-card-body">
                    <div style="display:flex; justify-content:space-between; align-items:baseline; margin-bottom: 0.35rem;">
                        <h3 class="dish-card-title">{{ $dish->name ?? $dish['name'] }}</h3>
                        <span style="color: var(--primary-terracotta); font-weight: 700; font-family: var(--font-serif);">
                            {{ $dish->formatted_price ?? $dish['price'] }}
                        </span>
                    </div>
                    <p class="dish-card-desc">{{ $dish->description ?? $dish['description'] }}</p>
                </div>
            </div>
            @empty
            <p style="color: var(--text-muted); grid-column: 1 / -1; text-align: center;">Explore our full selection on the digital menu.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- =========================================================================
     ABOUT PREVIEW (Foundational structure)
     ========================================================================= -->
<section class="about-preview-section" id="about">
    <div class="container">
        <div class="about-grid">
            <div class="about-img-box" style="background:#231B15; display:flex; align-items:center; justify-content:center; min-height:340px; border-radius:18px;">
                <img src="{{ asset('images/suyas-logo.jpg') }}" alt="About {{ config('restaurant.name') }}" style="max-width: 220px; border-radius: 50%;">
            </div>
            <div class="about-content-box">
                <div class="section-eyebrow">About {{ config('restaurant.name') }}</div>
                <h2 class="section-title">A Taste of India in the Heart of London</h2>
                <p>
                    {{ config('restaurant.name') }} {{ config('restaurant.tagline') }} was created with a simple vision — to serve authentic Indian food prepared with fresh ingredients, traditional recipes and a whole lot of love.
                </p>
                <a href="#our-story" class="btn btn-primary">Our Story <span>&rarr;</span></a>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     RESERVATION / CTA BANNER (Foundational structure)
     ========================================================================= -->
<section class="container" id="reservation">
    <div class="reservation-banner">
        <div class="section-eyebrow">Make a Reservation</div>
        <h2 class="section-title">Join Us for a Memorable Dining Experience</h2>
        <p>Whether it's a family dinner, a special celebration or just a craving for authentic Indian food, we're here to welcome you.</p>
        <a href="#book" class="btn btn-primary">Book a Table <span>&rarr;</span></a>
    </div>
</section>
@endsection
