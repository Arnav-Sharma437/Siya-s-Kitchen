@extends('layouts.app')

@section('title', 'About Us & Dedicated to Siya - ' . config('restaurant.name') . ' Harrow, London')
@section('meta_description', 'Discover the heartfelt story behind Siya\'s Kitchen in Harrow, London. Born as a loving tribute to Siya, serving authentic Gujarati street food, Surti specials, and North Indian curries made with everlasting love.')

@section('content')
<!-- =========================================================================
     1. ABOUT HERO HEADER
     ========================================================================= -->
<section class="page-hero-section" style="background-image: linear-gradient(180deg, rgba(14, 10, 7, 0.78) 0%, rgba(14, 10, 7, 0.92) 100%), url('{{ asset('images/about/about-interior.jpg') }}'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="page-hero-content">
            <span class="section-eyebrow">OUR STORY & HEART</span>
            <h1 class="page-title">Flavours Born From Love</h1>
            <p class="page-subtitle">
                A warm family kitchen in Harrow, London created in cherished memory of Siya — bringing authentic heritage recipes, joy, and togetherness to every table.
            </p>
        </div>
    </div>
</section>

<!-- =========================================================================
     2. DEDICATED TO SIYA - HEARTFELT MEMORIAL TRIBUTE SECTION
     ========================================================================= -->
<section class="section-padding tribute-special-section" id="tribute">
    <div class="container">
        <div class="tribute-wrapper">
            <!-- Left Tribute Memorial Card -->
            <div class="tribute-card-visual">
                <div class="tribute-frame">
                    <img src="{{ asset('images/tribute/dedicated-to-siya1.png') }}" alt="Dedicated to Siya - Siya's Kitchen Tribute" class="tribute-img" loading="lazy">
                    <div class="tribute-badge-pill">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="#D9531E" stroke="#D9531E">
                            <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                        </svg>
                        <span>In Loving Memory</span>
                    </div>
                </div>
            </div>

            <!-- Right Tribute Story & Words -->
            <div class="tribute-content">
                <div class="tribute-eyebrow">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#D9531E">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    <span>DEDICATED TO SIYA</span>
                </div>
                
                <h2 class="tribute-heading">
                    Some People Never Leave...<br>
                    <span class="highlight">They Stay in Every Flavor.</span>
                </h2>

                <div class="tribute-quote-box">
                    <p class="tribute-quote-main">
                        "Her spirit lives on in the recipes she cherished and the warmth of this kitchen. This menu is a tribute to her memory — a celebration of love, flavor, and family."
                    </p>
                    <p class="tribute-quote-sub">
                        "As you dine, we invite you to feel her presence, taste her passion, and share in the everlasting joy she brought to us all."
                    </p>
                </div>

                <div class="tribute-details-bar">
                    <div class="tribute-detail-item">
                        <div class="detail-icon-circle">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <div>
                            <strong>{{ config('restaurant.contact.address') }}</strong>
                            <span>Harrow, London</span>
                        </div>
                    </div>

                    <div class="tribute-detail-item">
                        <div class="detail-icon-circle">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        </div>
                        <div>
                            <strong>{{ config('restaurant.contact.formatted_phone') }}</strong>
                            <span>Direct Table Booking & Takeaway</span>
                        </div>
                    </div>
                </div>

                <div class="tribute-actions">
                    <a href="{{ route('menu') }}" class="btn btn-primary">
                        <span>Explore Our Tribute Menu</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline">
                        <span>Visit Us in Harrow</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     3. OUR CULINARY VALUES & HERITAGE
     ========================================================================= -->
