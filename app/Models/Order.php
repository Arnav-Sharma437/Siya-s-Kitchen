<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'order_type',
        'table_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'special_instructions',
        'subtotal_pence',
        'vat_pence',
        'total_pence',
        'currency',
        'status',
        'payment_status',
        'payment_driver',
        'teya_session_id',
        'teya_payment_link_id',
        'teya_transaction_id',
        'teya_auth_code',
        'paid_at',
    ];

    protected $casts = [
        'subtotal_pence' => 'integer',
        'vat_pence' => 'integer',
        'total_pence' => 'integer',
        'paid_at' => 'datetime',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedTotalAttribute(): string
    {
        return '£' . number_format($this->total_pence / 100, 2);
    }

    public function getFormattedSubtotalAttribute(): string
    {
        return '£' . number_format($this->subtotal_pence / 100, 2);
    }

    public function markAsPaid(?string $transactionId = null, ?string $authCode = null): void
    {
        $this->update([
            'status' => 'paid',
            'payment_status' => 'paid',
            'teya_transaction_id' => $transactionId ?: $this->teya_transaction_id,
            'teya_auth_code' => $authCode ?: $this->teya_auth_code,
            'paid_at' => now(),
        ]);
    }

    public function markAsFailed(): void
    {
        if ($this->status !== 'paid') {
            $this->update([
                'status' => 'failed',
                'payment_status' => 'failed',
            ]);
        }
    }

    public function markAsCancelled(): void
    {
        if ($this->status !== 'paid') {
            $this->update([
                'status' => 'cancelled',
                'payment_status' => 'cancelled',
            ]);
        }
    }
}
