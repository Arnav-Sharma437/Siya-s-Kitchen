@extends('layouts.app')

@section('title', 'Photo Gallery - ' . config('restaurant.name') . ' Harrow, London')
@section('meta_description', 'Browse our vibrant food gallery at ' . config('restaurant.name') . ' in Harrow, London. Authentic Gujarati street food, Surti specials, North Indian curries, and heartfelt hospitality.')

@section('content')
<!-- =========================================================================
     1. GALLERY HERO HEADER
     ========================================================================= -->
<section class="page-hero-section" style="background-image: linear-gradient(180deg, rgba(14, 10, 7, 0.8) 0%, rgba(14, 10, 7, 0.94) 100%), url('{{ asset('images/gallery/gallery-garlic-naan.jpg') }}'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="page-hero-content">
            <span class="section-eyebrow">VISUAL FEAST & MEMORIES</span>
            <h1 class="page-title">Our Food Gallery</h1>
            <p class="page-subtitle">
                A glimpse into our freshly prepared street food, live dhoklas, slow-simmered curries, and warm hospitality at Siya's Kitchen in Harrow.
            </p>
        </div>
    </div>
</section>

<!-- =========================================================================
     2. SIMPLE CLEAN PHOTO GALLERY GRID (NO FILTER BUTTONS)
     ========================================================================= -->
<section class="section-padding">
    <div class="container">
        <!-- Gallery Showcase Grid -->
        <div class="gallery-showcase-grid">
            <!-- 1. Dedicated to Siya Memorial Card -->
            <div class="gallery-card-item">
                <div class="gallery-card-img-wrap tribute-gallery-wrap">
                    <img src="{{ asset('images/tribute/dedicated-to-siya.png') }}" alt="Dedicated to Siya" class="gallery-card-img" loading="lazy">
                </div>
            </div>

            <!-- 2. Paneer Butter Masala -->
            <div class="gallery-card-item">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/dishes/butter-chicken.jpg') }}" alt="Paneer Butter Masala" class="gallery-card-img" loading="lazy">
                    <div class="gallery-caption-strip">
                        <span>Paneer Butter Masala</span>
                    </div>
                </div>
            </div>

            <!-- 3. Paneer Tikka Masala -->
            <div class="gallery-card-item">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/dishes/paneer-tikka.jpg') }}" alt="Paneer Tikka Masala" class="gallery-card-img" loading="lazy">
                    <div class="gallery-caption-strip">
                        <span>Paneer Tikka Masala</span>
                    </div>
                </div>
            </div>

            <!-- 4. Signature Sizzling Kadai -->
            <div class="gallery-card-item">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/home/hero-kadai.jpg') }}" alt="Sizzling Kadai Special" class="gallery-card-img" loading="lazy">
                    <div class="gallery-caption-strip">
                        <span>Sizzling Kadai Special</span>
                    </div>
                </div>
            </div>

            <!-- 5. Fresh Garlic Butter Naan -->
            <div class="gallery-card-item">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/gallery/gallery-garlic-naan.jpg') }}" alt="Chilli Garlic Naan" class="gallery-card-img" loading="lazy">
                    <div class="gallery-caption-strip">
                        <span>Chilli Garlic Butter Naan</span>
                    </div>
                </div>
            </div>

            <!-- 6. Hyderabadi Biryani -->
            <div class="gallery-card-item">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/dishes/chicken-biryani.jpg') }}" alt="Hyderabadi Dum Biryani" class="gallery-card-img" loading="lazy">
                    <div class="gallery-caption-strip">
                        <span>Hyderabadi Dum Biryani</span>
                    </div>
                </div>
            </div>

            <!-- 7. Yellow Dal Tadka -->
            <div class="gallery-card-item">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/dishes/dal-tadka.jpg') }}" alt="Dal Tadka & Gujarati Dal" class="gallery-card-img" loading="lazy">
                    <div class="gallery-caption-strip">
                        <span>Dal Tadka & Gujarati Dal</span>
                    </div>
                </div>
            </div>

            <!-- 8. Crispy Street Food & Pani Puri -->
            <div class="gallery-card-item">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/gallery/gallery-1.jpg') }}" alt="Pani Puri & Chaat" class="gallery-card-img" loading="lazy">
                    <div class="gallery-caption-strip">
                        <span>Crispy Pani Puri & Chaat</span>
                    </div>
                </div>
            </div>

            <!-- 9. Surti Locho & Khaman -->
            <div class="gallery-card-item">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/gallery/gallery-2.jpg') }}" alt="Surti Locho & Khaman" class="gallery-card-img" loading="lazy">
                    <div class="gallery-caption-strip">
                        <span>Live Surti Locho & Khaman</span>
                    </div>
                </div>
            </div>

            <!-- 10. Dining Room Atmosphere -->
            <div class="gallery-card-item">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/about/about-interior.jpg') }}" alt="Siya's Kitchen Harrow Interior" class="gallery-card-img" loading="lazy">
                    <div class="gallery-caption-strip">
                        <span>Warm Restaurant Atmosphere</span>
                    </div>
                </div>
            </div>

            <!-- 11. Tandoori Breads Basket -->
            <div class="gallery-card-item">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/gallery/gallery-4.jpg') }}" alt="Clay Oven Tandoori Breads" class="gallery-card-img" loading="lazy">
                    <div class="gallery-caption-strip">
                        <span>Clay Oven Tandoori Breads</span>
                    </div>
                </div>
            </div>

            <!-- 12. Roasted Whole Spices -->
            <div class="gallery-card-item">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/home/hero-bg.jpg') }}" alt="Authentic Spices & Flavours" class="gallery-card-img" loading="lazy">
                    <div class="gallery-caption-strip">
                        <span>Authentic Heritage Spices</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     3. CTA BANNER
     ========================================================================= -->
<section class="section-padding bg-cream-alt text-center">
    <div class="container" style="max-width: 700px;">
        <div class="section-eyebrow">ORDER ONLINE • INSTANT PREPARATION</div>
        <h2 class="section-title">Craving These Authentic Flavours?</h2>
        <p class="section-subtitle" style="margin-top: 0.75rem; margin-bottom: 2rem;">
            Order easily from our full digital menu for dine-in QR table service or fast takeaway in Harrow.
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('menu') }}" class="btn btn-primary">
                <span>View Full Digital Menu</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline">
                <span>Find Us in Harrow</span>
            </a>
        </div>
    </div>
</section>
@endsection
