@extends('layouts.app')

@section('title', 'Digital Menu & Online Ordering - ' . config('restaurant.name') . ' London')
@section('meta_description', 'Browse the authentic digital menu for ' . config('restaurant.name') . ' in London. Street food, Surti locho, pav bhaji, paneer curries, tandoori breads, and biryani with instant table QR ordering.')

@section('content')
<!-- =========================================================================
     1. DIGITAL MENU HERO & QR CONTEXT BANNER
     ========================================================================= -->
<section class="menu-page-header" style="background-image: linear-gradient(180deg, rgba(14, 10, 7, 0.82) 0%, rgba(14, 10, 7, 0.94) 100%), url('{{ asset('images/home/hero-bg.jpg') }}'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="section-eyebrow">{{ config('restaurant.subtitle') }}</div>
        <h1 class="page-title">Digital Restaurant Menu</h1>
        <p class="page-subtitle">
            Authentic Gujarati street delicacies, rich North Indian curries, and tandoori breads freshly prepared in London.
        </p>

        <!-- QR Code Table / Dine-In Status Banner -->
        <div class="menu-qr-status-bar" id="menuQrBar">
            <div class="qr-status-chip">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2"/>
                    <path d="M7 7h.01M17 7h.01M7 17h.01M17 17h.01M12 12h.01"/>
                </svg>
                <span id="qrTableLabel">
                    @if(!empty($tableNumber))
                        <strong>Table #{{ $tableNumber }}</strong> • Dine-In Ordering
                    @else
                        <strong>Table Ordering</strong> • Select Table or Takeaway
                    @endif
                </span>
            </div>
            
            <div class="qr-order-switch">
                <button type="button" class="qr-mode-pill active" data-mode="dine_in">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/><path d="M7 2v20"/></svg>
                    Dine In
                </button>
                <button type="button" class="qr-mode-pill" data-mode="takeaway">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/></svg>
                    Takeaway
                </button>
            </div>
        </div>

        <!-- Real-Time Search & Dietary Filter Bar -->
        <div class="menu-search-filter-wrapper">
            <div class="menu-search-box">
                <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.3-4.3"/>
                </svg>
                <input type="text" id="menuSearchInput" class="menu-search-input" placeholder="Search dishes (e.g. Pani Puri, Paneer Tikka, Dosa, Vadapav...)" aria-label="Search menu dishes">
                <button type="button" id="clearSearchBtn" class="search-clear-btn" style="display: none;" aria-label="Clear search">✕</button>
            </div>

            <div class="dietary-filter-chips">
                <button type="button" class="diet-chip active" data-filter="all">All Dishes</button>
                <button type="button" class="diet-chip" data-filter="veg">
                    <span class="diet-chip-dot dot-veg"></span> Pure Veg
                </button>
                <button type="button" class="diet-chip" data-filter="vegan">
                    <span class="diet-chip-dot dot-vegan"></span> Vegan
                </button>
                <button type="button" class="diet-chip" data-filter="spicy">
                    <span class="diet-chip-dot dot-spicy"></span> Spicy
                </button>
                <button type="button" class="diet-chip" data-filter="popular">
                    <span class="diet-chip-dot dot-popular"></span> Popular
                </button>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     2. STICKY HORIZONTAL CATEGORY NAVIGATION BAR
     ========================================================================= -->
@if($categories->isNotEmpty())
<nav class="menu-nav-bar" id="stickyCategoryNav" aria-label="Menu Categories">
    <div class="container">
        <div class="category-pills-wrapper" id="categoryPillsScroll">
            @foreach($categories as $index => $category)
                <a href="#category-{{ $category->slug }}" class="category-pill {{ $index === 0 ? 'active' : '' }}" data-category-slug="{{ $category->slug }}">
                    <span>{{ $category->name }}</span>
                    <span class="category-item-count">({{ $category->menuItems->count() }})</span>
                </a>
            @endforeach
        </div>
    </div>
</nav>
@endif

<!-- =========================================================================
     3. MENU LISTING BY CATEGORY
     ========================================================================= -->
