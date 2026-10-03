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
     * Scope a query to order items by sort_order.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('name', 'asc');
    }
}