<section class="section-padding bg-cream-alt">
    <div class="container">
        <div class="section-header-center">
            <div class="section-eyebrow">OUR ETHOS & PASSION</div>
            <h2 class="section-title">Crafted with Tradition, Served with Warmth</h2>
            <div class="section-title-line"></div>
            <p class="section-subtitle">
                Every spice blend ground in-house, every locho steamed live, and every curry slow-simmered to perfection.
            </p>
        </div>

        <div class="features-grid">
            <!-- 1. Pure Vegetarian & Heritage -->
            <div class="feature-item">
                <div class="feature-icon-wrapper">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 20A7 7 0 0 1 4 13C4 7 11 3 11 3s7 4 7 10a7 7 0 0 1-7 7Z"/>
                        <path d="M11 20v-7"/>
                    </svg>
                </div>
                <h3 class="feature-title">Pure Vegetarian Soul</h3>
                <p class="feature-desc">100% pure vegetarian kitchen with extensive vegan and Jain-friendly options prepared with utmost devotion.</p>
            </div>

            <!-- 2. Authentic Surti & Gujarati Delicacies -->
            <div class="feature-item">
                <div class="feature-icon-wrapper">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 13.87A4 4 0 0 1 7.41 6a5.11 5.11 0 0 1 1.05-1.54 5 5 0 0 1 7.08 0A5.11 5.11 0 0 1 16.59 6 4 4 0 0 1 18 13.87V21H6Z"/>
                        <line x1="6" y1="17" x2="18" y2="17"/>
                    </svg>
                </div>
                <h3 class="feature-title">Surti & Kathiyawadi Roots</h3>
                <p class="feature-desc">From live Surti locho, rasawala khaman, and sev usal to spicy Sev Tameta and Kaju Gathiya curries.</p>
            </div>

            <!-- 3. Street-Style Favourites -->
            <div class="feature-item">
                <div class="feature-icon-wrapper">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="m4.93 4.93 4.24 4.24"/>
                        <path d="m14.83 9.17 4.24-4.24"/>
                        <path d="m14.83 14.83 4.24 4.24"/>
                        <path d="m9.17 14.83-4.24 4.24"/>
                    </svg>
                </div>
                <h3 class="feature-title">Iconic Indian Street Food</h3>
                <p class="feature-desc">Crispy Pani Puri with freshly blended mint water, spicy fried Vadapav, Katka Dabeli, and loaded Chaats.</p>
            </div>

            <!-- 4. Family Hospitality -->
            <div class="feature-item">
                <div class="feature-icon-wrapper">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                    </svg>
                </div>
                <h3 class="feature-title">Welcoming Family Vibe</h3>
                <p class="feature-desc">By Jalaram Group — we greet every guest like family, ensuring a comfortable, heart-warming dining experience.</p>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     4. PHOTO STORY / GLIMPSE
     ========================================================================= -->
<section class="section-padding">
    <div class="container">
        <div class="about-grid">
            <div class="about-img-box">
                <img src="{{ asset('images/about/about-interior.jpg') }}" alt="Siya's Kitchen Dining Room Ambiance" class="about-main-img" loading="lazy">
            </div>

            <div class="about-content-box">
                <div class="section-eyebrow">A PLACE OF TOGETHERNESS</div>
                <h2 class="section-title">
                    Every Meal is a Celebration of Life & Family
                </h2>
                <p class="about-text">
                    Located on Alexandra Avenue in Harrow, Siya's Kitchen was created as a sanctuary where friends, families, and food lovers can gather over steaming bowls of Indori poha, hot buttered pav bhaji, fragrant biryanis, and traditional Gujarati kadhi.
                </p>
                <p class="about-text">
                    Whether you are dining in with us to experience our table QR ordering or taking away your favourite comfort food, our mission remains simple: to serve genuine food made with the purest ingredients and unconditional love.
                </p>

                <div class="about-badges-grid">
                    <div class="about-badge-item">
                        <span class="badge-number">100%</span>
                        <span class="badge-label">Pure Veg & Fresh</span>
                    </div>
                    <div class="about-badge-item">
                        <span class="badge-number">13+</span>
                        <span class="badge-label">Menu Categories</span>
                    </div>
                    <div class="about-badge-item">
                        <span class="badge-number">Harrow</span>
                        <span class="badge-label">London Location</span>
                    </div>
                </div>

                <div style="margin-top: 2rem; display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="{{ route('gallery') }}" class="btn btn-secondary">
                        <span>View Photo Gallery</span>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-primary">
                        <span>Reserve a Table</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