<div class="container menu-main-content" style="padding-bottom: 6.5rem; padding-top: 1.5rem;">
    <!-- Active search result feedback -->
    <div id="searchResultsCount" class="search-results-feedback" style="display: none;"></div>

    @forelse($categories as $category)
        <section class="menu-category-section" id="category-{{ $category->slug }}" data-category-slug="{{ $category->slug }}">
            <div class="menu-category-header">
                <div>
                    <h2 class="menu-category-title">
                        <span class="title-line"></span>
                        {{ $category->name }}
                        <span class="category-dishes-badge">{{ $category->menuItems->count() }} dishes</span>
                    </h2>
                    @if($category->description)
                        <p class="menu-category-description">{{ $category->description }}</p>
                    @endif
                </div>
            </div>

            <div class="menu-items-grid">
                @forelse($category->menuItems as $item)
                    @php
                        // Determine fallback image based on category keywords
                        $catSlug = $category->slug;
                        $itemImage = $item->image ? asset($item->image) : null;
                        if (!$itemImage) {
                            if (str_contains($catSlug, 'street-food') || str_contains($catSlug, 'vadapav') || str_contains($catSlug, 'dabeli')) {
                                $itemImage = asset('images/dishes/dish-paneer-tikka.jpg');
                            } elseif (str_contains($catSlug, 'biryani') || str_contains($catSlug, 'rice')) {
                                $itemImage = asset('images/dishes/dish-biryani.jpg');
                            } elseif (str_contains($catSlug, 'dal') || str_contains($catSlug, 'kadhi')) {
                                $itemImage = asset('images/dishes/dish-dal.jpg');
                            } elseif (str_contains($catSlug, 'bread')) {
                                $itemImage = asset('images/gallery/gallery-4.jpg');
                            } else {
                                $itemImage = asset('images/dishes/dish-butter-chicken.jpg');
                            }
                        }

                        $hasVariations = $item->variations->isNotEmpty();
                        $hasAddons = $item->addons->isNotEmpty();
                    @endphp

                    <article class="menu-item-card {{ $item->is_featured ? 'is-featured' : '' }} {{ $item->is_popular ? 'is-popular' : '' }}" 
                             id="dish-card-{{ $item->id }}"
                             data-item-id="{{ $item->id }}"
                             data-name="{{ $item->name }}"
                             data-category="{{ $category->name }}"
                             data-desc="{{ $item->description ?? $item->short_description ?? '' }}"
                             data-price="{{ $item->price }}"
                             data-price-formatted="{{ $item->formatted_price }}"
                             data-image="{{ $itemImage }}"
                             data-is-veg="{{ $item->is_vegetarian ? 'true' : 'false' }}"
                             data-is-vegan="{{ $item->is_vegan ? 'true' : 'false' }}"
                             data-is-spicy="{{ $item->is_spicy ? 'true' : 'false' }}"
                             data-is-popular="{{ $item->is_popular ? 'true' : 'false' }}"
                             data-is-featured="{{ $item->is_featured ? 'true' : 'false' }}"
                             data-variations='@json($item->variations)'
                             data-addons='@json($item->addons)'>
                        
                        <div class="menu-item-card-inner">
                            <!-- Dish Details (Left Column) -->
                            <div class="menu-item-info">
                                <div class="menu-item-header">
                                    <div class="menu-item-name-group">
                                        <!-- Dietary Badges (Veg, Vegan, Spicy) -->
                                        <div class="menu-item-badges">
                                            @if($item->is_vegetarian)
                                                <span class="diet-badge veg" title="Pure Vegetarian">
                                                    <span class="badge-icon-dot green"></span>
                                                    Veg
                                                </span>
                                            @endif

                                            @if($item->is_vegan)
                                                <span class="diet-badge vegan" title="100% Plant-Based Vegan">
                                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                        <path d="M11 20A7 7 0 0 1 4 13C4 7 11 3 11 3s7 4 7 10a7 7 0 0 1-7 7Z"/>
                                                    </svg>
                                                    Vegan
                                                </span>
                                            @endif

                                            @if($item->is_spicy)
                                                <span class="diet-badge spicy" title="Authentic Spiced">
                                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M12 2C8 6 6 10 6 14a6 6 0 0 0 12 0c0-4-2-8-6-12Z"/>
                                                    </svg>
                                                    Spicy
                                                </span>
                                            @endif
                                        </div>

                                        <h3 class="menu-item-name">{{ $item->name }}</h3>
                                        
                                        <!-- Price -->
                                        <div class="menu-item-price-wrap">
                                            @if($hasVariations)
                                                <span class="price-prefix">From</span>
                                            @endif
                                            <span class="menu-item-price-tag">{{ $item->formatted_price }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                @if($item->description || $item->short_description)
                                    <p class="menu-item-desc">{{ $item->short_description ?? Str::limit($item->description, 110) }}</p>
                                @endif

                                <!-- Customization Badges Preview -->
                                @if($hasVariations || $hasAddons)
                                    <div class="item-customization-indicators">
                                        @if($hasVariations)
                                            <span class="cust-indicator-pill">Portions</span>
                                        @endif
                                        @if($hasAddons)
                                            <span class="cust-indicator-pill">Custom Extras</span>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Dish Thumbnail Photo & Floating ADD Action (Right Column) -->
                            <div class="menu-item-thumb-box">
                                <div class="menu-item-thumb-img-wrap">
                                    <img src="{{ $itemImage }}" alt="{{ $item->name }}" class="menu-item-thumb-img" loading="lazy">
                                    
                                    @if($item->is_popular)
                                        <span class="card-corner-badge">★ Popular</span>
                                    @elseif($item->is_featured)
                                        <span class="card-corner-badge featured">Chef Special</span>
                                    @endif
                                </div>

                                <div class="card-btn-action-wrapper">
                                    <button type="button" class="btn-card-add open-dish-modal-btn" aria-label="Add {{ $item->name }} to order">
                                        <span>ADD</span>
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    </button>
                                    @if($hasVariations || $hasAddons)
                                        <span class="card-customisable-tag">Customisable</span>
                                    @endif
                                </div>
                            </div>
                        </div>
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
