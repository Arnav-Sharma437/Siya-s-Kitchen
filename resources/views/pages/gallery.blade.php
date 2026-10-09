@extends('layouts.app')

@section('title', 'Photo Gallery & Food Showcase - ' . config('restaurant.name') . ' Harrow, London')
@section('meta_description', 'Browse our vibrant food gallery at ' . config('restaurant.name') . ' in Harrow, London. Street food, Surti locho, paneer curries, tandoori breads, sweets, and warm restaurant ambiance.')

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
                A glimpse into our vibrant dishes, sizzling tandoori breads, live dhoklas, and heartfelt hospitality at Siya's Kitchen in Harrow.
            </p>
        </div>
    </div>
</section>

<!-- =========================================================================
     2. GALLERY CATEGORY FILTER & GRID
     ========================================================================= -->
<section class="section-padding">
    <div class="container">
        <!-- Interactive Category Filters -->
        <div class="gallery-filter-bar">
            <button type="button" class="gallery-filter-btn active" data-filter="all">All Photos</button>
            <button type="button" class="gallery-filter-btn" data-filter="street">Street Food & Chaat</button>
            <button type="button" class="gallery-filter-btn" data-filter="curries">Curries & Specialities</button>
            <button type="button" class="gallery-filter-btn" data-filter="breads">Tandoor & Rice</button>
            <button type="button" class="gallery-filter-btn" data-filter="tribute">Siya's Tribute</button>
            <button type="button" class="gallery-filter-btn" data-filter="ambiance">Ambiance</button>
        </div>

        <!-- Gallery Showcase Grid -->
        <div class="gallery-showcase-grid">
            <!-- 1. Dedicated to Siya Memorial Feature -->
            <div class="gallery-card-item" data-category="tribute">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/tribute/dedicated-to-siya.png') }}" alt="Dedicated to Siya Memorial Card" class="gallery-card-img" loading="lazy">
                    <div class="gallery-overlay">
                        <span class="gallery-overlay-badge">♥ In Loving Memory</span>
                        <h3 class="gallery-overlay-title">Dedicated to Siya</h3>
                        <p class="gallery-overlay-desc">"They stay in every flavor..."</p>
                        <a href="{{ route('about') }}#tribute" class="btn btn-sm btn-primary" style="margin-top: 0.5rem;">Read Story</a>
                    </div>
                </div>
            </div>

            <!-- 2. Paneer Butter Masala -->
            <div class="gallery-card-item" data-category="curries">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/dishes/dish-butter-chicken.jpg') }}" alt="Paneer Butter Masala" class="gallery-card-img" loading="lazy">
                    <div class="gallery-overlay">
                        <span class="gallery-overlay-badge">Punjabi Speciality</span>
                        <h3 class="gallery-overlay-title">Paneer Butter Masala</h3>
                        <p class="gallery-overlay-desc">Rich creamy tomato cashew gravy with fresh cottage cheese</p>
                        <a href="{{ route('menu') }}" class="btn btn-sm btn-primary" style="margin-top: 0.5rem;">Order Now</a>
                    </div>
                </div>
            </div>

            <!-- 3. Paneer Tikka Masala -->
            <div class="gallery-card-item" data-category="curries">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/dishes/dish-paneer-tikka.jpg') }}" alt="Paneer Tikka Masala" class="gallery-card-img" loading="lazy">
                    <div class="gallery-overlay">
                        <span class="gallery-overlay-badge">Chef Special</span>
                        <h3 class="gallery-overlay-title">Paneer Tikka Masala</h3>
                        <p class="gallery-overlay-desc">Smoky chargrilled paneer cubes in spiced aromatic gravy</p>
                        <a href="{{ route('menu') }}" class="btn btn-sm btn-primary" style="margin-top: 0.5rem;">Order Now</a>
                    </div>
                </div>
            </div>

            <!-- 4. Sizzling Signature Kadai -->
            <div class="gallery-card-item" data-category="curries">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/home/hero-kadai.jpg') }}" alt="Signature Sizzling Kadai Special" class="gallery-card-img" loading="lazy">
                    <div class="gallery-overlay">
                        <span class="gallery-overlay-badge">Siya's Signature</span>
                        <h3 class="gallery-overlay-title">Sizzling Kadai Curry</h3>
                        <p class="gallery-overlay-desc">Freshly crushed whole spices, bell peppers and slow-simmered gravy</p>
                        <a href="{{ route('menu') }}" class="btn btn-sm btn-primary" style="margin-top: 0.5rem;">Order Now</a>
                    </div>
                </div>
            </div>

            <!-- 5. Fresh Garlic Naan -->
            <div class="gallery-card-item" data-category="breads">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/gallery/gallery-garlic-naan.jpg') }}" alt="Chilli Garlic Butter Naan" class="gallery-card-img" loading="lazy">
                    <div class="gallery-overlay">
                        <span class="gallery-overlay-badge">Indian Breads</span>
                        <h3 class="gallery-overlay-title">Chilli Garlic Butter Naan</h3>
                        <p class="gallery-overlay-desc">Clay-oven baked fluffy naan brushed with garlic butter & fresh coriander</p>
                        <a href="{{ route('menu') }}" class="btn btn-sm btn-primary" style="margin-top: 0.5rem;">Order Now</a>
                    </div>
                </div>
            </div>

            <!-- 6. Hyderabadi Veg Biryani -->
            <div class="gallery-card-item" data-category="breads">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/dishes/dish-biryani.jpg') }}" alt="Hyderabadi Dum Biryani" class="gallery-card-img" loading="lazy">
                    <div class="gallery-overlay">
                        <span class="gallery-overlay-badge">Rice & Biryani</span>
                        <h3 class="gallery-overlay-title">Hyderabadi Dum Biryani</h3>
                        <p class="gallery-overlay-desc">Aromatic basmati rice layered with saffron, herbs, and spiced vegetables</p>
                        <a href="{{ route('menu') }}" class="btn btn-sm btn-primary" style="margin-top: 0.5rem;">Order Now</a>
                    </div>
                </div>
            </div>

            <!-- 7. Dal Tadka / Gujarati Dal -->
            <div class="gallery-card-item" data-category="curries">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/dishes/dish-dal.jpg') }}" alt="Yellow Dal Tadka" class="gallery-card-img" loading="lazy">
                    <div class="gallery-overlay">
                        <span class="gallery-overlay-badge">Dal & Kadhi</span>
                        <h3 class="gallery-overlay-title">Dal Tadka & Gujarati Dal</h3>
                        <p class="gallery-overlay-desc">Yellow lentils tempered with cumin, garlic, dried red chillies and ghee</p>
                        <a href="{{ route('menu') }}" class="btn btn-sm btn-primary" style="margin-top: 0.5rem;">Order Now</a>
                    </div>
                </div>
            </div>

            <!-- 8. Street Food & Chaat Special -->
            <div class="gallery-card-item" data-category="street">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/gallery/gallery-1.jpg') }}" alt="Indian Street Food & Pani Puri" class="gallery-card-img" loading="lazy">
                    <div class="gallery-overlay">
                        <span class="gallery-overlay-badge">Street Food</span>
                        <h3 class="gallery-overlay-title">Crispy Pani Puri & Sev Puri</h3>
                        <p class="gallery-overlay-desc">Tangy mint water, spiced ragda, tamarind chutney and crunchy puris</p>
                        <a href="{{ route('menu') }}" class="btn btn-sm btn-primary" style="margin-top: 0.5rem;">Order Now</a>
                    </div>
                </div>
            </div>

            <!-- 9. Surti Locho & Live Dhokla -->
            <div class="gallery-card-item" data-category="street">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/gallery/gallery-2.jpg') }}" alt="Live Surti Locho & Khaman" class="gallery-card-img" loading="lazy">
                    <div class="gallery-overlay">
                        <span class="gallery-overlay-badge">Surti Special</span>
                        <h3 class="gallery-overlay-title">Butter Cheese Locho</h3>
                        <p class="gallery-overlay-desc">Steamed Gujarati delicacy topped with melted butter, cheese, and crunchy sev</p>
                        <a href="{{ route('menu') }}" class="btn btn-sm btn-primary" style="margin-top: 0.5rem;">Order Now</a>
                    </div>
                </div>
            </div>

            <!-- 10. Dining Room Ambiance -->
            <div class="gallery-card-item" data-category="ambiance">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/about/about-interior.jpg') }}" alt="Siya's Kitchen Restaurant Dining Room" class="gallery-card-img" loading="lazy">
                    <div class="gallery-overlay">
                        <span class="gallery-overlay-badge">Harrow Restaurant</span>
                        <h3 class="gallery-overlay-title">Warm Dining Atmosphere</h3>
                        <p class="gallery-overlay-desc">Family-friendly dining room on Alexandra Avenue, Harrow</p>
                        <a href="{{ route('contact') }}" class="btn btn-sm btn-primary" style="margin-top: 0.5rem;">Visit Us</a>
                    </div>
                </div>
            </div>

            <!-- 11. Tandoori Roti & Breads Basket -->
            <div class="gallery-card-item" data-category="breads">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/gallery/gallery-4.jpg') }}" alt="Fresh Tandoori Breads Basket" class="gallery-card-img" loading="lazy">
                    <div class="gallery-overlay">
                        <span class="gallery-overlay-badge">Indian Breads</span>
                        <h3 class="gallery-overlay-title">Tandoori Roti & Naan Platter</h3>
                        <p class="gallery-overlay-desc">Served hot from our clay tandoor oven</p>
                        <a href="{{ route('menu') }}" class="btn btn-sm btn-primary" style="margin-top: 0.5rem;">Order Now</a>
                    </div>
                </div>
            </div>

            <!-- 12. Heritage Spice Blends -->
            <div class="gallery-card-item" data-category="ambiance">
                <div class="gallery-card-img-wrap">
                    <img src="{{ asset('images/home/hero-bg.jpg') }}" alt="Fresh Whole Heritage Spices" class="gallery-card-img" loading="lazy">
                    <div class="gallery-overlay">
                        <span class="gallery-overlay-badge">Authentic Heritage</span>
                        <h3 class="gallery-overlay-title">Whole Roasted Spices</h3>
                        <p class="gallery-overlay-desc">Hand-picked cardamom, cloves, star anise and cinnamon</p>
                        <a href="{{ route('about') }}" class="btn btn-sm btn-primary" style="margin-top: 0.5rem;">Our Story</a>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const filterBtns = document.querySelectorAll('.gallery-filter-btn');
    const cards = document.querySelectorAll('.gallery-card-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');

            cards.forEach(card => {
                const category = card.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeInCard 0.4s ease forwards';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endpush
