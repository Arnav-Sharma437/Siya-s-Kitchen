<?php

namespace Tests\Feature;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Database\Seeders\MenuSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuTest extends TestCase
{
    use RefreshDatabase;

    public function test_menu_seeder_populates_all_13_official_categories(): void
    {
        $this->seed(MenuSeeder::class);

        // Verify 13 categories exist
        $this->assertDatabaseCount('menu_categories', 13);

        $expectedCategories = [
            'Street Food',
            'Dhokla & Surti Special',
            'Sev Usal & Pav Bhaji',
            'Indian Breads',
            'Rice & Biryani',
            'Dal & Kadhi',
            'Punjabi Specialities',
            'Kaju Specialities',
            'Khichya Papdi',
            'Kathiyawadi Specialities',
            "Siya's Special",
            'South Indian',
            'Indo-Chinese',
        ];

        foreach ($expectedCategories as $catName) {
            $this->assertDatabaseHas('menu_categories', [
                'name' => $catName,
                'is_active' => true,
            ]);
        }

        // Verify specific exact prices in integer pence
        // Vadapav £2.00 = 200
        $this->assertDatabaseHas('menu_items', ['name' => 'Regular Vadapav', 'price' => 200]);
        // Paneer Tikka Masala £10.49 = 1049
        $this->assertDatabaseHas('menu_items', ['name' => 'Paneer Tikka Masala', 'price' => 1049]);
        // Cheese Butter Masala £12.49 = 1249
        $this->assertDatabaseHas('menu_items', ['name' => 'Cheese Butter Masala', 'price' => 1249]);
        // Snacks Platter £10.00 = 1000
        $this->assertDatabaseHas('menu_items', ['name' => 'Snacks Platter', 'price' => 1000]);
        // Extra Pav £0.50 = 50
        $this->assertDatabaseHas('menu_items', ['name' => 'Extra Pav', 'price' => 50]);
        // Plain Dosa £4.00 = 400
        $this->assertDatabaseHas('menu_items', ['name' => 'Plain Dosa', 'price' => 400]);
        // Popcorn Manchurian £10.00 = 1000
        $this->assertDatabaseHas('menu_items', ['name' => 'Popcorn Manchurian', 'price' => 1000]);
    }

    public function test_public_menu_page_renders_seeded_menu_and_qr_table(): void
    {
        $this->seed(MenuSeeder::class);

        $response = $this->get('/menu?table=12');

        $response->assertStatus(200);
        $response->assertSee('Digital Restaurant Menu');
        $response->assertSee('Table #12');
        $response->assertSee('Street Food');
        $response->assertSee('Regular Vadapav');
        $response->assertSee('£2.00');
        $response->assertSee('Paneer Tikka Masala');
        $response->assertSee('£10.49');
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

    public function test_homepage_renders_with_menu_cta_and_dishes(): void
    {
        $this->seed(MenuSeeder::class);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee("Siya's Kitchen", false);
        $response->assertSee('Popular Dishes');
        $response->assertSee('View Full Menu');
    }

    public function test_about_page_renders_with_siya_tribute(): void
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
        $response->assertSee("DEDICATED TO SIYA");
        $response->assertSee("They Stay in Every Flavor", false);
        $response->assertSee("453 Alexandra Avenue, Harrow", false);
        $response->assertSee("020 8259 4954");
    }

    public function test_gallery_page_renders_with_photos(): void
    {
        $response = $this->get('/gallery');

        $response->assertStatus(200);
        $response->assertSee('Our Food Gallery');
        $response->assertSee('Dedicated to Siya');
        $response->assertSee('Paneer Butter Masala');
    }

    public function test_contact_page_renders_and_handles_form_submission(): void
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
        $response->assertSee('453 Alexandra Avenue, Harrow', false);
        $response->assertSee('020 8259 4954');
        $response->assertSee('siyaskitchen9@gmail.com');

        // Test form submission
        $postResponse = $this->post('/contact', [
            'name' => 'Aarav Patel',
            'email' => 'aarav@example.com',
            'phone' => '07123456789',
            'inquiry_type' => 'reservation',
            'subject' => 'Table for 4',
            'message' => 'We would love to reserve a table for this Saturday evening at 7 PM.',
        ]);

        $postResponse->assertRedirect('/contact');
        $postResponse->assertSessionHas('success');
    }
}
