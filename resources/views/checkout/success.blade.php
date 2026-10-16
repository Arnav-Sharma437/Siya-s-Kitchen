@extends('layouts.app')

@section('title', "Order Confirmed #{$order->order_number} | Siya's Kitchen")

@section('content')
<section class="section-padding" style="padding-top: 100px; padding-bottom: 80px; min-height: 70vh;">
    <div class="container" style="max-width: 680px; margin: 0 auto; padding: 0 1rem;">
        <div style="background: var(--bg-card, #ffffff); border-radius: 16px; padding: 2.5rem 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.08); text-align: center;">
            
            <!-- Success Icon -->
            <div style="width: 72px; height: 72px; background: rgba(34, 197, 94, 0.12); color: #16a34a; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 6L9 17l-5-5"/>
                </svg>
            </div>

            <span style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--primary-terracotta, #c2410c); background: rgba(194, 65, 12, 0.08); padding: 4px 12px; border-radius: 9999px;">
                @if($order->payment_status === 'paid')
                    Payment Confirmed (Teya)
                @else
                    Order Received
                @endif
            </span>

            <h1 style="font-family: var(--font-heading, 'Fraunces', serif); font-size: 2.2rem; margin: 1rem 0 0.5rem; color: var(--text-primary, #1e293b);">
                Thank You For Your Order!
            </h1>
            <p style="color: var(--text-secondary, #64748b); font-size: 1.05rem; margin-bottom: 2rem;">
                Your order has been transmitted directly to our kitchen. We are preparing your dishes fresh.
            </p>

            <!-- Order Key Details Card -->
            <div style="background: #f8fafc; border-radius: 12px; padding: 1.25rem 1.5rem; text-align: left; margin-bottom: 2rem; border: 1px solid #e2e8f0;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem; border-bottom: 1px dashed #cbd5e1; padding-bottom: 0.75rem;">
                    <span style="color: #64748b; font-size: 0.95rem;">Order Number</span>
                    <span style="font-weight: 700; font-family: monospace; font-size: 1.1rem; color: #0f172a;">{{ $order->order_number }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                    <span style="color: #64748b; font-size: 0.95rem;">Service Type</span>
                    <span style="font-weight: 600; text-transform: capitalize; color: #0f172a;">
                        {{ str_replace('_', ' ', $order->order_type) }}
                        @if($order->table_number)
                            (Table #{{ $order->table_number }})
                        @endif
                    </span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                    <span style="color: #64748b; font-size: 0.95rem;">Payment Method</span>
                    <span style="font-weight: 600; color: #0f172a;">Teya Hosted Checkout</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #64748b; font-size: 0.95rem;">Payment Status</span>
                    <span style="font-weight: 700; color: {{ $order->payment_status === 'paid' ? '#16a34a' : '#ea580c' }}; text-transform: uppercase; font-size: 0.88rem;">
                        {{ $order->payment_status }}
                    </span>
                </div>
            </div>

            <!-- Ordered Items List -->
            <div style="text-align: left; margin-bottom: 2rem;">
                <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem; color: #0f172a;">Order Summary</h3>
                <div style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                    @foreach($order->items as $item)
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; padding: 0.85rem 1.25rem; border-bottom: 1px solid #f1f5f9; background: #ffffff;">
                            <div>
                                <div style="font-weight: 600; color: #1e293b;">
                                    {{ $item->quantity }}x {{ $item->item_name }}
                                </div>
                                @if($item->variation_name)
                                    <div style="font-size: 0.85rem; color: #64748b;">Portion: {{ $item->variation_name }}</div>
                                @endif
                                @if(!empty($item->addons_json))
                                    <div style="font-size: 0.82rem; color: #64748b;">
                                        Extras: {{ implode(', ', array_column($item->addons_json, 'name')) }}
                                    </div>
                                @endif
                                @if($item->special_instructions)
                                    <div style="font-size: 0.82rem; color: #94a3b8; font-style: italic;">Note: "{{ $item->special_instructions }}"</div>
                                @endif
                            </div>
                            <span style="font-weight: 600; color: #0f172a;">{{ $item->formatted_line_total }}</span>
                        </div>
                    @endforeach

                    <!-- Totals summary -->
                    <div style="background: #f8fafc; padding: 1rem 1.25rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.35rem; color: #64748b; font-size: 0.9rem;">
                            <span>Subtotal</span>
                            <span>{{ $order->formatted_subtotal }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; color: #94a3b8; font-size: 0.82rem;">
                            <span>VAT (Included)</span>
                            <span>£{{ number_format($order->vat_pence / 100, 2) }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-weight: 700; font-size: 1.15rem; color: #0f172a; border-top: 1px solid #e2e8f0; padding-top: 0.5rem;">
                            <span>Total Paid</span>
                            <span style="color: var(--primary-terracotta, #c2410c);">{{ $order->formatted_total }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('menu') }}" class="btn btn-primary" style="padding: 12px 28px;">
                    Order More Dishes
                </a>
                <a href="{{ route('home') }}" class="btn btn-secondary" style="padding: 12px 28px;">
                    Back to Home
                </a>
            </div>

        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Clear the cart from localStorage since order is complete
    try {
        localStorage.removeItem('siyas_kitchen_cart_v1');
        localStorage.removeItem('siyas_kitchen_cart_settings');
        // Update live cart UI badges if main.js functions are active
        const countElements = document.querySelectorAll('.global-cart-count');
        countElements.forEach(el => el.textContent = '0');
    } catch (e) {
        console.error('Could not clear local cart storage:', e);
    }
</script>
@endpush
