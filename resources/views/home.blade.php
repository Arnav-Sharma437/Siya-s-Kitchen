@extends('layouts.app')

@section('title', config('restaurant.name') . ' - Authentic Indian Cuisine • London')

@section('content')
<!-- =========================================================================
     1. HERO SECTION WITH BACKGROUND BANNER IMAGE
     ========================================================================= -->
<section class="hero-section" id="hero" style="background-image: linear-gradient(180deg, rgba(14, 10, 7, 0.72) 0%, rgba(14, 10, 7, 0.88) 100%), url('{{ asset('images/home/hero-bg.jpg') }}');">
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
                        <span>Order Now</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="{{ route('menu') }}" class="btn btn-outline-glass">
                        <span>View Menu</span>
                    </a>
                </div>
            </div>

            <!-- Right Hero Visual & Decorative Badge -->
            <div class="hero-visual">
                <div class="hero-dish-wrapper">
                    <div class="hero-glow-ring"></div>
                    <!-- Ultra High-Res Sizzling Kadai Curry -->
                    <img src="{{ asset('images/home/hero-kadai.jpg') }}" alt="Siya's Kitchen Signature Sizzling Kadai Curry" class="hero-dish-img">
                    
                    <!-- Floating Script Accent Badge -->
                    <div class="hero-floating-badge">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="#D9531E" stroke="#D9531E">
                            <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                        </svg>
                        <span class="script-text">Good Food</span>
                        <span class="badge-sub">Brings People Together</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="#D9531E" stroke="#D9531E" style="margin-top: 0.15rem;">
                            <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     2. FEATURE STRIP (CRISP SVG ICONS)
     ========================================================================= -->
<section class="feature-strip">
    <div class="container">
        <div class="features-grid">
            <!-- Fresh Ingredients -->
            <div class="feature-item">
                <div class="feature-icon-wrapper">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 20A7 7 0 0 1 4 13C4 7 11 3 11 3s7 4 7 10a7 7 0 0 1-7 7Z"/>
                        <path d="M11 20v-7"/>
                    </svg>
                </div>
                <h3 class="feature-title">Fresh Ingredients</h3>
                <p class="feature-desc">Locally sourced with care</p>
            </div>

            <!-- Authentic Recipes -->
            <div class="feature-item">
                <div class="feature-icon-wrapper">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 13.87A4 4 0 0 1 7.41 6a5.11 5.11 0 0 1 1.05-1.54 5 5 0 0 1 7.08 0A5.11 5.11 0 0 1 16.59 6 4 4 0 0 1 18 13.87V21H6Z"/>
                        <line x1="6" y1="17" x2="18" y2="17"/>
                    </svg>
                </div>
                <h3 class="feature-title">Authentic Recipes</h3>
                <p class="feature-desc">Traditional Indian taste</p>
            </div>

            <!-- Family Friendly -->
            <div class="feature-item">
                <div class="feature-icon-wrapper">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                    </svg>
                </div>
                <h3 class="feature-title">Family Friendly</h3>
                <p class="feature-desc">Warm & welcoming atmosphere</p>
            </div>

            <!-- Perfect for Every Occasion -->
            <div class="feature-item">
                <div class="feature-icon-wrapper">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 11V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v0"/>
                        <path d="M14 10V4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v2"/>
                        <path d="M10 10.5V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v8"/>
                        <path d="M18 8a2 2 0 1 1 4 0v6a8 8 0 0 1-8 8h-2c-2.8 0-4.5-.86-5.99-2.34l-3.6-3.6a2 2 0 0 1 2.83-2.82L7 15"/>
                    </svg>
                </div>
                <h3 class="feature-title">Perfect for Every Occasion</h3>
                <p class="feature-desc">Dine in • Takeaway • Catering</p>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     3. POPULAR DISHES (OUR SPECIALTIES - HIGH RES FOOD PHOTOGRAPHY)
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
                <span>View Full Menu</span>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="dishes-grid">
            <!-- Butter Chicken -->
            <div class="dish-card">
                <div class="dish-card-img-wrapper">
                    <img src="{{ asset('images/dishes/butter-chicken.jpg') }}" alt="Butter Chicken" class="dish-card-img" loading="lazy">
                </div>
                <div class="dish-card-body">
                    <h3 class="dish-card-title">Butter Chicken</h3>
                    <p class="dish-card-desc">Rich, creamy and full of flavour</p>
                </div>
            </div>

            <!-- Chicken Biryani -->
            <div class="dish-card">
                <div class="dish-card-img-wrapper">
                    <img src="{{ asset('images/dishes/chicken-biryani.jpg') }}" alt="Chicken Biryani" class="dish-card-img" loading="lazy">
                </div>
                <div class="dish-card-body">
                    <h3 class="dish-card-title">Chicken Biryani</h3>
                    <p class="dish-card-desc">Aromatic rice with tender chicken</p>
                </div>
            </div>

            <!-- Paneer Tikka -->
            <div class="dish-card">
                <div class="dish-card-img-wrapper">
                    <img src="{{ asset('images/dishes/paneer-tikka.jpg') }}" alt="Paneer Tikka" class="dish-card-img" loading="lazy">
                </div>
                <div class="dish-card-body">
                    <h3 class="dish-card-title">Paneer Tikka</h3>
                    <p class="dish-card-desc">Smoky, flavourful and delicious</p>
                </div>
            </div>

            <!-- Dal Tadka -->
            <div class="dish-card">
                <div class="dish-card-img-wrapper">
                    <img src="{{ asset('images/dishes/dal-tadka.jpg') }}" alt="Dal Tadka" class="dish-card-img" loading="lazy">
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
     4. ABOUT SIYA'S KITCHEN (HIGH RES INTERIOR PHOTOGRAPHY)
     ========================================================================= -->
