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
        try {
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
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('MenuController loading error: ' . $e->getMessage());
            $categories = collect();
        }

        $selectedCategorySlug = $request->query('category');
        $tableNumber = $request->query('table');

        return view('menu.index', compact('restaurant', 'categories', 'selectedCategorySlug', 'tableNumber'));
    }
}
