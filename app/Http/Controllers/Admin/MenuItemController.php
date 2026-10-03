<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMenuItemRequest;
use App\Http\Requests\Admin\UpdateMenuItemRequest;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the menu items.
     */
    public function index(Request $request): View|JsonResponse
    {
        $items = MenuItem::with(['category', 'variations', 'addons'])
            ->when($request->filled('category_id'), fn ($q) => $q->where('menu_category_id', $request->category_id))
            ->ordered()
            ->paginate(20);

        if ($request->wantsJson()) {
            return response()->json($items);
        }

        $categories = MenuCategory::ordered()->get();

        return view('admin.menu-items.index', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new menu item.
     */
    public function create(): View
    {
        $categories = MenuCategory::active()->ordered()->get();
        return view('admin.menu-items.create', compact('categories'));
    }

    /**
     * Store a newly created menu item in storage.
     */
    public function store(StoreMenuItemRequest $request): RedirectResponse|JsonResponse
    {
        $data = $request->validated();
        $variations = $data['variations'] ?? [];
        $addons = $data['addons'] ?? [];
        unset($data['variations'], $data['addons']);

        // Convert price to pence if provided as decimal/pounds
        if (isset($data['price']) && is_numeric($data['price'])) {
            $data['price'] = (int) round((float) $data['price'] * 100);
        }

        $menuItem = MenuItem::create($data);

        // Store variations if provided
        foreach ($variations as $var) {
            $menuItem->variations()->create([
                'name' => $var['name'],
                'price' => (int) round((float) $var['price'] * 100),
            ]);
        }

        // Store addons if provided
        foreach ($addons as $addon) {
            $menuItem->addons()->create([
                'name' => $addon['name'],
                'price' => (int) round((float) $addon['price'] * 100),
            ]);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Menu item created successfully',
                'data' => $menuItem->load(['category', 'variations', 'addons'])
            ], 201);
        }

        return redirect()->route('admin.menu-items.index')->with('success', 'Menu item created successfully');
    }

    /**
     * Show the form for editing the specified menu item.
     */
    public function edit(MenuItem $menuItem): View
    {
        $menuItem->load(['variations', 'addons']);
        $categories = MenuCategory::ordered()->get();
        return view('admin.menu-items.edit', compact('menuItem', 'categories'));
    }

    /**
     * Update the specified menu item in storage.
     */
    public function update(UpdateMenuItemRequest $request, MenuItem $menuItem): RedirectResponse|JsonResponse
    {
        $data = $request->validated();
        $variations = $data['variations'] ?? null;
        $addons = $data['addons'] ?? null;
        unset($data['variations'], $data['addons']);

        if (isset($data['price']) && is_numeric($data['price'])) {
            $data['price'] = (int) round((float) $data['price'] * 100);
        }

        $menuItem->update($data);

        // Sync variations if explicitly passed
        if (is_array($variations)) {
            $menuItem->variations()->delete();
            foreach ($variations as $var) {
                $menuItem->variations()->create([
                    'name' => $var['name'],
                    'price' => (int) round((float) $var['price'] * 100),
                ]);
            }
        }

        // Sync addons if explicitly passed
        if (is_array($addons)) {
            $menuItem->addons()->delete();
            foreach ($addons as $addon) {
                $menuItem->addons()->create([
                    'name' => $addon['name'],
                    'price' => (int) round((float) $addon['price'] * 100),
                ]);
            }
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Menu item updated successfully',
                'data' => $menuItem->fresh(['category', 'variations', 'addons'])
            ]);
        }

        return redirect()->route('admin.menu-items.index')->with('success', 'Menu item updated successfully');
    }

    /**
     * Remove the specified menu item from storage.
     */
    public function destroy(Request $request, MenuItem $menuItem): RedirectResponse|JsonResponse
    {
        $menuItem->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Menu item deleted successfully']);
        }

        return redirect()->route('admin.menu-items.index')->with('success', 'Menu item deleted successfully');
    }
}
