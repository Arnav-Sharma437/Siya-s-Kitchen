<?php

use App\Models\MenuItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Updates all menu items with authentic images matching their dish name.
     */
    public function up(): void
    {
        try {
            $items = DB::table('menu_items')
                ->join('menu_categories', 'menu_items.menu_category_id', '=', 'menu_categories.id')
                ->select('menu_items.id', 'menu_items.name', 'menu_items.slug', 'menu_categories.slug as cat_slug')
                ->get();

            foreach ($items as $item) {
                $imagePath = MenuItem::resolveDishImage($item->name, $item->cat_slug ?? '', $item->slug ?? '');
                DB::table('menu_items')
                    ->where('id', $item->id)
                    ->update(['image' => $imagePath]);
            }
        } catch (\Throwable $e) {
            // Log but don't fail deployment if table is empty
            \Illuminate\Support\Facades\Log::warning('Dish image sync migration error: ' . $e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No reverse needed
    }
};
