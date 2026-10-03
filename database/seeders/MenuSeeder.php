<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesData = [
            [
                'name' => 'Starters',
                'description' => 'Crispy, flavourful appetizers infused with fragrant spices.',
                'sort_order' => 1,
                'items' => [
                    [
                        'name' => 'Punjabi Vegetable Samosas (2 pcs)',
                        'description' => 'Crisp pastry triangles stuffed with spiced potatoes and green peas, served with tamarind chutney.',
                        'price' => 550, // £5.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                        'is_featured' => true,
                        'addons' => [
                            ['name' => 'Extra Tamarind Chutney', 'price' => 100],
                            ['name' => 'Mint & Coriander Dip', 'price' => 100],
                        ],
                    ],
                    [
                        'name' => 'Crispy Onion Bhaji (4 pcs)',
                        'description' => 'Golden-fried spiced onion fritters with gram flour and fresh herbs.',
                        'price' => 595, // £5.95
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                        'is_featured' => false,
                    ],
                    [
                        'name' => 'Amritsari Fish Pakora',
                        'description' => 'Crispy carom seed and gram-flour battered fish fillets with chaat masala.',
                        'price' => 795, // £7.95
                        'is_vegetarian' => false,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => false,
                    ],
                ],
            ],
            [
                'name' => 'Tandoor & Grills',
                'description' => 'Marinated in yogurt and aromatic spices, roasted in the traditional clay oven.',
                'sort_order' => 2,
                'items' => [
                    [
                        'name' => 'Paneer Tikka Shashlik',
                        'description' => 'Char-grilled cottage cheese cubes with bell peppers and red onions.',
                        'price' => 995, // £9.95
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => true,
                        'addons' => [
                            ['name' => 'Extra Mint Chutney', 'price' => 100],
                        ],
                    ],
                    [
                        'name' => 'Classic Tandoori Chicken',
                        'description' => 'Chicken on the bone marinated in spiced yogurt, kashmiri chilli and mustard oil.',
                        'price' => 895, // £8.95
                        'is_vegetarian' => false,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'variations' => [
                            ['name' => 'Half (2 pcs)', 'price' => 895],
                            ['name' => 'Full (4 pcs)', 'price' => 1595],
                        ],
                    ],
                    [
                        'name' => 'Lamb Seekh Kebab (3 pcs)',
                        'description' => 'Minced lamb skewers blended with ginger, garlic, green chilies, and aromatic spices.',
                        'price' => 950, // £9.50
                        'is_vegetarian' => false,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => false,
                    ],
                ],
            ],
            [
                'name' => 'Curries & Main Course',
                'description' => 'Rich, comforting curries simmered with authentic Indian spices.',
                'sort_order' => 3,
                'items' => [
                    [
                        'name' => 'Old Delhi Butter Chicken',
                        'description' => 'Tender tandoori chicken simmered in a silky tomato, butter, and fenugreek gravy.',
                        'price' => 1395, // £13.95
                        'is_vegetarian' => false,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => true,
                        'addons' => [
                            ['name' => 'Extra Butter & Cream Drizzle', 'price' => 150],
                        ],
                    ],
                    [
                        'name' => 'Kashmiri Lamb Rogan Josh',
                        'description' => 'Slow-braised British lamb in a deep, fragrant red gravy infused with rattan jot and fennel.',
                        'price' => 1495, // £14.95
                        'is_vegetarian' => false,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Chicken Tikka Masala',
                        'description' => 'Chargrilled chicken breast tikka cooked in a gently spiced, creamy masala sauce.',
                        'price' => 1350, // £13.50
                        'is_vegetarian' => false,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => false,
                    ],
                    [
                        'name' => 'King Prawn Karahi',
                        'description' => 'Juicy king prawns cooked with crushed coriander seeds, capsicum, and fresh tomatoes in a wok.',
                        'price' => 1595, // £15.95
                        'is_vegetarian' => false,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => false,
                    ],
                ],
            ],
            [
                'name' => 'Vegetarian Specials',
                'description' => 'Celebrated vegetarian culinary traditions from across India.',
                'sort_order' => 4,
                'items' => [
                    [
                        'name' => 'Dal Makhani',
                        'description' => 'Slow-simmered black lentils and kidney beans with butter, cream, and roasted cumin (24-hour slow cook).',
                        'price' => 950, // £9.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Tarka Dal',
                        'description' => 'Yellow lentils tempered with crispy garlic, cumin seeds, tomatoes, and fresh coriander.',
                        'price' => 850, // £8.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                        'is_featured' => false,
                    ],
                    [
                        'name' => 'Palak Paneer',
                        'description' => 'Soft cottage cheese simmered in a wholesome, vibrant spiced spinach gravy.',
                        'price' => 1050, // £10.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => false,
                        'addons' => [
                            ['name' => 'Extra Paneer Cubes', 'price' => 200],
                        ],
                    ],
                    [
                        'name' => 'Amritsari Chana Masala',
                        'description' => 'Tangy and spicy slow-cooked chickpeas with dried pomegranate seeds and ginger.',
                        'price' => 895, // £8.95
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_featured' => false,
                    ],
                ],
            ],
            [
                'name' => 'Dum Biryani',
                'description' => 'Fragrant long-grain aged basmati rice cooked on "dum" with saffron, mint, and whole spices.',
                'sort_order' => 5,
                'items' => [
                    [
                        'name' => 'Hyderabadi Chicken Biryani',
                        'description' => 'Marinated chicken layered with saffron basmati rice, caramelised onions, and rose water. Served with cucumber raita.',
                        'price' => 1295, // £12.95
                        'is_vegetarian' => false,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'addons' => [
                            ['name' => 'Extra Cucumber Raita', 'price' => 200],
                            ['name' => 'Mirchi Ka Salan (Gravy)', 'price' => 250],
                        ],
                    ],
                    [
                        'name' => 'Dum Pukht Lamb Biryani',
                        'description' => 'Tender lamb cuts infused with whole spices and basmati rice, sealed in a handi. Served with raita.',
                        'price' => 1450, // £14.50
                        'is_vegetarian' => false,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => false,
                    ],
                    [
                        'name' => 'Subz Vegetable Biryani',
                        'description' => 'Seasonal farm vegetables, paneer, and scented basmati rice cooked with herbs and mint. Served with raita.',
                        'price' => 1095, // £10.95
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => false,
                    ],
                ],
            ],
            [
                'name' => 'Fresh Breads & Rice',
                'description' => 'Clay oven flatbreads and fragrant aromatic rice accompaniments.',
                'sort_order' => 6,
                'items' => [
                    [
                        'name' => 'Garlic & Coriander Naan',
                        'description' => 'Freshly baked leavened bread brushed with garlic butter and fresh coriander.',
                        'price' => 375, // £3.75
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Peshwari Naan',
                        'description' => 'Sweet bread stuffed with grated coconut, raisins, and almond flakes.',
                        'price' => 450, // £4.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => false,
                    ],
                    [
                        'name' => 'Tandoori Roti',
                        'description' => 'Wholewheat unleavened flatbread baked crisp in the tandoor.',
                        'price' => 275, // £2.75
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                        'is_featured' => false,
                    ],
                    [
                        'name' => 'Pilau Basmati Rice',
                        'description' => 'Aromatic aged basmati rice tempered with whole cumin and whole spices.',
                        'price' => 395, // £3.95
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                        'is_featured' => false,
                    ],
                ],
            ],
            [
                'name' => 'Desserts',
                'description' => 'Traditional Indian sweet delicacies to complete your feast.',
                'sort_order' => 7,
                'items' => [
                    [
                        'name' => 'Warm Gulab Jamun (2 pcs)',
                        'description' => 'Golden milk-solid dumplings soaked in warm saffron and cardamom syrup.',
                        'price' => 495, // £4.95
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => true,
                        'addons' => [
                            ['name' => 'Scoop of Vanilla Ice Cream', 'price' => 150],
                        ],
                    ],
                    [
                        'name' => 'Royal Rasmalai (2 pcs)',
                        'description' => 'Soft cottage cheese patties immersed in chilled clotted milk flavoured with cardamom and pistachios.',
                        'price' => 550, // £5.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => false,
                    ],
                    [
                        'name' => 'Alphonso Mango Kulfi',
                        'description' => 'Traditional dense and creamy Indian ice cream made with real Alphonso mango pulp.',
                        'price' => 475, // £4.75
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => false,
                    ],
                ],
            ],
            [
                'name' => 'Beverages & Lassi',
                'description' => 'Refreshing traditional drinks and beverages.',
                'sort_order' => 8,
                'items' => [
                    [
                        'name' => 'Classic Mango Lassi',
                        'description' => 'Chilled creamy yogurt smoothie blended with sweet Alphonso mango pulp and cardamom.',
                        'price' => 450, // £4.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Sweet / Salted Lassi',
                        'description' => 'Traditional churned fresh yogurt drink, served chilled.',
                        'price' => 395, // £3.95
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => false,
                    ],
                    [
                        'name' => 'Masala Chai',
                        'description' => 'Brewed Indian black tea with crushed ginger, cloves, cinnamon, and fresh milk.',
                        'price' => 350, // £3.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => false,
                    ],
                ],
            ],
        ];

        foreach ($categoriesData as $catData) {
            $items = $catData['items'] ?? [];
            unset($catData['items']);

            $category = MenuCategory::updateOrCreate(
                ['slug' => Str::slug($catData['name'])],
                $catData
            );

            foreach ($items as $index => $itemData) {
                $variations = $itemData['variations'] ?? [];
                $addons = $itemData['addons'] ?? [];
                unset($itemData['variations'], $itemData['addons']);

                $itemData['menu_category_id'] = $category->id;
                $itemData['slug'] = Str::slug($itemData['name']);
                $itemData['sort_order'] = $index + 1;
                $itemData['is_available'] = true;

                $menuItem = MenuItem::updateOrCreate(
                    ['slug' => $itemData['slug']],
                    $itemData
                );

                // Variations
                $menuItem->variations()->delete();
                foreach ($variations as $vIdx => $vData) {
                    $menuItem->variations()->create([
                        'name' => $vData['name'],
                        'price' => $vData['price'],
                        'sort_order' => $vIdx + 1,
                        'is_active' => true,
                    ]);
                }

                // Addons
                $menuItem->addons()->delete();
                foreach ($addons as $aIdx => $aData) {
                    $menuItem->addons()->create([
                        'name' => $aData['name'],
                        'price' => $aData['price'],
                        'sort_order' => $aIdx + 1,
                        'is_active' => true,
                    ]);
                }
            }
        }
    }
}