<section class="about-section" id="about">
    <div class="container">
        <div class="about-grid">
            <div class="about-content-box">
                <div class="section-eyebrow">ABOUT SIYA'S KITCHEN</div>
                <h2 class="section-title">
                    A Taste of India<br>
                    in the Heart of London
                </h2>
                <p>
                    Siya's Kitchen by Jalaram Group was created with a simple vision – to serve authentic Indian food prepared with fresh ingredients, traditional recipes and a whole lot of love. Whether you're dining with family, meeting friends or celebrating a special occasion, we are here to make it a memorable experience.
                </p>
                <a href="{{ route('menu') }}" class="btn btn-primary">
                    <span>Our Story</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            <div class="about-img-box">
                <img src="{{ asset('images/home/about-interior.jpg') }}" alt="Siya's Kitchen London Restaurant Dining Room Ambiance" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     5. OUR GALLERY (HIGH RES PHOTOGRAPHY)
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
                <span>View Gallery</span>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="{{ asset('images/gallery/gallery-1.jpg') }}" alt="Siya's Kitchen Restaurant Dining Room" loading="lazy">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/gallery/gallery-2.jpg') }}" alt="Authentic Copper Kadai Curry Preparation" loading="lazy">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/gallery/gallery-3.jpg') }}" alt="Charred Tandoori Paneer Skewers" loading="lazy">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/gallery/gallery-4.jpg') }}" alt="Freshly Baked Garlic Naan Bread" loading="lazy">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/gallery/gallery-5.jpg') }}" alt="Warm Candlelight Dining Table Setup" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     6. TESTIMONIALS (CLEAN GOLD SVG STARS & VECTOR QUOTE ICONS)
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
                        <div class="testimonial-stars">
                            @for($i = 0; $i < 5; $i++)
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="#E5A93C" style="display:inline-block; margin-right: 2px;">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                            @endfor
                        </div>
                        <svg class="testimonial-quote-icon" width="28" height="28" viewBox="0 0 24 24" fill="rgba(212, 163, 115, 0.4)">
                            <path d="M3 21c3 0 7-1 7-8V5c0-1.25-.75-2-2-2H4c-1.25 0-2 .75-2 2v6c0 1.25.75 2 2 2h3c0 3.25-2.25 5-4 5v3zm14 0c3 0 7-1 7-8V5c0-1.25-.75-2-2-2h-4c-1.25 0-2 .75-2 2v6c0 1.25.75 2 2 2h3c0 3.25-2.25 5-4 5v3z"/>
                        </svg>
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
                        <div class="testimonial-stars">
                            @for($i = 0; $i < 5; $i++)
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="#E5A93C" style="display:inline-block; margin-right: 2px;">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                            @endfor
                        </div>
                        <svg class="testimonial-quote-icon" width="28" height="28" viewBox="0 0 24 24" fill="rgba(212, 163, 115, 0.4)">
                            <path d="M3 21c3 0 7-1 7-8V5c0-1.25-.75-2-2-2H4c-1.25 0-2 .75-2 2v6c0 1.25.75 2 2 2h3c0 3.25-2.25 5-4 5v3zm14 0c3 0 7-1 7-8V5c0-1.25-.75-2-2-2h-4c-1.25 0-2 .75-2 2v6c0 1.25.75 2 2 2h3c0 3.25-2.25 5-4 5v3z"/>
                        </svg>
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
                        <div class="testimonial-stars">
                            @for($i = 0; $i < 5; $i++)
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="#E5A93C" style="display:inline-block; margin-right: 2px;">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                            @endfor
                        </div>
                        <svg class="testimonial-quote-icon" width="28" height="28" viewBox="0 0 24 24" fill="rgba(212, 163, 115, 0.4)">
                            <path d="M3 21c3 0 7-1 7-8V5c0-1.25-.75-2-2-2H4c-1.25 0-2 .75-2 2v6c0 1.25.75 2 2 2h3c0 3.25-2.25 5-4 5v3zm14 0c3 0 7-1 7-8V5c0-1.25-.75-2-2-2h-4c-1.25 0-2 .75-2 2v6c0 1.25.75 2 2 2h3c0 3.25-2.25 5-4 5v3z"/>
                        </svg>
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
     7. RESERVATION CTA BANNER (HIGH RES TEXTURED SPICES BACKGROUND)
     ========================================================================= -->
<section class="reservation-section" id="reservation">
    <div class="container">
        <div class="reservation-banner" style="background-image: linear-gradient(rgba(18, 13, 10, 0.78), rgba(18, 13, 10, 0.88)), url('{{ asset('images/home/reservation-bg.jpg') }}');">
            <div class="section-eyebrow">MAKE A RESERVATION</div>
            <h2 class="section-title">Join Us for a Memorable Dining Experience</h2>
            <p>
                Whether it's a family dinner, a special celebration or just a craving for authentic Indian food, we're here to welcome you.
            </p>
            <a href="tel:{{ config('restaurant.contact.phone') }}" class="btn btn-primary">
                <span>Book a Table</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@endsection
