<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the Suyas Kitchen homepage.
     */
    public function index(): View
    {
        $restaurant = config('restaurant');

        // Initial preview data for popular dishes foundation
        $featuredDishes = [
            [
                'name' => 'Butter Chicken',
                'description' => 'Rich, creamy and full of flavour',
                'price' => '£13.95',
                'image' => '/images/dishes/butter-chicken.jpg',
                'badge' => 'Chef Special',
            ],
            [
                'name' => 'Chicken Biryani',
                'description' => 'Aromatic basmati rice with tender spiced chicken',
                'price' => '£12.95',
                'image' => '/images/dishes/chicken-biryani.jpg',
                'badge' => 'Popular',
            ],
            [
                'name' => 'Paneer Tikka',
                'description' => 'Smoky, flavourful and delicious grilled cottage cheese',
                'price' => '£9.95',
                'image' => '/images/dishes/paneer-tikka.jpg',
                'badge' => 'Vegetarian',
            ],
            [
                'name' => 'Dal Tadka',
                'description' => 'A classic slow-cooked yellow lentil tempered with cumin and garlic',
                'price' => '£8.50',
                'image' => '/images/dishes/dal-tadka.jpg',
                'badge' => 'Classic',
            ],
        ];

        return view('home', compact('restaurant', 'featuredDishes'));
    }
}
