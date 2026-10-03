<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    /**
     * Display the digital restaurant menu.
     */
    public function index(Request $request): View
    {
        $restaurant = config('restaurant');

        // Eager load active categories with active items, variations, and addons
        $categories = MenuCategory::active()
            ->ordered()
            ->with([
                'menuItems' => function ($query) {
                    $query->available()
                        ->ordered()
                        ->with(['variations' => fn ($q) => $q->active(), 'addons' => fn ($q) => $q->active()]);
                }
            ])
            ->get();

        $selectedCategorySlug = $request->query('category');

        return view('menu.index', compact('restaurant', 'categories', 'selectedCategorySlug'));
    }
}
