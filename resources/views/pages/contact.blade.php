@extends('layouts.app')

@section('title', 'Contact Us & Location - ' . config('restaurant.name') . ' Harrow, London')
@section('meta_description', 'Contact Siya\'s Kitchen in Harrow, London. Find our address at 453 Alexandra Avenue, HA2 9SE, phone 02082594954, opening hours, directions, and table reservation inquiries.')

@section('content')
<!-- =========================================================================
     1. CONTACT HERO HEADER
     ========================================================================= -->
<section class="page-hero-section" style="background-image: linear-gradient(180deg, rgba(14, 10, 7, 0.8) 0%, rgba(14, 10, 7, 0.94) 100%), url('{{ asset('images/about/about-interior.jpg') }}'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="page-hero-content">
            <span class="section-eyebrow">VISIT & CONNECT</span>
            <h1 class="page-title">We’d Love to Welcome You</h1>
            <p class="page-subtitle">
                Visit us at 453 Alexandra Avenue in Harrow for warm hospitality, authentic street food, or get in touch for table bookings and catering.
            </p>
        </div>
    </div>
</section>

<!-- =========================================================================
     2. CONTACT INFORMATION & FORM SECTION
     ========================================================================= -->
<section class="section-padding">
    <div class="container">
        @if(session('success'))
            <div class="contact-success-alert">
                <div class="alert-icon">✓</div>
                <div>
                    <strong>Message Sent Successfully!</strong>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="contact-layout-grid">
            <!-- Left Contact Details & Opening Hours -->
            <div class="contact-info-column">
                <div class="contact-info-card">
                    <div class="section-eyebrow">CONTACT DETAILS</div>
                    <h2 class="contact-card-title">Reach Out to Us</h2>
                    <p class="contact-card-desc">
                        Have a question, feedback, or need catering for a family event? We are always here to help.
                    </p>

                    <div class="contact-details-list">
                        <!-- Address -->
                        <div class="contact-detail-row">
                            <div class="contact-icon-box">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                            </div>
                            <div class="contact-detail-body">
                                <span class="detail-label">Restaurant Address</span>
                                <span class="detail-value">{{ config('restaurant.contact.address') }}</span>
                                <a href="https://maps.google.com/?q={{ urlencode(config('restaurant.contact.address')) }}" target="_blank" rel="noopener" class="detail-link">
                                    Get Directions on Google Maps &rarr;
                                </a>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="contact-detail-row">
                            <div class="contact-icon-box">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                            </div>
                            <div class="contact-detail-body">
                                <span class="detail-label">Phone Number</span>
                                <a href="tel:{{ config('restaurant.contact.phone') }}" class="detail-value phone-link">
                                    {{ config('restaurant.contact.formatted_phone') }}
                                </a>
                                <span class="detail-subtext">Direct table booking & takeaway orders</span>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="contact-detail-row">
                            <div class="contact-icon-box">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="16" x="2" y="4" rx="2"/>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                </svg>
                            </div>
                            <div class="contact-detail-body">
                                <span class="detail-label">Email Address</span>
                                <a href="mailto:{{ config('restaurant.contact.email') }}" class="detail-value email-link">
                                    {{ config('restaurant.contact.email') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Opening Hours Card -->
                    <div class="opening-hours-box">
                        <h3 class="hours-box-title">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            Opening Hours
                        </h3>
                        <div class="hours-row">
                            <span>Monday – Thursday</span>
                            <strong>{{ config('restaurant.opening_hours.mon_thu') }}</strong>
                        </div>
                        <div class="hours-row">
                            <span>Friday – Saturday</span>
                            <strong>{{ config('restaurant.opening_hours.fri_sat') }}</strong>
                        </div>
                        <div class="hours-row">
                            <span>Sunday</span>
                            <strong>{{ config('restaurant.opening_hours.sun') }}</strong>
                        </div>
                    </div>

                    <!-- Quick Direct Action Buttons -->
                    <div class="contact-quick-actions">
                        <a href="tel:{{ config('restaurant.contact.phone') }}" class="btn btn-primary" style="flex: 1; justify-content: center;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            <span>Call {{ config('restaurant.contact.formatted_phone') }}</span>
                        </a>
                        <a href="https://wa.me/442082594954?text=Hello%20Siya%27s%20Kitchen%2C%20I%20would%20like%20to%20inquire%20about%20a%20table%20reservation." target="_blank" rel="noopener" class="btn btn-outline" style="flex: 1; justify-content: center;">
                            <span>WhatsApp Us</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Interactive Contact / Reservation Form -->
            <div class="contact-form-column">
                <div class="contact-form-card">
                    <div class="section-eyebrow">SEND A MESSAGE</div>
                    <h2 class="contact-card-title">Table Booking & Inquiries</h2>
                    <p class="contact-card-desc">
                        Fill out the details below and our team will get in touch with you shortly.
                    </p>

                    <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                        @csrf

                        <div class="form-row-2">
                            <div class="form-group">
                                <label for="name" class="form-label">Your Name *</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Rahul Sharma" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="e.g. rahul@example.com" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="form-control" placeholder="e.g. 07123 456789" value="{{ old('phone') }}">
                            </div>

                            <div class="form-group">
                                <label for="inquiry_type" class="form-label">Inquiry Type</label>
                                <select id="inquiry_type" name="inquiry_type" class="form-control">
                                    <option value="reservation" {{ old('inquiry_type') === 'reservation' ? 'selected' : '' }}>Table Reservation</option>
                                    <option value="general" {{ old('inquiry_type') === 'general' ? 'selected' : '' }}>General Inquiry</option>
                                    <option value="catering" {{ old('inquiry_type') === 'catering' ? 'selected' : '' }}>Party / Catering Order</option>
                                    <option value="feedback" {{ old('inquiry_type') === 'feedback' ? 'selected' : '' }}>Feedback</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="e.g. Table for 4 on Saturday evening" value="{{ old('subject') }}">
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label">Your Message *</label>
                            <textarea id="message" name="message" rows="5" class="form-control" placeholder="Tell us your reservation date/time, guest count, or special dietary requirements..." required>{{ old('message') }}</textarea>
                            @error('message')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-submit-form" style="width: 100%; justify-content: center; min-height: 52px;">
                            <span>Submit Message</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                <line x1="22" y1="2" x2="11" y2="13"/>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     3. INTERACTIVE MAP SECTION (HARROW LOCATION)
     ========================================================================= -->
<section class="contact-map-section">
    <div class="container" style="margin-bottom: 1.5rem; text-align: center;">
        <div class="section-eyebrow">LOCATION & MAP</div>
        <h2 class="section-title">Find Us on Alexandra Avenue, Harrow</h2>
        <p class="section-subtitle" style="margin-top: 0.5rem;">
            453 Alexandra Avenue, Harrow, Middx HA2 9SE • Easy parking and accessible via public transport.
        </p>
    </div>
    
    <div class="map-embed-container">
        <iframe 
            src="https://maps.google.com/maps?q=453+Alexandra+Avenue+Harrow+HA2+9SE&t=&z=16&ie=UTF8&iwloc=&output=embed" 
            width="100%" 
            height="420" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            title="Siya's Kitchen Location Map in Harrow">
        </iframe>
    </div>
</section>
@endsection
