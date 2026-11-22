<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class MenuItem extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'menu_category_id',
        'name',
        'slug',
        'description',
        'short_description',
        'price', // Stored in integer pence (e.g., 1295 for £12.95)
        'image',
        'is_vegetarian',
        'is_vegan',
        'is_spicy',
        'is_featured',
        'is_popular',
        'is_available',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'integer',
        'is_vegetarian' => 'boolean',
        'is_vegan' => 'boolean',
        'is_spicy' => 'boolean',
        'is_featured' => 'boolean',
        'is_popular' => 'boolean',
        'is_available' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var list<string>
     */
    protected $appends = [
        'formatted_price',
        'price_in_pounds',
        'image_url',
    ];

    /**
     * Bootstrap the model and its traits.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (MenuItem $item) {
            if (empty($item->slug) && !empty($item->name)) {
                $item->slug = Str::slug($item->name);
            }
        });
    }

    /**
     * Category that this menu item belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }

    /**
     * Variations for this menu item (e.g., Regular, Large).
     */
    public function variations(): HasMany
    {
        return $this->hasMany(MenuItemVariation::class, 'menu_item_id')->orderBy('sort_order', 'asc');
    }

    /**
     * Add-ons for this menu item (e.g., Extra Cheese, Extra Sauce).
     */
    public function addons(): HasMany
    {
        return $this->hasMany(MenuItemAddon::class, 'menu_item_id')->orderBy('sort_order', 'asc');
    }

    /**
     * Formatted price attribute (e.g., £12.95).
     */
    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: function () {
                $symbol = config('restaurant.currency.symbol', '£');
                return $symbol . number_format($this->price / 100, 2);
            }
        );
    }

    /**
     * Price in decimal pounds (e.g., 12.95).
     */
    protected function priceInPounds(): Attribute
    {
        return Attribute::make(
            get: fn () => round($this->price / 100, 2),
            set: fn ($value) => (int) round((float) $value * 100)
        );
    }

    /**
     * Resolves the full URL to the item image, accurately falling back to an authentic food photo matching the dish name.
     */
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!empty($this->image)) {
                    if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
                        return $this->image;
                    }
                    // Prevent fallback dining room photo or missing file from masking the authentic food photo
                    if (!str_contains($this->image, 'about-interior') && file_exists(public_path($this->image))) {
                        return asset($this->image);
                    }
                }

                $resolved = self::resolveDishImage($this->name, $this->category?->slug ?? '', $this->slug ?? '');
                return asset($resolved);
            }
        );
    }

    /**
     * Accurately match any dish name to its specific food photo.
     */
    public static function resolveDishImage(string $name, string $catSlug = '', string $slug = ''): string
    {
        $n = strtolower($name);
        $c = strtolower($catSlug);

        // 1. Street Food - Puri & Chaat items
        if (str_contains($n, 'dahi puri') || str_contains($n, 'dahi poori')) {
            return 'images/dishes/dahi-puri.jpg';
        }
        if (str_contains($n, 'ragda')) {
            return 'images/dishes/ragda-pani-puri.jpg';
        }
        if (str_contains($n, 'chutney puri')) {
            return 'images/dishes/chutney-puri.jpg';
        }
        if (str_contains($n, 'sev puri')) {
            return 'images/dishes/sev-puri.jpg';
        }
        if (str_contains($n, 'pani puri') || str_contains($n, 'p.p mini') || str_contains($n, 'family pack')) {
            return 'images/dishes/pani-puri.jpg';
        }
        if (str_contains($n, 'basket chaat')) {
            return 'images/dishes/basket-chaat.jpg';
        }
        if (str_contains($n, 'papdi chaat') || str_contains($n, 'papri chaat')) {
            return 'images/dishes/papdi-chaat.jpg';
        }
        if (str_contains($n, 'samosa chaat') || str_contains($n, 'ghughra chaat')) {
            return 'images/dishes/samosa-chaat.jpg';
        }
        if (str_contains($n, 'aloo tikki')) {
            return 'images/dishes/aloo-tikki-chaat.jpg';
        }
        if (str_contains($n, 'chaat')) {
            return 'images/dishes/basket-chaat.jpg';
        }

        // 2. Vadapav items
        if (str_contains($n, 'vadapav') || str_contains($n, 'vada pav')) {
            return 'images/dishes/vada-pav.jpg';
        }

        // 3. Dabeli items
        if (str_contains($n, 'dabeli')) {
            return 'images/dishes/dabeli.jpg';
        }

        // 4. Sandwich items
        if (str_contains($n, 'paneer tikka sandwich')) {
            return 'images/dishes/paneer-tikka-sandwich.jpg';
        }
        if (str_contains($n, 'bombay')) {
            return 'images/dishes/bombay-sandwich.jpg';
        }
        if (str_contains($n, 'samosa sandwich')) {
            return 'images/dishes/samosa-sandwich.jpg';
        }
        if (str_contains($n, 'veg cheese') || str_contains($n, 'vegetable cheese')) {
            return 'images/dishes/veg-cheese-sandwich.jpg';
        }
        if (str_contains($n, 'sandwich') || str_contains($n, 'toast')) {
            return 'images/dishes/cheese-toast-sandwich.jpg';
        }

        // 5. Chips, Fries & Bites
        if (str_contains($n, 'bites') || str_contains($n, 'chilli cheese bites')) {
            return 'images/dishes/chilli-cheese-bites.jpg';
        }
        if (str_contains($n, 'chips') || str_contains($n, 'fries')) {
            return 'images/dishes/masala-chips.jpg';
        }

        // 6. Papad & Papdi
        if (str_contains($n, 'papad')) {
            return 'images/dishes/masala-papad.jpg';
        }
        if (str_contains($n, 'khichya') || str_contains($n, 'papdi') || str_contains($c, 'khichya')) {
            return 'images/dishes/khichiya-papdi.jpg';
        }

        // 7. Dhokla & Surti Special
        if (str_contains($n, 'sev khamani')) {
            return 'images/dishes/sev-khamani.jpg';
        }
        if (str_contains($n, 'live dhokla') || str_contains($n, 'white dhokla') || str_contains($n, 'khatta dhokla')) {
            return 'images/dishes/live-dhokla.jpg';
        }
        if (str_contains($n, 'locho')) {
            return 'images/dishes/surti-locho.jpg';
        }
        if (str_contains($n, 'khaman') || str_contains($n, 'dhokla')) {
            return 'images/dishes/khaman-dhokla.jpg';
        }
        if (str_contains($n, 'idli')) {
            return 'images/dishes/idli-sambar.jpg';
        }
        if (str_contains($n, 'platter') || str_contains($n, 'farsan') || str_contains($n, 'snacks')) {
            return 'images/dishes/snacks-platter.jpg';
        }

        // 8. Sev Usal & Pav Bhaji
        if (str_contains($n, 'poha')) {
            return 'images/dishes/indori-poha.jpg';
        }
        if (str_contains($n, 'sev usal') || str_contains($n, 'samosa usal') || str_contains($n, 'tari') || str_contains($n, 'usal')) {
            return 'images/dishes/sev-usal.jpg';
        }
        if (str_contains($n, 'pulav') || str_contains($n, 'tawa pulao') || str_contains($n, 'tawa pulav')) {
            return 'images/dishes/tawa-pulao.jpg';
        }
        if (str_contains($n, 'pav bhaji') || str_contains($n, 'masala pav')) {
            return 'images/dishes/pav-bhaji.jpg';
        }
        if (str_contains($n, 'extra pav') || str_contains($n, 'pav')) {
            return 'images/dishes/extra-pav.jpg';
        }

        // 9. Indian Breads
        if (str_contains($n, 'naan')) {
            return 'images/dishes/garlic-naan.jpg';
        }
        if (str_contains($n, 'roti') || str_contains($n, 'chapati') || str_contains($n, 'paratha') || str_contains($c, 'bread')) {
            return 'images/dishes/tandoori-roti.jpg';
        }

        // 10. Rice & Biryani
        if (str_contains($n, 'biryani')) {
            return 'images/dishes/veg-biryani.jpg';
        }
        if (str_contains($n, 'khichdi')) {
            return 'images/dishes/khichdi.jpg';
        }
        if (str_contains($n, 'pulao') || str_contains($n, 'pulav')) {
            return 'images/dishes/veg-pulao.jpg';
        }
        if (str_contains($n, 'jeera rice') || str_contains($n, 'rice') || str_contains($c, 'rice')) {
            return 'images/dishes/plain-rice.jpg';
        }

        // 11. Dal & Kadhi
        if (str_contains($n, 'kadhi')) {
            return 'images/dishes/gujarati-kadhi.jpg';
        }
        if (str_contains($n, 'gujarati dal')) {
            return 'images/dishes/gujarati-dal.jpg';
        }
        if (str_contains($n, 'dal tadka') || str_contains($n, 'dal fry') || str_contains($n, 'dal') || str_contains($c, 'dal')) {
            return 'images/dishes/dal-tadka.jpg';
        }

        // 12. Punjabi Specialities
        if (str_contains($n, 'paneer tikka')) {
            return 'images/dishes/paneer-tikka-masala.jpg';
        }
        if (str_contains($n, 'paneer butter') || str_contains($n, 'cheese butter masala')) {
            return 'images/dishes/paneer-butter-masala.jpg';
        }
        if (str_contains($n, 'paneer bhurji') || str_contains($n, 'gotado') || str_contains($n, 'paneer angarey') || str_contains($n, 'paneer')) {
            return 'images/dishes/paneer-bhurji.jpg';
        }

        // 13. Kaju Specialities
        if (str_contains($n, 'kaju gathiya') || str_contains($n, 'kaju lasan gathiya')) {
            return 'images/dishes/kaju-gathiya.jpg';
        }
        if (str_contains($n, 'kaju') || str_contains($c, 'kaju')) {
            return 'images/dishes/kaju-curry.jpg';
        }

        // 14. Kathiyawadi Specialities
        if (str_contains($n, 'sev tameta') || str_contains($n, 'sev bhaji') || str_contains($n, 'sev lasan') || str_contains($n, 'papad ni sabji')) {
            return 'images/dishes/sev-tameta.jpg';
        }
        if (str_contains($n, 'dahi tikhari')) {
            return 'images/dishes/dahi-tikhari.jpg';
        }
        if (str_contains($n, 'lasaniya bateta') || str_contains($n, 'batata') || str_contains($n, 'bateta')) {
            return 'images/dishes/lasaniya-bateta.jpg';
        }
        if (str_contains($n, 'gathiya') || str_contains($n, 'makhani methi') || str_contains($c, 'kathiyawadi')) {
            return 'images/dishes/sev-gathiya-special.jpg';
        }

        // 15. South Indian
        if (str_contains($n, 'uttapam')) {
            return 'images/dishes/uttapam.jpg';
        }
        if (str_contains($n, 'plain dosa') || str_contains($n, 'plain cheese dosa')) {
            return 'images/dishes/plain-dosa.jpg';
        }
        if (str_contains($n, 'dosa') || str_contains($c, 'south-indian')) {
            return 'images/dishes/masala-dosa.jpg';
        }

        // 16. Indo-Chinese
        if (str_contains($n, 'manchurian')) {
            return 'images/dishes/veg-manchurian.jpg';
        }
        if (str_contains($n, 'chinese bhel')) {
            return 'images/dishes/chinese-bhel.jpg';
        }
        if (str_contains($n, 'schezwan rice') || str_contains($n, 'fried rice') || (str_contains($c, 'chinese') && str_contains($n, 'rice'))) {
            return 'images/dishes/schezwan-rice.jpg';
        }
        if (str_contains($n, 'schezwan noodles') || str_contains($n, 'crispy noodles')) {
            return 'images/dishes/schezwan-noodles.jpg';
        }
        if (str_contains($n, 'noodle') || str_contains($c, 'indo-chinese') || str_contains($c, 'chinese')) {
            return 'images/dishes/hakka-noodles.jpg';
        }

        return 'images/dishes/snacks-platter.jpg';
    }

    /**
     * Scope a query to only include available items.
     */
    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('is_available', true);
    }

    /**
     * Scope a query to only include featured items.
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to only include popular items.
     */
    public function scopePopular(Builder $query): Builder
    {
        return $query->where('is_popular', true);
    }

    /**
     * Scope a query to order items by sort_order.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('name', 'asc');
    }
}
