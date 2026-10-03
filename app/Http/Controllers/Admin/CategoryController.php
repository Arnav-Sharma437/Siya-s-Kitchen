<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\MenuCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the menu categories.
     */
    public function index(Request $request): View|JsonResponse
    {
        $categories = MenuCategory::withCount('menuItems')
            ->ordered()
            ->paginate(15);

        if ($request->wantsJson()) {
            return response()->json($categories);
        }

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(StoreCategoryRequest $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validated();
        $category = MenuCategory::create($validated);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Category created successfully', 'data' => $category], 201);
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(MenuCategory $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(UpdateCategoryRequest $request, MenuCategory $category): RedirectResponse|JsonResponse
    {
        $validated = $request->validated();
        $category->update($validated);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Category updated successfully', 'data' => $category]);
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Request $request, MenuCategory $category): RedirectResponse|JsonResponse
    {
        $category->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Category deleted successfully']);
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
}
