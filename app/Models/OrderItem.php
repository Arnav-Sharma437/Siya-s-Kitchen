<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_item_id',
        'item_name',
        'variation_name',
        'variation_price_pence',
        'addons_json',
        'special_instructions',
        'unit_price_pence',
        'quantity',
        'line_total_pence',
    ];

    protected $casts = [
        'variation_price_pence' => 'integer',
        'addons_json' => 'array',
        'unit_price_pence' => 'integer',
        'quantity' => 'integer',
        'line_total_pence' => 'integer',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function getFormattedUnitPriceAttribute(): string
    {
        return '£' . number_format($this->unit_price_pence / 100, 2);
    }

    public function getFormattedLineTotalAttribute(): string
    {
        return '£' . number_format($this->line_total_pence / 100, 2);
    }
}
