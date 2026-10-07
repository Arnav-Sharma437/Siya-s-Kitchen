<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds with the official Siya's Kitchen menu items and prices in GBP.
     */
    public function run(): void
    {
        $categoriesData = [
            // ==========================================
            // 1. Street Food
            // ==========================================
            [
                'name' => 'Street Food',
                'description' => 'Crispy, tangy, and savoury authentic Mumbai & Gujarati street delicacies.',
                'sort_order' => 1,
                'items' => [
                    // Pani Puri
                    [
                        'name' => 'Regular Pani Puri (7 pcs)',
                        'description' => 'Crisp puris filled with spiced potatoes, chickpeas, sweet tamarind chutney, and chilled mint-coriander spiced water.',
                        'short_description' => '7 pcs authentic spiced pani puri',
                        'price' => 250, // £2.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                        'addons' => [
                            ['name' => 'Extra Spiced Water', 'price' => 50],
                            ['name' => 'Extra Sweet Chutney', 'price' => 50],
                            ['name' => 'Extra Puris (4 pcs)', 'price' => 100],
                        ],
                    ],
                    [
                        'name' => 'Ragda Pani Puri (6 pcs)',
                        'description' => 'Warm white-pea ragda filled puris served with spicy mint water and tangy tamarind chutney.',
                        'short_description' => '6 pcs warm ragda puris',
                        'price' => 300, // £3.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_popular' => false,
                    ],
                    [
                        'name' => 'Dahi Puri (6 pcs)',
                        'description' => 'Crispy puris stuffed with potatoes, topped with sweetened creamy yogurt, sev, and assorted chutneys.',
                        'short_description' => '6 pcs chilled sweet yogurt puris',
                        'price' => 350, // £3.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => true,
                        'is_popular' => true,
                        'addons' => [
                            ['name' => 'Extra Sweet Yogurt', 'price' => 50],
                            ['name' => 'Extra Nylon Sev', 'price' => 50],
                        ],
                    ],
                    [
                        'name' => 'Sev Puri (6 pcs)',
                        'description' => 'Flat puris topped with diced potatoes, onions, trio of spicy-sweet chutneys, and a mountain of crispy nylon sev.',
                        'short_description' => '6 pcs crunchy sev puri',
                        'price' => 350, // £3.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Chutney Puri (6 pcs)',
                        'description' => 'Puris loaded with fresh spicy green herb chutney and sweet date-tamarind chutney.',
                        'short_description' => '6 pcs spicy chutney puri',
                        'price' => 350, // £3.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Basket Chaat (6 pcs)',
                        'description' => 'Edible crispy tartlets loaded with spiced sprouts, potatoes, yogurt, chutneys, and pomegranate.',
                        'short_description' => '6 pcs loaded basket chaat',
                        'price' => 400, // £4.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'P.P Mini – 3 Portions (Takeaway)',
                        'description' => 'Pani Puri party pack with 3 portions of puris, fillings, and flavoured waters for takeaway.',
                        'short_description' => '3 portions takeaway pack',
                        'price' => 900, // £9.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Family Pack Pani Puri (Takeaway)',
                        'description' => 'Large family sharing pack of puris, potato mix, sweet chutney, and refreshing mint water.',
                        'short_description' => 'Large family takeaway pack',
                        'price' => 1500, // £15.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],

                    // Chaat
                    [
                        'name' => 'Ghughra Chaat (2 pcs)',
                        'description' => 'Crispy savoury Gujarat-style spiced pastry crushed and garnished with chutneys and sev.',
                        'short_description' => '2 pcs traditional ghughra chaat',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Aloo Papdi Chaat',
                        'description' => 'Crispy flour crackers tossed with boiled potatoes, chickpeas, yogurt, tamarind, and mint chutney.',
                        'short_description' => 'Classic crisp potato papdi chaat',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Dahi Papdi Chaat',
                        'description' => 'Papdi crackers blanketed in chilled whipped yogurt, roasted cumin, and sweet-spicy chutneys.',
                        'short_description' => 'Creamy yogurt papdi chaat',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Samosa Chaat (2 pcs)',
                        'description' => 'Crushed hot vegetable samosas topped with chickpea curry, cool yogurt, and tangy chutneys.',
                        'short_description' => '2 pcs warm samosa chickpea chaat',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Aloo Tikki Chaat',
                        'description' => 'Spiced potato patties pan-grilled golden and served with chole, yogurt, and date-tamarind chutney.',
                        'short_description' => 'Golden potato patty chaat',
                        'price' => 700, // £7.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Delhi Chaat',
                        'description' => 'Delhi-style street chaat layered with crunchy bites, spiced pulses, and signature spice blends.',
                        'short_description' => 'Old Delhi style savoury chaat',
                        'price' => 700, // £7.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'The Patel Sp. Chaat',
                        'description' => 'Our house-special loaded royal chaat with exotic toppings, dry fruits, and secret chutney blend.',
                        'short_description' => 'Patel Special signature chaat',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],

                    // Vadapav
                    [
                        'name' => 'Regular Vadapav',
                        'description' => 'Mumbai’s favourite spiced potato fritter encased in a soft pav bun with garlic chutney.',
                        'short_description' => 'Classic Mumbai vadapav',
                        'price' => 200, // £2.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_popular' => true,
                        'addons' => [
                            ['name' => 'Extra Fried Green Chilli', 'price' => 50],
                            ['name' => 'Extra Garlic Chutney', 'price' => 50],
                            ['name' => 'Add Grated Cheese', 'price' => 100],
                        ],
                    ],
                    [
                        'name' => 'Masala Fry Vadapav',
                        'description' => 'Pav toasted on the griddle in spicy butter masala with golden batata vada.',
                        'short_description' => 'Pan-toasted masala vadapav',
                        'price' => 250, // £2.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'B. Masala Fry Vadapav',
                        'description' => 'Butter-loaded masala griddle vadapav with extra aromatic spices.',
                        'short_description' => 'Rich butter masala vadapav',
                        'price' => 300, // £3.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Schezwan Vadapav',
                        'description' => 'Vadapav tossed with fiery Indo-Chinese Schezwan sauce.',
                        'short_description' => 'Fiery Schezwan spiced vadapav',
                        'price' => 350, // £3.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Butter Cheese M. Fry Vadapav',
                        'description' => 'Buttered masala-fried vadapav smothered with shredded British cheddar cheese.',
                        'short_description' => 'Butter cheese masala vadapav',
                        'price' => 400, // £4.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Schezwan Cheese Vadapav',
                        'description' => 'Zesty Schezwan sauce meets melted cheese inside soft toasted pav.',
                        'short_description' => 'Schezwan with melted cheese',
                        'price' => 400, // £4.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Cheese Chilli Vadapav',
                        'description' => 'Spicy green chillies and melted cheese over a crisp potato vada.',
                        'short_description' => 'Cheese & green chilli vadapav',
                        'price' => 400, // £4.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Patel Special Vadapav',
                        'description' => 'The ultimate signature vadapav loaded with double cheese, butter fry, and secret spiced toppings.',
                        'short_description' => 'House special signature vadapav',
                        'price' => 500, // £5.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],

                    // Dabeli
                    [
                        'name' => 'Regular Dabeli',
                        'description' => 'Kutch-style sweet-tangy spiced potato mash stuffed in pav with roasted peanuts and pomegranate.',
                        'short_description' => 'Authentic Kutchi dabeli',
                        'price' => 250, // £2.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                        'is_popular' => true,
                        'addons' => [
                            ['name' => 'Extra Masala Peanuts', 'price' => 50],
                            ['name' => 'Extra Sev & Pomegranate', 'price' => 50],
                        ],
                    ],
                    [
                        'name' => 'Butter Dabeli',
                        'description' => 'Griddle-toasted dabeli generously basted in pure butter.',
                        'short_description' => 'Butter toasted Kutchi dabeli',
                        'price' => 300, // £3.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'B. Sev Onion Dabeli',
                        'description' => 'Butter-toasted dabeli overflowing with fresh diced onions and crispy nylon sev.',
                        'short_description' => 'Butter dabeli with sev & onions',
                        'price' => 350, // £3.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'B. Cheese Dabeli',
                        'description' => 'Butter dabeli filled with gooey melted cheddar cheese.',
                        'short_description' => 'Butter cheese Kutchi dabeli',
                        'price' => 400, // £4.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Katka Dabeli',
                        'description' => 'Bite-sized chopped dabeli tossed with butter, peanuts, sev, and rich chutneys.',
                        'short_description' => 'Chopped masala katka dabeli',
                        'price' => 450, // £4.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Sev Onion Cheese Dabeli',
                        'description' => 'Loaded dabeli with sev, chopped onions, and a thick layer of melted cheese.',
                        'short_description' => 'Loaded sev onion & cheese dabeli',
                        'price' => 450, // £4.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],

                    // Sandwich
                    [
                        'name' => 'Cheese Toast Sandwich',
                        'description' => 'Golden toasted crusty bread packed with gooey melted cheese and butter.',
                        'short_description' => 'Classic golden cheese toast',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Veg Cheese Sandwich',
                        'description' => 'Sliced cucumber, tomatoes, bell peppers, beetroot, and cheddar cheese with mint butter.',
                        'short_description' => 'Fresh vegetable & cheese sandwich',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Bombay Sandwich',
                        'description' => 'Iconic triple-layered Mumbai street sandwich toasted with spiced potato, veggies, and chaat masala.',
                        'short_description' => 'Authentic Mumbai toasted sandwich',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Samosa Sandwich',
                        'description' => 'Crispy samosas pressed inside bread slices with green chutney and melted butter.',
                        'short_description' => 'Crushed samosa toasted sandwich',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Ghughra Sandwich',
                        'description' => 'Gujarati spiced ghughra filling toasted to crunchy perfection with aromatic spices.',
                        'short_description' => 'Spiced ghughra toast sandwich',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Paneer Tikka Sandwich',
                        'description' => 'Marinated tandoori paneer cubes, capsicum, onions, and spicy mayo inside grilled bread.',
                        'short_description' => 'Grilled tandoori paneer sandwich',
                        'price' => 700, // £7.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'The Patel Special Sandwich',
                        'description' => 'Double-layered grilled sandwich loaded with paneer, assorted veggies, triple cheese, and secret masala.',
                        'short_description' => 'Signature Patel triple-decker sandwich',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_popular' => true,
                    ],

                    // Chips & Sides
                    [
                        'name' => 'Chilli Cheese Bites (4 pcs)',
                        'description' => 'Crispy breaded bites stuffed with spicy jalapeno peppers and melted cheese.',
                        'short_description' => '4 pcs spicy jalapeno cheese bites',
                        'price' => 300, // £3.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Plain Chips',
                        'description' => 'Crisp golden potato French fries lightly salted.',
                        'short_description' => 'Classic salted potato fries',
                        'price' => 400, // £4.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Masala Chips',
                        'description' => 'Hot potato chips tossed in zesty Indian tangy spices and fresh coriander.',
                        'short_description' => 'Spiced tangy Indian masala chips',
                        'price' => 450, // £4.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Chilli Garlic Chips',
                        'description' => 'Crisp chips wok-tossed in pungent crushed garlic, red chilli oil, and spring onions.',
                        'short_description' => 'Wok-tossed chilli garlic chips',
                        'price' => 500, // £5.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'The Patel Sp. Chips',
                        'description' => 'House-special loaded chips topped with spiced cheese sauce, herbs, and toasted spices.',
                        'short_description' => 'Signature loaded Patel chips',
                        'price' => 500, // £5.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Chilli Cheese Bites (8 pcs)',
                        'description' => '8 sharing pieces of spicy jalapeno melted cheese bites with garlic dip.',
                        'short_description' => '8 pcs spicy cheese bites sharing portion',
                        'price' => 500, // £5.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],

                    // Papad
                    [
                        'name' => 'Roasted Papad',
                        'description' => 'Thin lentil wafer fire-roasted over open flame until crisp.',
                        'short_description' => 'Fire-roasted crispy lentil papad',
                        'price' => 150, // £1.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Fry Papad',
                        'description' => 'Golden fried crispy poppadom wafer.',
                        'short_description' => 'Crisp deep-fried poppadom',
                        'price' => 200, // £2.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Masala Papad',
                        'description' => 'Crisp papad loaded with finely diced onions, juicy tomatoes, fresh coriander, and chaat spices.',
                        'short_description' => 'Topped with spiced onion, tomato & herbs',
                        'price' => 250, // £2.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_popular' => true,
                    ],
                ],
            ],

            // ==========================================
            // 2. Dhokla & Surti Special
            // ==========================================
            [
                'name' => 'Dhokla & Surti Special',
                'description' => 'Steamed Gujarati savoury cakes, Surat-famous locho, and steamed delicacies.',
                'sort_order' => 2,
                'items' => [
                    [
                        'name' => 'Live Dhokla',
                        'description' => 'Freshly steamed warm fermented rice and lentil dhokla tempered with mustard seeds and curry leaves.',
                        'short_description' => 'Freshly steamed warm Gujarati dhokla',
                        'price' => 500, // £5.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Idli',
                        'description' => 'Pillowy steamed rice cakes served with aromatic sambar and fresh coconut chutney.',
                        'short_description' => 'Steamed soft rice cakes with sambar',
                        'price' => 500, // £5.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Regular Locho',
                        'description' => 'Surat’s famous steamed gram-flour delicacy served warm with locho masala, spicy green chutney, and oil.',
                        'short_description' => 'Classic Surat steamed locho',
                        'price' => 550, // £5.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Butter Locho',
                        'description' => 'Warm steamed locho bathed in pure butter, sprinkled with locho masala and nylon sev.',
                        'short_description' => 'Butter-drizzled Surti locho with sev',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Rasawala Khaman',
                        'description' => 'Soft spongy khaman dunked in a hot sweet-tangy-spicy spiced broth.',
                        'short_description' => 'Spongy khaman in spicy tangy broth',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Vatidal Khaman',
                        'description' => 'Traditional coarse chana dal khaman steamed to golden perfection with green chilli tempering.',
                        'short_description' => 'Coarse chana dal steamed khaman',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Dahi Khaman',
                        'description' => 'Soft khaman cubes topped with chilled sweetened curd, pomegranate, and crunchy sev.',
                        'short_description' => 'Cool yogurt-topped khaman chaat',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Sev Khamani',
                        'description' => 'Crushed chana dal delicacy tempered with sesame, garlic, and pomegranate, topped with crispy sev.',
                        'short_description' => 'Surti tempered chana dal with sev',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Butter Cheese Locho',
                        'description' => 'Melt-in-mouth Surti locho drenched in butter and covered with generous grated cheddar cheese.',
                        'short_description' => 'Butter & cheese loaded locho',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Snacks Platter',
                        'description' => 'The ultimate Surti tasting feast: Dhokla • Idli • Khaman • Locho • Sev Khamani.',
                        'short_description' => 'Dhokla • Idli • Khaman • Locho • Sev Khamani',
                        'price' => 1000, // £10.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                ],
            ],

            // ==========================================
            // 3. Sev Usal & Pav Bhaji
            // ==========================================
            [
                'name' => 'Sev Usal & Pav Bhaji',
                'description' => 'Vadodara-famous spicy dried-pea curries with sev and sizzling Mumbai griddle pav bhaji.',
                'sort_order' => 3,
                'items' => [
                    [
                        'name' => 'Indori Poha',
                        'description' => 'Steamed flattened rice infused with turmeric, fennel, topped with spicy ratlami sev and lemon.',
                        'short_description' => 'Steamed Indori spiced poha with sev',
                        'price' => 500, // £5.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Poha Usal',
                        'description' => 'Warm Indori poha layered with hot spicy white-pea usal gravy and crunchy sev.',
                        'short_description' => 'Indori poha topped with spicy usal',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Sev Usal',
                        'description' => 'Vadodara’s legendary spicy green-pea curry served with 2 soft pavs, spicy tari, and sev.',
                        'short_description' => 'Famous Vadodara spicy usal with 2 pav',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                        'addons' => [
                            ['name' => 'Extra Pav (1 pc)', 'price' => 50],
                            ['name' => 'Extra Spicy Tari Gravy', 'price' => 100],
                            ['name' => 'Extra Sev Bowl', 'price' => 50],
                        ],
                    ],
                    [
                        'name' => 'Samosa Usal',
                        'description' => 'Hot vegetable samosa broken inside rich usal curry with fresh onions, lemon, and sev.',
                        'short_description' => 'Crispy samosa submerged in spicy usal',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Sev Tari',
                        'description' => 'Extra fiery aromatic spiced red tari gravy served with bowls of sev and soft pav.',
                        'short_description' => 'Fiery red spiced broth with crunchy sev',
                        'price' => 700, // £7.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Butter Cheese Sev Usal',
                        'description' => 'Spicy sev usal loaded with melted butter, shredded cheddar, and crunchy toppings.',
                        'short_description' => 'Sev usal with butter and shredded cheese',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Butter Cheese Sev Tari',
                        'description' => 'Fiery tari gravy topped with butter dollops and melted cheese, served with fresh pav.',
                        'short_description' => 'Spicy tari with butter & melted cheese',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Extra Pav',
                        'description' => 'Single soft griddled Mumbai pav bun.',
                        'short_description' => '1 pc soft bakery pav',
                        'price' => 50, // £0.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Regular Pav Bhaji',
                        'description' => 'Mashed mixed seasonal vegetable curry slow-cooked with tomatoes and special bhaji spices, served with 2 pavs.',
                        'short_description' => 'Classic Mumbai vegetable curry with 2 pav',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_popular' => true,
                        'addons' => [
                            ['name' => 'Extra Pav (1 pc)', 'price' => 50],
                            ['name' => 'Extra Butter Slice', 'price' => 50],
                            ['name' => 'Add Shredded Cheese', 'price' => 100],
                        ],
                    ],
                    [
                        'name' => 'Butter Pav Bhaji',
                        'description' => 'Rich pav bhaji cooked in generous creamy butter, served with butter-toasted golden pavs.',
                        'short_description' => 'Rich butter pav bhaji with 2 butter pavs',
                        'price' => 700, // £7.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Veg Tawa Pulav',
                        'description' => 'Fragrant long-grain basmati rice tossed on Mumbai iron tawa with pav bhaji spices and crisp veggies.',
                        'short_description' => 'Tawa-tossed spiced vegetable rice',
                        'price' => 700, // £7.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Bhaji Pulav',
                        'description' => 'Rich combination of basmati pulav blended directly with slow-cooked pav bhaji masala.',
                        'short_description' => 'Iron tawa pulav infused with bhaji gravy',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Cheese Butter Pav Bhaji',
                        'description' => 'Decadent pav bhaji cooked with butter and topped with a lavish layer of melted British cheddar cheese.',
                        'short_description' => 'Double butter & cheese pav bhaji',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Masala Pav with Papad',
                        'description' => 'Pav buns toasted in buttery bhaji masala on the griddle, served with a crunchy roast papad.',
                        'short_description' => 'Spiced griddle masala pav with papad',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Gotala Pav Bhaji',
                        'description' => 'Surat-style specialty pav bhaji blended with crushed paneer, cheese chunks, and fiery spices.',
                        'short_description' => 'Surti paneer & cheese gotala bhaji',
                        'price' => 850, // £8.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                ],
            ],

            // ==========================================
            // 4. Indian Breads
            // ==========================================
            [
                'name' => 'Indian Breads',
                'description' => 'Freshly baked tandoori naans, rotis, and homestyle thin chapatis.',
                'sort_order' => 4,
                'items' => [
                    [
                        'name' => 'Chapati (Plain / Butter)',
                        'description' => 'Soft homestyle whole-wheat flatbread cooked on traditional tawa.',
                        'short_description' => 'Homestyle wholewheat flatbread',
                        'price' => 200, // £2.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'variations' => [
                            ['name' => 'Plain Chapati', 'price' => 200],
                            ['name' => 'Butter Chapati', 'price' => 200],
                        ],
                    ],
                    [
                        'name' => 'Tandoori Roti',
                        'description' => 'Whole-wheat unleavened bread baked crisp in our clay tandoor oven.',
                        'short_description' => 'Clay oven wholewheat roti',
                        'price' => 250, // £2.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                        'variations' => [
                            ['name' => 'Plain Tandoori Roti', 'price' => 250],
                            ['name' => 'Butter Tandoori Roti', 'price' => 250],
                        ],
                    ],
                    [
                        'name' => 'Naan',
                        'description' => 'Traditional refined flour leavened bread slapped inside the clay tandoor oven until fluffy.',
                        'short_description' => 'Fluffy tandoor baked naan bread',
                        'price' => 250, // £2.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_popular' => true,
                        'variations' => [
                            ['name' => 'Plain Naan', 'price' => 250],
                            ['name' => 'Butter Naan', 'price' => 250],
                        ],
                    ],
                    [
                        'name' => 'Chilli Garlic Naan',
                        'description' => 'Tandoori naan topped with fresh minced garlic, spicy green chillies, and coriander butter.',
                        'short_description' => 'Naan topped with garlic & green chillies',
                        'price' => 300, // £3.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Cheese Chilli Garlic Naan',
                        'description' => 'Naan stuffed with melted cheese and topped with crushed garlic and spicy chillies.',
                        'short_description' => 'Melted cheese stuffed garlic chilli naan',
                        'price' => 400, // £4.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                ],
            ],

            // ==========================================
            // 5. Rice & Biryani
            // ==========================================
            [
                'name' => 'Rice & Biryani',
                'description' => 'Fragrant basmati rice preparations, Gujarati comfort khichdi, and slow-cooked dum biryani.',
                'sort_order' => 5,
                'items' => [
                    [
                        'name' => 'Plain Rice',
                        'description' => 'Steamed fragrant aged Indian basmati rice.',
                        'short_description' => 'Steamed aged basmati rice',
                        'price' => 450, // £4.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Jeera Rice',
                        'description' => 'Basmati rice tempered with whole cumin seeds, ghee, and fresh coriander leaves.',
                        'short_description' => 'Cumin-tempered fragrant basmati rice',
                        'price' => 500, // £5.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Masala Pulao',
                        'description' => 'Aromatic basmati rice cooked with whole garam masalas, onions, and mild spices.',
                        'short_description' => 'Aromatic spiced basmati pulao',
                        'price' => 700, // £7.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Vegetable Pulao',
                        'description' => 'Basmati rice cooked with seasonal garden vegetables, peas, carrots, and sweet whole spices.',
                        'short_description' => 'Garden vegetables tossed in basmati rice',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Plain Khichdi',
                        'description' => 'Wholesome comforting Gujarati rice and yellow moong lentil porridge topped with pure ghee.',
                        'short_description' => 'Comforting rice and moong lentil khichdi',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Vegetable Khichdi',
                        'description' => 'Moong dal and rice simmered with garden vegetables, turmeric, and ginger-garlic tempering.',
                        'short_description' => 'Spiced vegetable comfort khichdi',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Mutton Biryani',
                        'description' => 'Tender spiced mutton layered with saffron-infused basmati rice, caramelized onions, and kewra essence.',
                        'short_description' => 'Slow-cooked tender mutton dum biryani',
                        'price' => 850, // £8.50
                        'is_vegetarian' => false,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                        'addons' => [
                            ['name' => 'Cucumber Mint Raita', 'price' => 150],
                            ['name' => 'Mirchi Ka Salan Gravy', 'price' => 150],
                        ],
                    ],
                    [
                        'name' => 'Hyderabadi Biryani',
                        'description' => 'Authentic Nizam-style dum biryani with layered saffron basmati rice, fried onions, and rich spices.',
                        'short_description' => 'Royal Hyderabadi aromatic dum biryani',
                        'price' => 900, // £9.00
                        'is_vegetarian' => false,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                ],
            ],

            // ==========================================
            // 6. Dal & Kadhi
            // ==========================================
            [
                'name' => 'Dal & Kadhi',
                'description' => 'Traditional comforting lentil preparations and sweet-tangy yogurt kadhis.',
                'sort_order' => 6,
                'items' => [
                    [
                        'name' => 'Gujarati Dal',
                        'description' => 'Classic sweet-and-tangy toor dal simmered with jaggery, kokum, peanuts, and aromatic spices.',
                        'short_description' => 'Traditional sweet & tangy toor dal',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Dal Fry',
                        'description' => 'Yellow lentils tempered with ghee, cumin seeds, garlic, onions, tomatoes, and red chilli.',
                        'short_description' => 'Yellow lentils tempered with garlic & ghee',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Punjabi Kadhi',
                        'description' => 'Thick sour yogurt and gram flour gravy simmered with onion pakoras and fenugreek seeds.',
                        'short_description' => 'Tangy yogurt curry with crispy pakoras',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Gujarati Kadhi',
                        'description' => 'Silky smooth sweet-tangy yogurt curry flavoured with ginger, cinnamon, cloves, and curry leaves.',
                        'short_description' => 'Sweet & tangy silky yogurt kadhi',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Dal Tadka',
                        'description' => 'Creamy yellow lentils finished with a smoking double tadka of ghee, whole red chillies, and garlic.',
                        'short_description' => 'Smoky double-tempered yellow lentils',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                ],
            ],

            // ==========================================
            // 7. Punjabi Specialities
            // ==========================================
            [
                'name' => 'Punjabi Specialities',
                'description' => 'Rich North Indian paneer and cheese curries cooked with cream, butter, and fragrant masalas.',
                'sort_order' => 7,
                'items' => [
                    [
                        'name' => 'Paneer Tikka Masala',
                        'description' => 'Char-grilled cottage cheese tikka cooked in a velvety spiced tomato, onion, and cream gravy.',
                        'short_description' => 'Charred cottage cheese in rich tomato gravy',
                        'price' => 1049, // £10.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                        'addons' => [
                            ['name' => 'Extra Paneer Cubes', 'price' => 200],
                            ['name' => 'Add Shredded Cheese', 'price' => 150],
                            ['name' => 'Extra Butter Swirl', 'price' => 50],
                        ],
                    ],
                    [
                        'name' => 'Paneer Butter Masala',
                        'description' => 'Tender paneer cubes bathed in a smooth, mildly spiced butter-cashew silk tomato sauce.',
                        'short_description' => 'Silky butter-cashew tomato paneer curry',
                        'price' => 1049, // £10.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Paneer Bhurji',
                        'description' => 'Crumbled fresh cottage cheese scrambled with onions, juicy tomatoes, green chillies, and butter.',
                        'short_description' => 'Spiced scrambled cottage cheese curry',
                        'price' => 1049, // £10.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Paneer Cheese Gotado',
                        'description' => 'Decadent curry featuring grated paneer and melted cheese simmered in spicy garlic gravy.',
                        'short_description' => 'Grated paneer and rich cheese gravy',
                        'price' => 1149, // £11.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Green Gotado',
                        'description' => 'Chef’s signature coriander-spinach spiced herb gravy cooked with cottage cheese and melted cheese.',
                        'short_description' => 'Fresh green herb gravy with paneer & cheese',
                        'price' => 1149, // £11.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Paneer Angarey',
                        'description' => 'Fiery smoky tandoori spiced paneer cooked with charred bell peppers and whole dried chillies.',
                        'short_description' => 'Smoky hot tandoori spiced paneer',
                        'price' => 1149, // £11.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Cheese Butter Masala',
                        'description' => 'Generous blocks of cheddar and paneer simmered in luxurious makhani butter-cream sauce.',
                        'short_description' => 'Rich cheese cubes in makhani butter sauce',
                        'price' => 1249, // £12.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                ],
            ],

            // ==========================================
            // 8. Kaju Specialities
            // ==========================================
            [
                'name' => 'Kaju Specialities',
                'description' => 'Royal cashewnut curries prepared in rich gravy styles.',
                'sort_order' => 8,
                'items' => [
                    [
                        'name' => 'Kaju Curry',
                        'description' => 'Whole roasted cashews simmered in a velvety sweet-and-creamy aromatic gravy.',
                        'short_description' => 'Whole roasted cashews in rich mild gravy',
                        'price' => 1049, // £10.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Kaju Masala',
                        'description' => 'Golden cashewnuts tossed in a robust, spicy onion-tomato gravy with freshly ground spices.',
                        'short_description' => 'Cashews in spicy tomato-onion masala',
                        'price' => 1049, // £10.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Kaju Bhaji',
                        'description' => 'Cashews cooked with spiced vegetable puree and pav bhaji infused masalas.',
                        'short_description' => 'Cashewnuts cooked with rich bhaji gravy',
                        'price' => 1049, // £10.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Kaju Gathiya',
                        'description' => 'Crispy Kathiyawadi gathiya and roasted cashews cooked in spicy tangy curd-tomato curry.',
                        'short_description' => 'Cashews and crunchy gathiya in spicy curry',
                        'price' => 1149, // £11.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Kaju Paneer Masala',
                        'description' => 'Royal combination of soft paneer cubes and whole cashews in rich Mughlai masala.',
                        'short_description' => 'Paneer and whole cashews in royal gravy',
                        'price' => 1149, // £11.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Cheese Kaju Masala',
                        'description' => 'Roasted cashewnuts and chunks of cheese simmered in spicy butter gravy.',
                        'short_description' => 'Cashews and melted cheese in rich butter curry',
                        'price' => 1249, // £12.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                ],
            ],

            // ==========================================
            // 9. Khichya Papdi
            // ==========================================
            [
                'name' => 'Khichya Papdi',
                'description' => 'Traditional Gujarat rice-flour khichiya papad roasted or fried with spicy toppings.',
                'sort_order' => 9,
                'items' => [
                    [
                        'name' => 'Roasted Papdi',
                        'description' => 'Crisp fire-roasted Gujarati rice-flour khichiya papdi with ground spices.',
                        'short_description' => 'Fire-roasted rice-flour khichiya',
                        'price' => 300, // £3.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Fry Papdi',
                        'description' => 'Deep-fried puffed khichiya papdi served hot and crunchy.',
                        'short_description' => 'Golden fried crunchy khichiya papdi',
                        'price' => 350, // £3.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Masala Papdi',
                        'description' => 'Roasted or fried khichiya loaded with onions, tomatoes, green chillies, chutneys, and sev.',
                        'short_description' => 'Khichiya topped with spiced salad and sev',
                        'price' => 400, // £4.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'The Patel Sp. Papdi',
                        'description' => 'Our ultimate loaded khichiya topped with cheese, special chutneys, spicy masala, and sev.',
                        'short_description' => 'Signature cheese and chutney loaded papdi',
                        'price' => 450, // £4.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                ],
            ],

            // ==========================================
            // 10. Kathiyawadi Specialities
            // ==========================================
            [
                'name' => 'Kathiyawadi Specialities',
                'description' => 'Authentic rustic Saurashtra curries rich in garlic, red chillies, and savoury sev.',
                'sort_order' => 10,
                'items' => [
                    [
                        'name' => 'Sev Tameta',
                        'description' => 'Famous Kathiyawadi sweet-spicy tomato gravy topped with crispy thick chickpea sev.',
                        'short_description' => 'Tangy sweet-spicy tomato curry with sev',
                        'price' => 799, // £7.99
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Papad Ni Sabji',
                        'description' => 'Toasted papad cooked in a light spiced yogurt and cumin gravy with coriander.',
                        'short_description' => 'Crisp papad simmered in spiced yogurt gravy',
                        'price' => 799, // £7.99
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Dahi Tikhari',
                        'description' => 'Thick hung curd tempered with burning hot garlic, cumin, mustard seeds, and red chilli powder.',
                        'short_description' => 'Hot garlic & chilli tempered hung curd',
                        'price' => 799, // £7.99
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Sev Bhaji',
                        'description' => 'Spicy Kathiyawadi onion-tomato gravy cooked with green herbs and crunchy sev.',
                        'short_description' => 'Rustic spiced vegetable gravy with sev',
                        'price' => 899, // £8.99
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Sev Lasan',
                        'description' => 'Pungent crushed red garlic chutney curry loaded with Kathiyawadi sev.',
                        'short_description' => 'Garlic-packed fiery curry with sev',
                        'price' => 899, // £8.99
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Lasaniya Bateta',
                        'description' => 'Baby potatoes slow-cooked in a fiery red garlic paste with rustic whole spices.',
                        'short_description' => 'Spicy garlic baby potato curry',
                        'price' => 899, // £8.99
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Kaju Lasan Gathiya',
                        'description' => 'Royal rustic curry combining roasted cashews, crunchy gathiya, and pungent garlic gravy.',
                        'short_description' => 'Cashews, gathiya & red garlic curry',
                        'price' => 999, // £9.99
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                ],
            ],

            // ==========================================
            // 11. Siya's Special
            // ==========================================
            [
                'name' => "Siya's Special",
                'description' => "Our signature master-chef specials created exclusively for Siya's Kitchen.",
                'sort_order' => 11,
                'items' => [
                    [
                        'name' => 'Sev Gathiya Special',
                        'description' => 'Chef’s unique recipe combining Kathiyawadi gathiya, crispy sev, rich gravy, and secret spices.',
                        'short_description' => 'Chef special signature gathiya & sev curry',
                        'price' => 1249, // £12.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Makhani Methi',
                        'description' => 'Fresh fenugreek leaves and green peas simmered in rich creamy tomato-butter makhani sauce.',
                        'short_description' => 'Fresh fenugreek in silky makhani butter gravy',
                        'price' => 1249, // £12.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => true,
                    ],
                    [
                        'name' => "Kaju's Special",
                        'description' => 'Exotic cashewnut royal preparation infused with saffron cream, crushed paneer, and rich dry fruits.',
                        'short_description' => 'Royal saffron cashew & paneer special',
                        'price' => 1249, // £12.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                ],
            ],

            // ==========================================
            // 12. South Indian
            // ==========================================
            [
                'name' => 'South Indian',
                'description' => 'Crispy fermented rice-lentil crepes, spiced potato fillings, and thick savoury uttapams.',
                'sort_order' => 12,
                'items' => [
                    [
                        'name' => 'Plain Dosa',
                        'description' => 'Golden crispy rice and lentil crepe served with aromatic sambar and fresh coconut chutney.',
                        'short_description' => 'Crisp golden crepe with sambar & chutney',
                        'price' => 400, // £4.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Masala Dosa',
                        'description' => 'Crisp dosa folded over a classic spiced turmeric potato, onion, and mustard-seed filling.',
                        'short_description' => 'Crisp crepe with spiced potato filling',
                        'price' => 450, // £4.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Plain Cheese Dosa',
                        'description' => 'Thin crispy crepe lined with a generous layer of melted cheddar cheese.',
                        'short_description' => 'Crisp dosa filled with melted cheese',
                        'price' => 450, // £4.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Masala Cheese Dosa',
                        'description' => 'Spiced potato mash and melted cheese folded inside a golden crunchy dosa.',
                        'short_description' => 'Spiced potato and melted cheese dosa',
                        'price' => 500, // £5.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Veg. Spring Dosa',
                        'description' => 'Crunchy dosa rolled with wok-tossed shredded cabbage, carrots, spring onions, and Schezwan sauce.',
                        'short_description' => 'Wok-tossed crunchy veggie spring roll dosa',
                        'price' => 550, // £5.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Onion Uttapam',
                        'description' => 'Thick savoury fermented pancake topped with caramelized red onions and green chillies.',
                        'short_description' => 'Thick rice pancake topped with onions',
                        'price' => 550, // £5.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Tomato Uttapam',
                        'description' => 'Thick savoury pancake studded with ripe juicy tomatoes and fresh coriander.',
                        'short_description' => 'Thick rice pancake topped with fresh tomatoes',
                        'price' => 550, // £5.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Mysore Masala Dosa',
                        'description' => 'Crispy crepe smeared inside with spicy red garlic-chilli chutney and stuffed with spiced potato masala.',
                        'short_description' => 'Spicy red chutney & potato masala dosa',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Masala Uttapam',
                        'description' => 'Thick pancake topped with spiced potato mash, diced onions, tomatoes, and gunpowder spices.',
                        'short_description' => 'Loaded spiced potato & vegetable uttapam',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Mysore Cheese Masala Dosa',
                        'description' => 'Spicy Mysore red chutney, melted cheddar cheese, and spiced potato filling inside crisp dosa.',
                        'short_description' => 'Mysore red chutney, cheese & potato dosa',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Bhaji Dosa',
                        'description' => 'Crisp crepe stuffed with buttery Mumbai pav bhaji vegetable masala.',
                        'short_description' => 'Pav bhaji masala stuffed crispy dosa',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Paneer Cheese Masala Dosa',
                        'description' => 'Loaded crepe with grated spiced paneer, melted cheese, and aromatic herb potato filling.',
                        'short_description' => 'Grated paneer, melted cheese & potato dosa',
                        'price' => 700, // £7.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                ],
            ],

            // ==========================================
            // 13. Indo-Chinese
            // ==========================================
            [
                'name' => 'Indo-Chinese',
                'description' => 'Wok-tossed noodles, fried rice, and crispy vegetable manchurian delicacies.',
                'sort_order' => 13,
                'items' => [
                    [
                        'name' => 'Schezwan Noodles',
                        'description' => 'Wok-tossed noodles with shredded vegetables and spicy red Schezwan pepper sauce.',
                        'short_description' => 'Spicy wok-tossed Schezwan noodles',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Veg. Hakka Noodles',
                        'description' => 'Classic wok-fried noodles tossed with cabbage, carrots, peppers, and light soy sauce.',
                        'short_description' => 'Classic vegetable Hakka noodles',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Schezwan Rice',
                        'description' => 'Fragrant rice stir-fried in high-heat wok with spicy Schezwan sauce and crisp vegetables.',
                        'short_description' => 'Fiery wok-tossed Schezwan fried rice',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Manchurian Noodles',
                        'description' => 'Wok noodles tossed with vegetable manchurian balls, garlic, ginger, and dark soy glaze.',
                        'short_description' => 'Noodles tossed with veggie manchurian balls',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Singaporean Noodles',
                        'description' => 'Thin noodles stir-fried with curry powder, bell peppers, beansprouts, and chilli oil.',
                        'short_description' => 'Curry-spiced aromatic Singapore noodles',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Manchurian Rice',
                        'description' => 'Fried rice topped with vegetable manchurian dumplings and rich soy-garlic sauce.',
                        'short_description' => 'Fried rice combined with manchurian sauce',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Singaporean M. Rice',
                        'description' => 'Singapore-style curried fried rice tossed with crispy vegetable manchurian bites.',
                        'short_description' => 'Curried fried rice with manchurian bites',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Bombay Crispy Noodles',
                        'description' => 'Crispy fried noodles smothered in a hot sweet-and-sour tangy vegetable gravy.',
                        'short_description' => 'Crispy noodles with tangy sweet-sour gravy',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Manchurian Dry / Gravy',
                        'description' => 'Minced vegetable dumplings tossed in garlic, ginger, green chillies, and soy sauce.',
                        'short_description' => 'Vegetable dumplings in soy-garlic sauce',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_popular' => true,
                        'variations' => [
                            ['name' => 'Manchurian Dry (Starter)', 'price' => 800],
                            ['name' => 'Manchurian with Gravy (Saucy)', 'price' => 800],
                        ],
                    ],
                    [
                        'name' => 'Chinese Bhel',
                        'description' => 'Crunchy fried noodles tossed with fresh shredded veggies, sweet-spicy Schezwan chutney, and spring onions.',
                        'short_description' => 'Crispy fried noodles tossed in Schezwan bhel',
                        'price' => 900, // £9.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_featured' => true,
                        'is_popular' => true,
                    ],
                    [
                        'name' => 'Popcorn Manchurian',
                        'description' => 'Bite-sized ultra-crispy battered vegetable popcorn tossed in fiery Indo-Chinese glaze.',
                        'short_description' => 'Crispy bite-sized popcorn manchurian',
                        'price' => 1000, // £10.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                ],
            ],
        ];

        foreach ($categoriesData as $catData) {
            $items = $catData['items'] ?? [];
            unset($catData['items']);

            $catData['is_active'] = true;

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
