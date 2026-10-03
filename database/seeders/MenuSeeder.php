<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds with the official Siyas Kitchen menu items and prices in GBP.
     */
    public function run(): void
    {
        $categoriesData = [
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
                    ],
                    [
                        'name' => 'Ragda Pani Puri (6 pcs)',
                        'description' => 'Warm white-pea ragda filled puris served with spicy mint water and tangy tamarind chutney.',
                        'short_description' => '6 pcs warm ragda puris',
                        'price' => 300, // £3.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
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
                    ],
                    [
                        'name' => 'Sev Puri (6 pcs)',
                        'description' => 'Flat puris topped with diced potatoes, onions, trio of spicy-sweet chutneys, and a mountain of crispy nylon sev.',
                        'short_description' => '6 pcs crunchy sev puri',
                        'price' => 350, // £3.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
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
                    ],
                    [
                        'name' => 'P.P. Mini — 3 Portions (Takeaway)',
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
                    ],
                    [
                        'name' => 'Aloo Tikki Chaat',
                        'description' => 'Spiced potato patties pan-grilled golden and served with chole, yogurt, and date-tamarind chutney.',
                        'short_description' => 'Golden potato patty chaat',
                        'price' => 650, // £6.50
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
                    ],

                    // Dabeli
                    [
                        'name' => 'Regular Dabeli',
                        'description' => 'Kutch-style sweet-tangy spiced potato mash stuffed in pav with roasted peanuts and pomegranate.',
                        'short_description' => 'Authentic Kutchi dabeli',
                        'price' => 200, // £2.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Butter Dabeli',
                        'description' => 'Traditional Dabeli toasted generously on the tawa in pure dairy butter.',
                        'short_description' => 'Butter-toasted dabeli',
                        'price' => 250, // £2.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'B. Sev Onion Dabeli',
                        'description' => 'Butter-toasted dabeli with extra crunchy red onions and crispy nylon sev.',
                        'short_description' => 'Butter sev onion dabeli',
                        'price' => 300, // £3.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'B. Cheese Dabeli',
                        'description' => 'Butter-toasted dabeli topped with grated cheddar cheese.',
                        'short_description' => 'Butter cheese dabeli',
                        'price' => 400, // £4.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Katka Dabeli',
                        'description' => 'Chopped bite-sized dabeli pav bowl soaked in sweet-spicy chutneys and sev.',
                        'short_description' => 'Crushed bowl style dabeli',
                        'price' => 400, // £4.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Sev Onion Cheese Dabeli',
                        'description' => 'Loaded dabeli with butter, melted cheese, crisp sev, and fresh onions.',
                        'short_description' => 'Sev onion & cheese dabeli',
                        'price' => 450, // £4.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],

                    // Sandwiches
                    [
                        'name' => 'Cheese Toast Sandwich',
                        'description' => 'Golden-grilled bread filled with melted cheddar cheese and house herbs.',
                        'short_description' => 'Toasted cheese sandwich',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Veg Cheese Sandwich',
                        'description' => 'Fresh cucumber, tomato, beetroot, and cheese with butter and green mint chutney.',
                        'short_description' => 'Fresh garden veg & cheese',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Bombay Sandwich',
                        'description' => 'The quintessential Mumbai layered sandwich with spiced potatoes, crunchy vegetables, and chaat masala.',
                        'short_description' => 'Classic Bombay street sandwich',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Samosa Sandwich',
                        'description' => 'Crushed vegetable samosa pressed inside buttered toast with mint chutney and cheese.',
                        'short_description' => 'Grilled samosa & cheese sandwich',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Ghughra Sandwich',
                        'description' => 'Spiced savoury ghughra stuffing toasted in artisan bread with chutneys.',
                        'short_description' => 'Gujarati ghughra toast',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Paneer Tikka Sandwich',
                        'description' => 'Marinated tandoori cottage cheese cubes grilled with capsicum, cheese, and spicy mayo.',
                        'short_description' => 'Smoky paneer tikka sandwich',
                        'price' => 700, // £7.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'The Patel Special Sandwich',
                        'description' => 'Triple-decker supreme sandwich packed with paneer, cheese, potato masala, and exotic dressings.',
                        'short_description' => 'Triple-decker Patel signature',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],

                    // Chips & Sides
                    [
                        'name' => 'Chilli Cheese Bites (4 pcs)',
                        'description' => 'Crispy jalapeño and melted cheese poppers served with dipping sauce.',
                        'short_description' => '4 pcs spicy cheese bites',
                        'price' => 300, // £3.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Plain Chips',
                        'description' => 'Crisp golden potato fries lightly salted.',
                        'short_description' => 'Classic golden fries',
                        'price' => 400, // £4.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Masala Chips',
                        'description' => 'French fries tossed in a spicy, tangy Indian tomato-garlic masala glaze.',
                        'short_description' => 'Fiery masala tossed chips',
                        'price' => 450, // £4.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Chilli Garlic Chips',
                        'description' => 'Crispy chips sautéed with crushed garlic, green chillies, and spring onions.',
                        'short_description' => 'Zesty chilli garlic chips',
                        'price' => 500, // £5.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'The Patel Sp. Chips',
                        'description' => 'Signature chips loaded with melted cheese, spicy sauces, and roasted spices.',
                        'short_description' => 'Loaded Patel signature chips',
                        'price' => 500, // £5.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Chilli Cheese Bites (8 pcs)',
                        'description' => 'Sharing portion of 8 crispy jalapeño and cheese bites.',
                        'short_description' => '8 pcs sharing cheese bites',
                        'price' => 500, // £5.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                ],
            ],
            [
                'name' => 'Dhokla & Surti Special',
                'description' => 'Authentic steamed Gujarati savouries, live dhoklas, and famous Surat delicacies.',
                'sort_order' => 2,
                'items' => [
                    [
                        'name' => 'Live Dhokla',
                        'description' => 'Freshly steamed fermented lentil and rice sponge tempered with mustard seeds and curry leaves.',
                        'short_description' => 'Freshly steamed live dhokla',
                        'price' => 500, // £5.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Idla',
                        'description' => 'Soft and fluffy steamed white rice-lentil savoury cakes, served with green chutney.',
                        'short_description' => 'Traditional steamed idla',
                        'price' => 500, // £5.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Regular Locho',
                        'description' => 'Surat’s iconic soft steamed gram flour dish seasoned with locho masala, oil, and raw onions.',
                        'short_description' => 'Famous Surti regular locho',
                        'price' => 550, // £5.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Butter Locho',
                        'description' => 'Soft Surti locho generously bathed in pure melted butter and aromatic spices.',
                        'short_description' => 'Pure butter Surti locho',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Rasawala Khaman',
                        'description' => 'Moist khaman pieces immersed in a warm, tangy, and spiced savoury lentil broth.',
                        'short_description' => 'Khaman in spiced gravy broth',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Vatidal Khaman',
                        'description' => 'Coarsely ground chana dal steamed and seasoned with green chillies and fresh coriander.',
                        'short_description' => 'Coarse ground vatidal khaman',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Dahi Khaman',
                        'description' => 'Khaman topped with lightly sweetened spiced curd, pomegranate, and crunchy sev.',
                        'short_description' => 'Khaman with cool spiced yogurt',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Sev Khamani',
                        'description' => 'Crumbled chana dal delicacy sautéed with garlic, ginger, and garnished with pomegranate and sev.',
                        'short_description' => 'Traditional savoury sev khamani',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Butter Cheese Locho',
                        'description' => 'Surti locho topped with both rich melted butter and a thick layer of grated cheese.',
                        'short_description' => 'Butter & cheese loaded locho',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Snacks Platter (Dhokla + Idli + Khaman + Locho + Sev Khamani)',
                        'description' => 'Grand Surti tasting platter featuring Dhokla, Idla, Khaman, Locho, and Sev Khamani.',
                        'short_description' => 'Grand 5-item Gujarat tasting platter',
                        'price' => 1000, // £10.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => true,
                    ],
                ],
            ],
            [
                'name' => 'Sev Usal & Pav Bhaji',
                'description' => 'Hearty Vadodara-style pea curries and hot buttery Mumbai griddle pav bhaji.',
                'sort_order' => 3,
                'items' => [
                    [
                        'name' => 'Indori Poha',
                        'description' => 'Steamed flattened rice infused with fennel seeds, turmeric, topped with jeeravan masala and sev.',
                        'short_description' => 'Steamed Indori spiced poha',
                        'price' => 500, // £5.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Poha Usal',
                        'description' => 'Indori poha served with a ladle of hot spicy dried-pea usal curry.',
                        'short_description' => 'Poha paired with usal gravy',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Sev Usal',
                        'description' => 'Famous Vadodara spicy pea curry served with spring onions, tari sauce, sev, and buttered pav.',
                        'short_description' => 'Vadodara special sev usal',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Samosa Usal',
                        'description' => 'Hot vegetable samosas soaked in spicy white pea usal gravy with sev.',
                        'short_description' => 'Crispy samosa in usal gravy',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Sev Tari',
                        'description' => 'Extra fiery aromatic chili-garlic oil broth served over crispy sev and pav.',
                        'short_description' => 'Spicy sev & tari broth',
                        'price' => 700, // £7.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Butter Cheese Sev Usal',
                        'description' => 'Rich sev usal topped with butter and a snowfall of cheddar cheese.',
                        'short_description' => 'Butter & cheese sev usal',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Butter Cheese Sev Tari',
                        'description' => 'Fiery tari broth loaded with rich butter, cheese, and crunchy sev.',
                        'short_description' => 'Butter cheese tari special',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Extra Pav',
                        'description' => 'Two soft toasted pav bread rolls.',
                        'short_description' => 'Side portion of pav',
                        'price' => 50, // £0.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Regular Pav Bhaji',
                        'description' => 'Mashed mixed vegetable curry simmered on a giant tawa with spices, served with 2 buttered pavs.',
                        'short_description' => 'Classic Mumbai pav bhaji',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Butter Pav Bhaji',
                        'description' => 'Rich tawa bhaji finished with a generous pool of pure butter, served with butter pavs.',
                        'short_description' => 'Double butter pav bhaji',
                        'price' => 700, // £7.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Veg Tawa Pulav',
                        'description' => 'Basmati rice cooked on the bhaji griddle with tomatoes, capsicum, peas, and pav bhaji masala.',
                        'short_description' => 'Mumbai tawa spiced pulav',
                        'price' => 700, // £7.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Bhaji Pulav',
                        'description' => 'Aromatic spiced rice tossed with thick vegetable bhaji mash and spices.',
                        'short_description' => 'Bhaji infused rice pulav',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Cheese Butter Pav Bhaji',
                        'description' => 'Velvety pav bhaji cooked in butter and blanketed with melted cheddar cheese.',
                        'short_description' => 'Melted cheese butter pav bhaji',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Masala Pav with Papad',
                        'description' => 'Pav rolls stuffed and coated with spicy onion-tomato bhaji masala, served with crispy papad.',
                        'short_description' => 'Masala pav with roasted papad',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Gotala Pav Bhaji',
                        'description' => 'Surti specialty bhaji combined with grated paneer/cheese and rich spiced gravy.',
                        'short_description' => 'Surti gotala special bhaji',
                        'price' => 850, // £8.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                ],
            ],
            [
                'name' => 'Khichiya Papdi & Kathiyawadi',
                'description' => 'Traditional Saurashtra & Kathiyawadi village curries and rice crisps.',
                'sort_order' => 4,
                'items' => [
                    [
                        'name' => 'Roasted Khichiya Papdi',
                        'description' => 'Fire-roasted Gujarati seasoned rice flour papad.',
                        'short_description' => 'Roasted rice flour papdi',
                        'price' => 300, // £3.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Fry Khichiya Papdi',
                        'description' => 'Crisp-fried golden rice papdi.',
                        'short_description' => 'Crispy fried khichiya',
                        'price' => 350, // £3.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Masala Khichiya Papdi',
                        'description' => 'Khichiya papdi topped with butter, chopped onions, tomatoes, and special masala.',
                        'short_description' => 'Spiced onion tomato papdi',
                        'price' => 400, // £4.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'The Patel Sp. Papdi',
                        'description' => 'Signature khichiya papdi loaded with cheese, chutneys, sev, and spices.',
                        'short_description' => 'Patel special loaded papdi',
                        'price' => 450, // £4.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Sev Tameta',
                        'description' => 'Sweet, tangy, and spicy tomato curry topped with crispy spicy sev.',
                        'short_description' => 'Classic Kathiyawadi sev tomato curry',
                        'price' => 799, // £7.99
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Papad Ni Sabji',
                        'description' => 'Roasted papad pieces simmered in a spiced yogurt-fenugreek gravy.',
                        'short_description' => 'Traditional spiced papad curry',
                        'price' => 799, // £7.99
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Dahi Tikhari',
                        'description' => 'Spiced roasted garlic and chilli tempering poured over chilled whisked curd.',
                        'short_description' => 'Garlic chilli spiced yogurt curry',
                        'price' => 799, // £7.99
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Sev Bhaji',
                        'description' => 'Spiced rustic vegetable gravy topped with thick gram flour sev.',
                        'short_description' => 'Spiced Kathiyawadi sev bhaji',
                        'price' => 899, // £8.99
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Sev Lasan',
                        'description' => 'Fiery roasted whole garlic and chilli paste cooked with sev in traditional style.',
                        'short_description' => 'Garlic chilli sev curry',
                        'price' => 899, // £8.99
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Lasaniya Bateta',
                        'description' => 'Baby potatoes slow-cooked in a fiery crimson garlic-red chilli Kathiyawadi paste.',
                        'short_description' => 'Spicy garlic baby potato curry',
                        'price' => 899, // £8.99
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Kaju Lasan Gathiya',
                        'description' => 'Crunchy cashew nuts, garlic cloves, and Bhavnagari gathiya simmered in a royal curry.',
                        'short_description' => 'Royal cashew garlic gathiya curry',
                        'price' => 999, // £9.99
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                ],
            ],
            [
                'name' => "Siya's Special",
                'description' => 'Our Executive Chef’s signature creations prepared with royal cashew gravies and exotic spices.',
                'sort_order' => 5,
                'items' => [
                    [
                        'name' => 'Sev Gathiya Special',
                        'description' => 'Signature rich gravy prepared with premium gathiya, cashews, and aromatic heritage spices.',
                        'short_description' => 'Siya’s signature gathiya creation',
                        'price' => 1249, // £12.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Makhani Methi',
                        'description' => 'Fresh fenugreek leaves and tender cottage cheese simmered in a rich, buttery tomato makhani cream sauce.',
                        'short_description' => 'Buttery fenugreek & cream gravy',
                        'price' => 1249, // £12.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => true,
                    ],
                    [
                        'name' => "Kaju's Special",
                        'description' => 'Whole roasted cashews slow-simmered in a rich golden saffron and onion-tomato gravy.',
                        'short_description' => 'Royal whole cashew signature curry',
                        'price' => 1249, // £12.49
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => true,
                    ],
                ],
            ],
            [
                'name' => 'Indian Breads & Rice',
                'description' => 'Freshly baked tandoori breads, chapatis, and aromatic biryanis.',
                'sort_order' => 6,
                'items' => [
                    [
                        'name' => 'Chapati (Plain / Butter)',
                        'description' => 'Soft home-style wholewheat thin rotis made fresh on the griddle.',
                        'short_description' => 'Fresh wholewheat chapati',
                        'price' => 200, // £2.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Tandoori Roti',
                        'description' => 'Crisp wholewheat flatbread baked in the clay tandoor.',
                        'short_description' => 'Clay oven tandoori roti',
                        'price' => 250, // £2.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Naan',
                        'description' => 'Traditional leavened soft white bread baked fresh in the tandoor oven.',
                        'short_description' => 'Classic tandoori naan',
                        'price' => 250, // £2.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Chilli Garlic Naan',
                        'description' => 'Tandoori naan topped with roasted garlic and crushed green chillies.',
                        'short_description' => 'Spicy garlic chilli naan',
                        'price' => 300, // £3.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Cheese Chilli Garlic Naan',
                        'description' => 'Naan stuffed and topped with melted cheese, roasted garlic, and green chillies.',
                        'short_description' => 'Melted cheese chilli garlic naan',
                        'price' => 400, // £4.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Plain Rice',
                        'description' => 'Steamed premium long-grain aged basmati rice.',
                        'short_description' => 'Steamed basmati rice',
                        'price' => 450, // £4.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Jeera Rice',
                        'description' => 'Basmati rice tempered with roasted cumin seeds and fresh ghee.',
                        'short_description' => 'Cumin tempered basmati rice',
                        'price' => 500, // £5.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Masala Pulao',
                        'description' => 'Fragrant rice cooked with whole spices, bay leaves, and caramelized onions.',
                        'short_description' => 'Spiced whole herb pulao',
                        'price' => 700, // £7.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Vegetable Pulao',
                        'description' => 'Basmati rice tossed with garden green peas, carrots, beans, and cumin.',
                        'short_description' => 'Fresh vegetable basmati pulao',
                        'price' => 700, // £7.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Plain Khichdi',
                        'description' => 'Comforting slow-cooked rice and yellow lentils with ghee.',
                        'short_description' => 'Nutritious yellow lentil khichdi',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Vegetable Khichdi',
                        'description' => 'Khichdi infused with mixed seasonal vegetables and mild spices.',
                        'short_description' => 'Healthy vegetable khichdi',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Mutton Biryani',
                        'description' => 'Tender spiced mutton layered on dum with saffron basmati rice and whole spices.',
                        'short_description' => 'Slow-cooked mutton dum biryani',
                        'price' => 850, // £8.50
                        'is_vegetarian' => false,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Hyderabadi Biryani',
                        'description' => 'Authentic spiced chicken dum biryani with fried onions, mint, and saffron.',
                        'short_description' => 'Traditional Hyderabadi dum biryani',
                        'price' => 900, // £9.00
                        'is_vegetarian' => false,
                        'is_vegan' => false,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                ],
            ],
            [
                'name' => 'Dal & Kadhi',
                'description' => 'Traditional slow-cooked lentil curries and buttermilk kadhis.',
                'sort_order' => 7,
                'items' => [
                    [
                        'name' => 'Gujarati Dal',
                        'description' => 'Authentic sweet-sour toor dal cooked with jaggery, peanuts, kokum, and spices.',
                        'short_description' => 'Sweet & sour Gujarati toor dal',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Dal Fry',
                        'description' => 'Yellow lentils cooked and sautéed with butter, onions, tomatoes, and garlic.',
                        'short_description' => 'Homestyle yellow dal fry',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Punjabi Kadhi',
                        'description' => 'Thick sour yogurt and gram-flour curry with fried onion pakoras.',
                        'short_description' => 'Punjabi yogurt pakora kadhi',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Gujarati Kadhi',
                        'description' => 'Light, sweet and tangy yoghurt-based curry tempered with mustard and ginger.',
                        'short_description' => 'Sweet-tangy buttermilk kadhi',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Dal Tadka',
                        'description' => 'Slow-simmered yellow lentils tempered with hot ghee, cumin, dried red chillies, and garlic.',
                        'short_description' => 'Garlic and cumin tempered yellow dal',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => true,
                    ],
                ],
            ],
            [
                'name' => 'South Indian',
                'description' => 'Crisp fermented rice-lentil crepes and savoury uttapams.',
                'sort_order' => 8,
                'items' => [
                    [
                        'name' => 'Plain Dosa',
                        'description' => 'Golden crisp fermented crepe served with sambar and coconut chutney.',
                        'short_description' => 'Classic crisp plain dosa',
                        'price' => 400, // £4.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Masala Dosa',
                        'description' => 'Crisp dosa filled with tempered mustard-onion potato masala.',
                        'short_description' => 'Spiced potato filled masala dosa',
                        'price' => 450, // £4.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Plain Cheese Dosa',
                        'description' => 'Crispy golden crepe loaded with melted grated cheese.',
                        'short_description' => 'Melted cheese plain dosa',
                        'price' => 450, // £4.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Masala Cheese Dosa',
                        'description' => 'Potato masala dosa topped with generous melted cheddar cheese.',
                        'short_description' => 'Spiced potato & cheese dosa',
                        'price' => 500, // £5.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Veg. Spring Dosa',
                        'description' => 'Crispy dosa filled with crunchy stir-fried noodles, vegetables, and schezwan sauce.',
                        'short_description' => 'Indo-Chinese spring roll dosa',
                        'price' => 550, // £5.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Onion Uttapam',
                        'description' => 'Thick savoury pancake topped with golden caramelized onions and coriander.',
                        'short_description' => 'Thick onion pancake uttapam',
                        'price' => 550, // £5.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Tomato Uttapam',
                        'description' => 'Savoury rice-lentil pancake topped with juicy tomatoes and mild green chillies.',
                        'short_description' => 'Fresh tomato uttapam',
                        'price' => 550, // £5.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Mysore Masala Dosa',
                        'description' => 'Dosa smeared with fiery red garlic-chilli chutney and filled with potato masala.',
                        'short_description' => 'Spicy red chutney Mysore dosa',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Masala Uttapam',
                        'description' => 'Thick uttapam topped with onions, tomatoes, capsicum, and potato masala.',
                        'short_description' => 'Loaded vegetable masala uttapam',
                        'price' => 600, // £6.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Mysore Cheese Masala Dosa',
                        'description' => 'Fiery Mysore red chutney dosa with potato masala and a blanket of cheese.',
                        'short_description' => 'Mysore masala with cheese',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Bhaji Dosa',
                        'description' => 'Crisp dosa filled with rich Mumbai tawa pav bhaji.',
                        'short_description' => 'Pav bhaji stuffed dosa',
                        'price' => 650, // £6.50
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Paneer Cheese Masala Dosa',
                        'description' => 'Dosa stuffed with seasoned cottage cheese paneer, cheddar cheese, and potato masala.',
                        'short_description' => 'Paneer & cheese supreme dosa',
                        'price' => 700, // £7.00
                        'is_vegetarian' => true,
                        'is_vegan' => false,
                        'is_spicy' => false,
                        'is_featured' => true,
                    ],
                ],
            ],
            [
                'name' => 'Indo-Chinese',
                'description' => 'Wok-tossed noodles, fried rice, and tangy Indo-Chinese Manchurian favourites.',
                'sort_order' => 9,
                'items' => [
                    [
                        'name' => 'Schezwan Noodles',
                        'description' => 'Wok-tossed wheat noodles with fresh vegetables in spicy garlic-Schezwan sauce.',
                        'short_description' => 'Spicy Schezwan vegetable noodles',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Veg. Hakka Noodles',
                        'description' => 'Classic wok-fried noodles tossed with julienned cabbage, carrots, bell peppers, and soy.',
                        'short_description' => 'Classic wok Hakka noodles',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Schezwan Rice',
                        'description' => 'Aromatic basmati rice stir-fried in a fiery wok with vegetables and Schezwan chili paste.',
                        'short_description' => 'Spicy Schezwan fried rice',
                        'price' => 750, // £7.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Manchurian Noodles',
                        'description' => 'Wok noodles tossed with crispy vegetable Manchurian balls and dark soy-ginger glaze.',
                        'short_description' => 'Noodles tossed with Manchurian balls',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Singaporean Noodles',
                        'description' => 'Thin rice vermicelli noodles stir-fried with turmeric, curry powder, chillies, and vegetables.',
                        'short_description' => 'Curry spiced Singapore noodles',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Manchurian Rice',
                        'description' => 'Fried rice topped and tossed with golden vegetable Manchurian dumplings.',
                        'short_description' => 'Fried rice with Manchurian balls',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Singaporean M. Rice',
                        'description' => 'Spiced Singaporean curry fried rice with vegetables and Manchurian nuggets.',
                        'short_description' => 'Singapore curry fried rice',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Bombay Crispy Noodles',
                        'description' => 'Crispy fried noodles topped with sweet and spicy vegetable gravy.',
                        'short_description' => 'Crispy noodles in tangy sauce',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Manchurian Dry / Gravy',
                        'description' => 'Crispy mixed vegetable dumplings tossed in garlic, ginger, green chillies, and soy sauce (Dry or Gravy).',
                        'short_description' => 'Classic vegetable Manchurian',
                        'price' => 800, // £8.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Chinese Bhel',
                        'description' => 'Crispy fried noodles tossed with shredded cabbage, onions, bell peppers, and tangy Schezwan chutney.',
                        'short_description' => 'Crisp noodles & Schezwan bhel',
                        'price' => 900, // £9.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                    ],
                    [
                        'name' => 'Popcorn Manchurian',
                        'description' => 'Crunchy bite-sized Manchurian popcorn bites seasoned with five-spice and dip.',
                        'short_description' => 'Crunchy Manchurian bite poppers',
                        'price' => 1000, // £10.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => true,
                        'is_featured' => true,
                    ],
                ],
            ],
            [
                'name' => 'Papad',
                'description' => 'Crispy roasted and fried accompaniments.',
                'sort_order' => 10,
                'items' => [
                    [
                        'name' => 'Roasted Papad',
                        'description' => 'Flame-roasted crisp lentil cracker with black pepper.',
                        'short_description' => 'Flame roasted lentil papad',
                        'price' => 150, // £1.50
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Fry Papad',
                        'description' => 'Golden deep-fried crunchy lentil papad.',
                        'short_description' => 'Golden fried papad',
                        'price' => 200, // £2.00
                        'is_vegetarian' => true,
                        'is_vegan' => true,
                        'is_spicy' => false,
                    ],
                    [
                        'name' => 'Masala Papad',
                        'description' => 'Crispy fried papad topped with diced onions, juicy tomatoes, fresh coriander, chaat masala, and lemon juice.',
                        'short_description' => 'Spiced onion tomato papad',
                        'price' => 250, // £2.50
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
