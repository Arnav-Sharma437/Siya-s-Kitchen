<?php

return [
    'name' => env('RESTAURANT_NAME', "Siya's Kitchen"),
    'tagline' => env('RESTAURANT_TAGLINE', 'by Jalaram Group'),
    'subtitle' => env('RESTAURANT_SUBTITLE', 'Authentic Indian Cuisine • London'),
    'currency' => [
        'code' => env('RESTAURANT_CURRENCY_CODE', 'GBP'),
        'symbol' => env('RESTAURANT_CURRENCY_SYMBOL', '£'),
    ],
    'contact' => [
        'address' => env('RESTAURANT_ADDRESS', '123 High Street, London, UK'),
        'phone' => env('RESTAURANT_PHONE', '+44 20 1234 5678'),
        'email' => env('RESTAURANT_EMAIL', 'info@siyaskitchen.co.uk'),
        'location_label' => env('RESTAURANT_LOCATION', 'London, UK'),
    ],
    'opening_hours' => [
        'mon_thu' => env('RESTAURANT_HOURS_MON_THU', '12:00 PM – 10:00 PM'),
        'fri_sat' => env('RESTAURANT_HOURS_FRI_SAT', '12:00 PM – 11:00 PM'),
        'sun'     => env('RESTAURANT_HOURS_SUN', '12:00 PM – 9:00 PM'),
    ],
    'social' => [
        'facebook' => env('RESTAURANT_FACEBOOK', 'https://facebook.com'),
        'instagram' => env('RESTAURANT_INSTAGRAM', 'https://instagram.com'),
        'tripadvisor' => env('RESTAURANT_TRIPADVISOR', 'https://tripadvisor.co.uk'),
    ],
    'features' => [
        'dine_in_qr' => env('FEATURE_DINE_IN_QR', true),
        'online_takeaway' => env('FEATURE_ONLINE_TAKEAWAY', true),
        'table_reservations' => env('FEATURE_RESERVATIONS', true),
    ],
    'integrations' => [
        'payment_driver' => env('PAYMENT_DRIVER', 'stripe'), // interface-backed driver
        'pos_driver' => env('POS_DRIVER', 'placeholder'), // interface-backed driver
    ],
];
