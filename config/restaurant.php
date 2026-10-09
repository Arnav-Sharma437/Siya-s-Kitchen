<?php

return [
    'name' => env('RESTAURANT_NAME', "Siya's Kitchen"),
    'tagline' => env('RESTAURANT_TAGLINE', 'by Jalaram Group'),
    'subtitle' => env('RESTAURANT_SUBTITLE', 'Authentic Indian Cuisine • Harrow, London'),
    'currency' => [
        'code' => env('RESTAURANT_CURRENCY_CODE', 'GBP'),
        'symbol' => env('RESTAURANT_CURRENCY_SYMBOL', '£'),
    ],
    'contact' => [
        'address' => env('RESTAURANT_ADDRESS', '453 Alexandra Avenue, Harrow, Middx HA2 9SE'),
        'phone' => env('RESTAURANT_PHONE', '02082594954'),
        'formatted_phone' => '020 8259 4954',
        'email' => env('RESTAURANT_EMAIL', 'siyaskitchen9@gmail.com'),
        'location_label' => env('RESTAURANT_LOCATION', 'Harrow, London'),
        'website' => 'www.siyaskitchen.co.uk',
    ],
    'opening_hours' => [
        'mon_thu' => env('RESTAURANT_HOURS_MON_THU', '12:00 PM – 10:00 PM'),
        'fri_sat' => env('RESTAURANT_HOURS_FRI_SAT', '12:00 PM – 11:00 PM'),
        'sun'     => env('RESTAURANT_HOURS_SUN', '12:00 PM – 9:30 PM'),
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
