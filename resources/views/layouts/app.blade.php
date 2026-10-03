<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('restaurant.name') . ' | ' . config('restaurant.subtitle'))</title>
    <meta name="description" content="@yield('meta_description', 'Experience authentic Indian dining and online ordering in London at ' . config('restaurant.name') . '. Fresh ingredients, traditional recipes and warm hospitality.')">

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/suyas-logo.jpg') }}">

    <!-- Google Fonts: Instrument Sans, Instrument Serif, Plus Jakarta Sans, Alex Brush -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Instrument+Serif:ital@0;1&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

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
    </div>

    <!-- Global Application Scripts -->
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>
