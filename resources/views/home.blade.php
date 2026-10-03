@extends('layouts.app')

@section('title', config('restaurant.name') . ' - Authentic Indian Cuisine • London')

@section('content')
<!-- =========================================================================
     1. HERO SECTION
     ========================================================================= -->
<section class="hero-section" id="hero">
    <div class="container">
        <div class="hero-grid">
            <!-- Left Hero Content -->
            <div class="hero-content">
                <div class="hero-eyebrow">
                    <span>{{ config('restaurant.subtitle') }}</span>
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
                    <a href="{{ route('menu') }}" class="btn btn-primary">
                        Order Now <span>&rarr;</span>
                    </a>
                    <a href="{{ route('menu') }}" class="btn btn-outline-glass">
                        View Menu
                    </a>
                </div>
            </div>

            <!-- Right Hero Visual & Decorative Badge -->
            <div class="hero-visual">
                <div class="hero-dish-wrapper">
                    <div class="hero-glow-ring"></div>
                    <!-- Hero Signature Kadai Dish -->
                    <img src="{{ asset('images/home/hero-kadai.jpg') }}" alt="Suyas Kitchen Signature Sizzling Kadai Curry" class="hero-dish-img">
                    
                    <!-- Floating Script Accent Badge -->
                    <div class="hero-floating-badge">
                        <span class="heart-icon">♥</span>
                        <span class="script-text">Good Food</span>
                        <span class="badge-sub">Brings People Together</span>
                        <span class="heart-icon" style="margin-top: 0.15rem;">♥</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     2. FEATURE STRIP
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
                <div class="feature-icon-wrapper">🤍</div>
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
     3. POPULAR DISHES (OUR SPECIALTIES)
     ========================================================================= -->
<section class="section-padding" id="specialties">
    <div class="container">
        <div class="section-header">
            <div>
                <div class="section-eyebrow">OUR SPECIALTIES</div>
                <h2 class="section-title">
                    Popular Dishes
                    <span class="section-title-line"></span>
                </h2>
            </div>
            <a href="{{ route('menu') }}" class="btn btn-secondary">
                View Full Menu <span>&rarr;</span>
            </a>
        </div>

        <div class="dishes-grid">
            <!-- Butter Chicken -->
            <div class="dish-card">
                <div class="dish-card-img-wrapper">
                    <img src="{{ asset('images/dishes/butter-chicken.jpg') }}" alt="Butter Chicken" class="dish-card-img">
                </div>
                <div class="dish-card-body">
                    <h3 class="dish-card-title">Butter Chicken</h3>
                    <p class="dish-card-desc">Rich, creamy and full of flavour</p>
                </div>
            </div>

            <!-- Chicken Biryani -->
            <div class="dish-card">
                <div class="dish-card-img-wrapper">
                    <img src="{{ asset('images/dishes/chicken-biryani.jpg') }}" alt="Chicken Biryani" class="dish-card-img">
                </div>
                <div class="dish-card-body">
                    <h3 class="dish-card-title">Chicken Biryani</h3>
                    <p class="dish-card-desc">Aromatic rice with tender chicken</p>
                </div>
            </div>

            <!-- Paneer Tikka -->
            <div class="dish-card">
                <div class="dish-card-img-wrapper">
                    <img src="{{ asset('images/dishes/paneer-tikka.jpg') }}" alt="Paneer Tikka" class="dish-card-img">
                </div>
                <div class="dish-card-body">
                    <h3 class="dish-card-title">Paneer Tikka</h3>
                    <p class="dish-card-desc">Smoky, flavourful and delicious</p>
                </div>
            </div>

            <!-- Dal Tadka -->
            <div class="dish-card">
                <div class="dish-card-img-wrapper">
                    <img src="{{ asset('images/dishes/dal-tadka.jpg') }}" alt="Dal Tadka" class="dish-card-img">
                </div>
                <div class="dish-card-body">
                    <h3 class="dish-card-title">Dal Tadka</h3>
                    <p class="dish-card-desc">A classic favourite</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     4. ABOUT SUYAS KITCHEN
     ========================================================================= -->
