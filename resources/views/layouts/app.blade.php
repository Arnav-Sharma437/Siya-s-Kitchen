<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', "Siya's Kitchen | Authentic Indian Cuisine • Harrow, London")</title>
    <meta name="description" content="@yield('meta_description', 'Experience authentic Indian dining and online ordering in Harrow, London at Siya\'s Kitchen. Fresh ingredients, traditional recipes and warm hospitality.')">

    <!-- Open Graph / WhatsApp / Facebook -->
    <meta property="og:type" content="restaurant">
    <meta property="og:site_name" content="Siya's Kitchen">
    <meta property="og:title" content="@yield('title', 'Siya\'s Kitchen | Authentic Indian Cuisine • Harrow, London')">
    <meta property="og:description" content="@yield('meta_description', 'Experience authentic Indian dining and online ordering in Harrow, London at Siya\'s Kitchen.')">
    <meta property="og:image" content="{{ asset('images/siyas-logo.png') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Siya\'s Kitchen | Authentic Indian Cuisine • Harrow, London')">
    <meta name="twitter:description" content="@yield('meta_description', 'Experience authentic Indian dining and online ordering in Harrow, London at Siya\'s Kitchen.')">
    <meta name="twitter:image" content="{{ asset('images/siyas-logo.png') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/siyas-logo.png') }}">

    <!-- Google Fonts: Recoleta-style (Fraunces & DM Serif Display) + Instrumental (Instrument Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=DM+Serif+Display:ital@0;1&family=Fraunces:ital,opsz,wght@0,9..144,500..800;1,9..144,500..800&family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

    <!-- Global Application Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>
<body>
    <div id="app" class="site-wrapper">
        <!-- Reusable Header / Navbar -->
        @include('partials.header')

        <!-- Main Page Content -->
        <main class="site-main">
            @yield('content')
        </main>

        <!-- Reusable Footer -->
        @include('partials.footer')

        <!-- Shared Cart Drawer & Item Modals -->
        @include('partials.cart-drawer')

        <!-- Mobile App Bottom Navigation Bar -->
        @include('partials.bottom-nav')
    </div>

    <!-- Global Application Scripts -->
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>
