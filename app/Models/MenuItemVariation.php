<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItemVariation extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu_item_variations';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'menu_item_id',
        'name',
        'price', // Stored in pence
        'is_active',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'integer',
        'is_active' => 'boolean',
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
     * Menu item this variation belongs to.
     */
    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id');
    }

    /**
     * Formatted price attribute (e.g., £14.95).
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
     * Price in decimal pounds (e.g., 14.95).
     */
    protected function priceInPounds(): Attribute
    {
        return Attribute::make(
            get: fn () => round($this->price / 100, 2),
            set: fn ($value) => (int) round((float) $value * 100)
        );
    }

    /**
     * Scope a query to only include active variations.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
