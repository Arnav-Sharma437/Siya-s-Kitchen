<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
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

        // Fetch featured menu items from database, with eager loaded category
        try {
            $featuredDishes = MenuItem::with('category')
                ->where('is_available', true)
                ->where('is_featured', true)
                ->ordered()
                ->take(4)
                ->get();
        } catch (\Throwable $e) {
            $featuredDishes = collect();
        }

        return view('home', compact('restaurant', 'featuredDishes'));
    }
}
