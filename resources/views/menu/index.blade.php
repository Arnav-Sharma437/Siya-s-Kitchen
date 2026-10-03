@extends('layouts.app')

@section('title', 'Digital Menu - ' . config('restaurant.name') . ' London')
@section('meta_description', 'Explore the full digital menu of ' . config('restaurant.name') . ' in London. Authentic Indian curries, tandoori grills, dum biryanis, fresh naans, and delicious desserts.')

@section('content')
<!-- Menu Page Header Banner with High-Res Background Texture -->
<section class="menu-page-header" style="background-image: linear-gradient(180deg, rgba(14, 10, 7, 0.78) 0%, rgba(14, 10, 7, 0.92) 100%), url('{{ asset('images/home/hero-bg.jpg') }}'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="section-eyebrow">{{ config('restaurant.subtitle') }}</div>
        <h1 class="page-title">Digital Restaurant Menu</h1>
        <p class="page-subtitle">
            Authentic flavours of India crafted with locally sourced fresh ingredients and time-honoured culinary traditions.
        </p>
    </div>
</section>

<!-- Category Quick-Jump Navigation Bar -->
@if($categories->isNotEmpty())
<nav class="menu-nav-bar" aria-label="Menu Categories">
    <div class="container">
        <div class="category-pills-wrapper">
            @foreach($categories as $category)
                <a href="#category-{{ $category->slug }}" class="category-pill">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
</nav>
@endif

<!-- Menu Listing by Category -->
<div class="container" style="padding-bottom: 5rem;">
    @forelse($categories as $category)
        <section class="menu-category-section" id="category-{{ $category->slug }}">
            <div class="menu-category-header">
                <div>
                    <h2 class="menu-category-title">
                        <span class="title-line"></span>
                        {{ $category->name }}
                    </h2>
                    @if($category->description)
                        <p class="menu-category-description">{{ $category->description }}</p>
                    @endif
                </div>
            </div>

            <div class="menu-items-grid">
                @forelse($category->menuItems as $item)
                    <article class="menu-item-card {{ $item->is_featured ? 'is-featured' : '' }}">
                        <div>
                            <div class="menu-item-header">
                                <div class="menu-item-name-group">
                                    <h3 class="menu-item-name">{{ $item->name }}</h3>
                                    
                                    <!-- Dietary & Status Badges with Crisp SVGs -->
                                    <div class="menu-item-badges">
                                        @if($item->is_featured)
                                            <span class="diet-badge featured">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                                </svg>
                                                Featured
                                            </span>
                                        @endif

                                        @if($item->is_vegetarian)
                                            <span class="diet-badge veg" title="Vegetarian">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <rect width="20" height="20" x="2" y="2" rx="3"/>
                                                    <circle cx="12" cy="12" r="5" fill="currentColor"/>
                                                </svg>
                                                Veg
                                            </span>
                                        @endif

                                        @if($item->is_vegan)
                                            <span class="diet-badge vegan" title="Vegan">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M11 20A7 7 0 0 1 4 13C4 7 11 3 11 3s7 4 7 10a7 7 0 0 1-7 7Z"/>
                                                </svg>
                                                Vegan
                                            </span>
                                        @endif

                                        @if($item->is_spicy)
                                            <span class="diet-badge spicy" title="Spicy">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12 2C8 6 6 10 6 14a6 6 0 0 0 12 0c0-4-2-8-6-12Z"/>
                                                </svg>
                                                Spicy
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Formatted GBP Price -->
                                <span class="menu-item-price-tag">{{ $item->formatted_price }}</span>
                            </div>

                            <!-- Description -->
                            @if($item->description)
                                <p class="menu-item-desc">{{ $item->description }}</p>
                            @endif
                        </div>

                        <!-- Variations & Addons Preview -->
                        @if($item->variations->isNotEmpty() || $item->addons->isNotEmpty())
                            <div class="menu-item-customizations">
                                @if($item->variations->isNotEmpty())
                                    <div class="customization-row">
                                        <span class="customization-label">Portions:</span>
                                        @foreach($item->variations as $var)
                                            <span class="customization-pill">
                                                {{ $var->name }} &bull; <span class="diff-price">{{ $var->formatted_price }}</span>
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                @if($item->addons->isNotEmpty())
                                    <div class="customization-row">
                                        <span class="customization-label">Extras:</span>
                                        @foreach($item->addons as $addon)
                                            <span class="customization-pill">
                                                + {{ $addon->name }} (<span class="diff-price">{{ $addon->formatted_price }}</span>)
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif
                    </article>
                @empty
                    <p style="color: var(--text-muted); font-style: italic;">No items currently available in this category.</p>
                @endforelse
            </div>
        </section>
    @empty
        <div style="text-align: center; padding: 5rem 0;">
            <h3>Menu items are currently being updated.</h3>
            <p style="color: var(--text-muted); margin-top: 0.5rem;">Please check back shortly or contact our London team.</p>
        </div>
    @endforelse
</div>
@endsection