<section class="about-section" id="about">
    <div class="container">
        <div class="about-grid">
            <div class="about-content-box">
                <div class="section-eyebrow">ABOUT SUYAS KITCHEN</div>
                <h2 class="section-title">
                    A Taste of India<br>
                    in the Heart of London
                </h2>
                <p>
                    Suyas Kitchen by Jalaram Group was created with a simple vision – to serve authentic Indian food prepared with fresh ingredients, traditional recipes and a whole lot of love. Whether you're dining with family, meeting friends or celebrating a special occasion, we are here to make it a memorable experience.
                </p>
                <a href="{{ route('menu') }}" class="btn btn-primary">
                    Our Story <span>&rarr;</span>
                </a>
            </div>
            <div class="about-img-box">
                <img src="{{ asset('images/home/about-interior.jpg') }}" alt="Suyas Kitchen London Restaurant Dining Room Ambiance">
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     5. OUR GALLERY (A GLIMPSE INSIDE)
     ========================================================================= -->
<section class="gallery-section" id="gallery">
    <div class="container">
        <div class="section-header">
            <div>
                <div class="section-eyebrow">A GLIMPSE INSIDE</div>
                <h2 class="section-title">
                    Our Gallery
                    <span class="section-title-line"></span>
                </h2>
            </div>
            <a href="{{ route('menu') }}" class="btn btn-secondary">
                View Gallery <span>&rarr;</span>
            </a>
        </div>

        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="{{ asset('images/gallery/gallery-1.jpg') }}" alt="Suyas Kitchen Restaurant Dining Room">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/gallery/gallery-2.jpg') }}" alt="Authentic Copper Kadai Curry Preparation">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/gallery/gallery-3.jpg') }}" alt="Suyas Kitchen Feature Wall and Ambiance">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/gallery/gallery-4.jpg') }}" alt="Freshly Baked Garlic Naan Bread">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/gallery/gallery-5.jpg') }}" alt="Warm Restaurant Dining Tables">
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     6. TESTIMONIALS (WHAT OUR GUESTS SAY)
     ========================================================================= -->
<section class="testimonials-section" id="testimonials">
    <div class="container">
        <div style="margin-bottom: 3rem;">
            <div class="section-eyebrow">WHAT OUR GUESTS SAY</div>
            <h2 class="section-title">Loved by Many</h2>
        </div>

        <div class="testimonials-grid">
            <!-- Testimonial 1 -->
            <div class="testimonial-card">
                <div>
                    <div class="testimonial-top-row">
                        <div class="testimonial-stars">★★★★★</div>
                        <span class="testimonial-quote-icon">❝</span>
                    </div>
                    <p class="testimonial-quote">
                        "Amazing food, friendly staff and a wonderful atmosphere. Truly authentic Indian taste in London!"
                    </p>
                </div>
                <div class="testimonial-author">Priya S.</div>
            </div>

            <!-- Testimonial 2 -->
            <div class="testimonial-card">
                <div>
                    <div class="testimonial-top-row">
                        <div class="testimonial-stars">★★★★★</div>
                        <span class="testimonial-quote-icon">❝</span>
                    </div>
                    <p class="testimonial-quote">
                        "Best Indian restaurant in London. The flavours are just like home. Highly recommended!"
                    </p>
                </div>
                <div class="testimonial-author">James T.</div>
            </div>

            <!-- Testimonial 3 -->
            <div class="testimonial-card">
                <div>
                    <div class="testimonial-top-row">
                        <div class="testimonial-stars">★★★★★</div>
                        <span class="testimonial-quote-icon">❝</span>
                    </div>
                    <p class="testimonial-quote">
                        "Fantastic food, great service and beautiful ambience. Will definitely visit again!"
                    </p>
                </div>
                <div class="testimonial-author">Sarah M.</div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     7. RESERVATION CTA BANNER
     ========================================================================= -->
<section class="reservation-section" id="reservation">
    <div class="container">
        <div class="reservation-banner">
            <div class="section-eyebrow">MAKE A RESERVATION</div>
            <h2 class="section-title">Join Us for a Memorable Dining Experience</h2>
            <p>
                Whether it's a family dinner, a special celebration or just a craving for authentic Indian food, we're here to welcome you.
            </p>
            <a href="tel:{{ config('restaurant.contact.phone') }}" class="btn btn-primary">
                Book a Table <span>&rarr;</span>
            </a>
        </div>
    </div>
</section>
@endsection
