<?php

namespace Tests\Feature;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_menu_page_renders_successfully(): void
    {
        $category = MenuCategory::create([
            'name' => 'Signature Curries',
            'slug' => 'signature-curries',
            'description' => 'Authentic slow-cooked curries',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $item = MenuItem::create([
            'menu_category_id' => $category->id,
            'name' => 'Royal Butter Chicken',
            'slug' => 'royal-butter-chicken',
            'description' => 'Creamy tomato fenugreek curry',
            'price' => 1395, // £13.95
            'is_vegetarian' => false,
            'is_featured' => true,
            'is_available' => true,
        ]);

        $response = $this->get('/menu');

        $response->assertStatus(200);
        $response->assertSee('Digital Restaurant Menu');
        $response->assertSee('Signature Curries');
        $response->assertSee('Royal Butter Chicken');
        $response->assertSee('£13.95');
    }

    public function test_price_formatting_and_pence_integer_handling(): void
    {
        $category = MenuCategory::create([
            'name' => 'Tandoor',
            'slug' => 'tandoor',
        ]);

        $item = MenuItem::create([
            'menu_category_id' => $category->id,
            'name' => 'Paneer Tikka',
            'slug' => 'paneer-tikka',
            'price' => 995,
        ]);

        $this->assertEquals(995, $item->price);
        $this->assertEquals(9.95, $item->price_in_pounds);
        $this->assertEquals('£9.95', $item->formatted_price);

        // Test variations & addons relationships
        $variation = $item->variations()->create([
            'name' => 'Large Portion',
            'price' => 1495,
        ]);
        $this->assertEquals('£14.95', $variation->formatted_price);

        $addon = $item->addons()->create([
            'name' => 'Extra Mint Sauce',
            'price' => 150,
        ]);
        $this->assertEquals('£1.50', $addon->formatted_price);
    }

    public function test_admin_category_and_menu_item_index_routes_render(): void
    {
        $responseCategory = $this->get('/admin/categories');
        $responseCategory->assertStatus(200);
        $responseCategory->assertSee('Menu Categories');

        $responseItems = $this->get('/admin/menu-items');
        $responseItems->assertStatus(200);
        $responseItems->assertSee('Menu Items');
    }
}
