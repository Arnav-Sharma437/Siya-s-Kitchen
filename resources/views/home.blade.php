@extends('layouts.app')

@section('title', config('restaurant.name') . ' - Authentic Indian Cuisine • London')

@section('content')
<!-- =========================================================================
     1. HERO SECTION WITH BACKGROUND BANNER IMAGE
     ========================================================================= -->
<section class="hero-section" id="hero" style="background-image: url('{{ asset('images/home/hero-bg.jpg') }}'); background-size: cover; background-position: center;">
    <div class="container">
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
                <a href="{{ route('menu') }}" class="btn btn-secondary" style="background: rgba(255, 255, 255, 0.9); color: var(--text-dark); border-color: rgba(255, 255, 255, 0.9);">
                    <span>View Menu</span>
                </a>
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
     3. DEDICATED TO SIYA - HEARTFELT MEMORIAL SECTION
     ========================================================================= -->
<section class="section-padding tribute-home-strip" style="background: linear-gradient(135deg, rgba(22, 16, 12, 0.96) 0%, rgba(35, 23, 16, 0.98) 100%); color: #FFFFFF; position: relative; overflow: hidden; border-top: 1px solid rgba(212, 163, 115, 0.25); border-bottom: 1px solid rgba(212, 163, 115, 0.25);">
    <div class="container">
        <div class="tribute-home-grid">
            <div class="tribute-home-img-wrap">
                <img src="{{ asset('images/tribute/dedicated-to-siya1.png') }}" alt="Dedicated to Siya" class="tribute-home-img" loading="lazy">
            </div>
            <div class="tribute-home-content">
                <div class="tribute-eyebrow">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#D9531E">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    <span>DEDICATED TO SIYA</span>
                </div>
                <h2 class="tribute-heading" style="color: #FFFFFF;">
                    Some People Never Leave...<br>
                    <span class="highlight">They Stay in Every Flavor.</span>
                </h2>
                <p class="tribute-text" style="color: var(--text-light-muted); font-size: 1.08rem; line-height: 1.7; margin: 1.25rem 0 1.75rem;">
                    Her spirit lives on in the recipes she cherished and the warmth of this kitchen. This restaurant is a tribute to her memory — a celebration of love, flavor, and family.
                </p>
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="{{ route('about') }}#tribute" class="btn btn-primary">
                        <span>Read Siya's Story</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('menu') }}" class="btn btn-outline-glass">
                        <span>View Tribute Menu</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     4. POPULAR DISHES (OUR SPECIALTIES - HIGH RES FOOD PHOTOGRAPHY)
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
            @if(isset($featuredDishes) && $featuredDishes->isNotEmpty())
                @foreach($featuredDishes as $dish)
                    @php
                        $dishImg = $dish->image ? asset($dish->image) : asset('images/dishes/butter-chicken.jpg');
                        if (str_contains($dish->slug, 'paneer')) {
                            $dishImg = asset('images/dishes/paneer-tikka.jpg');
                        } elseif (str_contains($dish->slug, 'biryani')) {
                            $dishImg = asset('images/dishes/chicken-biryani.jpg');
                        } elseif (str_contains($dish->slug, 'dal') || str_contains($dish->slug, 'kadhi')) {
                            $dishImg = asset('images/dishes/dal-tadka.jpg');
                        }
                    @endphp
                    <div class="dish-card">
                        <div class="dish-card-img-wrapper">
                            <img src="{{ $dishImg }}" alt="{{ $dish->name }}" class="dish-card-img" loading="lazy">
                            <span class="dish-card-price">{{ $dish->formatted_price }}</span>
                        </div>
                        <div class="dish-card-body">
                            <h3 class="dish-card-title">{{ $dish->name }}</h3>
                            <p class="dish-card-desc">{{ $dish->short_description ?? Str::limit($dish->description, 80) }}</p>
                            <a href="{{ route('menu') }}" class="btn btn-secondary btn-sm" style="margin-top: auto; padding: 0.5rem 1rem; width: 100%;">
                                View on Menu &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Butter Chicken -->
                <div class="dish-card">
                    <div class="dish-card-img-wrapper">
                        <img src="{{ asset('images/dishes/butter-chicken.jpg') }}" alt="Paneer Butter Masala" class="dish-card-img" loading="lazy">
                        <span class="dish-card-price">£10.49</span>
                    </div>
                    <div class="dish-card-body">
                        <h3 class="dish-card-title">Paneer Butter Masala</h3>
                        <p class="dish-card-desc">Rich, creamy and full of authentic flavours</p>
                        <a href="{{ route('menu') }}" class="btn btn-secondary btn-sm" style="margin-top: auto; padding: 0.5rem 1rem; width: 100%;">
                            View on Menu &rarr;
                        </a>
                    </div>
                </div>

                <!-- Biryani -->
                <div class="dish-card">
                    <div class="dish-card-img-wrapper">
                        <img src="{{ asset('images/dishes/chicken-biryani.jpg') }}" alt="Hyderabadi Biryani" class="dish-card-img" loading="lazy">
                        <span class="dish-card-price">£9.00</span>
                    </div>
                    <div class="dish-card-body">
                        <h3 class="dish-card-title">Hyderabadi Biryani</h3>
                        <p class="dish-card-desc">Aromatic long-grain basmati rice with royal spices</p>
                        <a href="{{ route('menu') }}" class="btn btn-secondary btn-sm" style="margin-top: auto; padding: 0.5rem 1rem; width: 100%;">
                            View on Menu &rarr;
                        </a>
                    </div>
                </div>

                <!-- Paneer Tikka -->
                <div class="dish-card">
                    <div class="dish-card-img-wrapper">
                        <img src="{{ asset('images/dishes/paneer-tikka.jpg') }}" alt="Paneer Tikka Masala" class="dish-card-img" loading="lazy">
                        <span class="dish-card-price">£10.49</span>
                    </div>
                    <div class="dish-card-body">
                        <h3 class="dish-card-title">Paneer Tikka Masala</h3>
                        <p class="dish-card-desc">Smoky, tandoori grilled and velvety spiced</p>
                        <a href="{{ route('menu') }}" class="btn btn-secondary btn-sm" style="margin-top: auto; padding: 0.5rem 1rem; width: 100%;">
                            View on Menu &rarr;
                        </a>
                    </div>
                </div>

                <!-- Dal Tadka -->
                <div class="dish-card">
                    <div class="dish-card-img-wrapper">
                        <img src="{{ asset('images/dishes/dal-tadka.jpg') }}" alt="Dal Tadka" class="dish-card-img" loading="lazy">
                        <span class="dish-card-price">£8.00</span>
                    </div>
                    <div class="dish-card-body">
                        <h3 class="dish-card-title">Dal Tadka</h3>
                        <p class="dish-card-desc">Double-tempered yellow lentils with garlic & ghee</p>
                        <a href="{{ route('menu') }}" class="btn btn-secondary btn-sm" style="margin-top: auto; padding: 0.5rem 1rem; width: 100%;">
                            View on Menu &rarr;
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- =========================================================================
     5. ABOUT SIYA'S KITCHEN (HIGH RES INTERIOR PHOTOGRAPHY)
     ========================================================================= -->
<section class="about-section" id="about">
    <div class="container">
        <div class="about-grid">
            <div class="about-content-box">
                <div class="section-eyebrow">ABOUT SIYA'S KITCHEN</div>
                <h2 class="section-title">
                    A Taste of India<br>
                    in Harrow, London
                </h2>
                <p>
                    Siya's Kitchen by Jalaram Group was created with a simple vision – to serve authentic Gujarati delicacies, Surti snacks, and North Indian curries prepared with fresh ingredients, traditional recipes, and unconditional love in memory of Siya.
                </p>
                <a href="{{ route('about') }}" class="btn btn-primary">
                    <span>Read Our Full Story</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            <div class="about-img-box">
                <img src="{{ asset('images/about/about-interior.jpg') }}" alt="Siya's Kitchen Harrow Restaurant Dining Room Ambiance" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     6. OUR GALLERY (HIGH RES PHOTOGRAPHY)
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
            <a href="{{ route('gallery') }}" class="btn btn-secondary">
                <span>View Full Gallery</span>
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
