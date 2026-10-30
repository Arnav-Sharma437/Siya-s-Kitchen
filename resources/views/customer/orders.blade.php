@extends('layouts.app')

@section('title', "My Orders & History - Siya's Kitchen")

@section('content')
<section class="section-padding" style="padding-top: 110px; padding-bottom: 90px; min-height: 80vh; background: #faf9f6;">
    <div class="container" style="max-width: 780px; margin: 0 auto; padding: 0 1.25rem;">
        
        <!-- Header & Breadcrumbs -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <span style="display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--primary-terracotta, #c2410c); background: rgba(194, 65, 12, 0.08); padding: 5px 14px; border-radius: 9999px; margin-bottom: 0.85rem;">
                <span>📋</span> Guest Orders & Receipts
            </span>
            <h1 style="font-family: var(--font-heading, 'Fraunces', serif); font-size: clamp(1.8rem, 4vw, 2.5rem); color: #1e293b; margin-bottom: 0.5rem; font-weight: 700;">
                Your Order History
            </h1>
            <p style="color: #64748b; font-size: 1rem; max-width: 540px; margin: 0 auto;">
                Quickly access your past Dine-In & Takeaway orders, view live preparation status, and download digital receipts.
            </p>
        </div>

        <!-- Phone Lookup Card -->
        <div style="background: #ffffff; border-radius: 18px; padding: 1.75rem 2rem; box-shadow: 0 4px 25px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.07); margin-bottom: 2rem;">
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1rem;">
                <label for="customerPhoneSearchInput" style="font-weight: 700; font-size: 0.95rem; color: #1e293b; display: flex; align-items: center; gap: 0.4rem;">
                    <span>📱</span> Enter Your Mobile Number or Order Reference:
                </label>
                <span style="font-size: 0.78rem; font-weight: 600; color: #16a34a; background: #f0fdf4; padding: 3px 8px; border-radius: 6px; border: 1px solid #bbf7d0;">
                    ✓ No Password Required
                </span>
            </div>

            <form action="{{ route('orders.track.lookup') }}" method="POST" id="phoneLookupForm" style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                @csrf
                <div style="flex: 1; min-width: 240px; position: relative;">
                    <input type="text" name="phone" id="customerPhoneSearchInput" 
                           placeholder="e.g. 07123 456789 or SK-261029-XXXX" 
                           value="{{ $searchedPhone }}" 
                           required
                           style="width: 100%; padding: 0.85rem 1rem; border: 1.5px solid #cbd5e1; border-radius: 12px; font-size: 1rem; font-weight: 500; outline: none; transition: border-color 0.2s;"
                           onfocus="this.style.borderColor='var(--primary-terracotta, #c2410c)'"
                           onblur="this.style.borderColor='#cbd5e1'">
                </div>

                <button type="submit" class="btn btn-primary" style="padding: 0.85rem 1.75rem; border-radius: 12px; font-weight: 700; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <span>Find My Orders</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </button>
            </form>

            @if($searched && !empty($searchedPhone))
                <div style="margin-top: 1rem; padding-top: 0.85rem; border-top: 1px dashed #e2e8f0; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem; font-size: 0.85rem;">
                    <span style="color: #64748b;">
                        Showing orders for: <strong style="color: #0f172a;">{{ $searchedPhone }}</strong>
                    </span>
                    <a href="{{ route('orders.track.clear') }}" style="color: #ef4444; font-weight: 600; text-decoration: none; font-size: 0.82rem;">
                        ✕ Clear & Search Another Number
                    </a>
                </div>
            @endif
        </div>

        <!-- Orders Results Section -->
        @if($searched)
            @if($orders->isEmpty())
                <!-- Empty State -->
                <div style="background: #ffffff; border-radius: 18px; padding: 3.5rem 2rem; text-align: center; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
                    <div style="font-size: 3rem; margin-bottom: 0.75rem;">🔍</div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #1e293b; margin-bottom: 0.4rem;">No Orders Found</h3>
                    <p style="color: #64748b; font-size: 0.92rem; max-width: 460px; margin: 0 auto 1.5rem;">
                        We couldn't find any confirmed orders matching <strong>"{{ $searchedPhone }}"</strong>. If you recently placed an order, please check if your phone number matches what was entered at checkout, or try searching by your Order Reference (e.g. <code>SK-261029-XXXX</code>).
                    </p>
                    <a href="{{ route('menu') }}" class="btn btn-secondary btn-sm">Browse Digital Menu</a>
                </div>
            @else
                <!-- Orders List -->
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @foreach($orders as $order)
                        <div style="background: #ffffff; border-radius: 18px; border: 1px solid rgba(0,0,0,0.07); box-shadow: 0 4px 20px rgba(0,0,0,0.04); overflow: hidden; transition: transform 0.15s ease;">
                            
                            <!-- Card Header -->
                            <div style="padding: 1.25rem 1.5rem; background: #fafafa; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                                <div>
                                    <div style="display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap;">
                                        <span style="font-weight: 800; font-family: monospace; font-size: 1.05rem; color: #0f172a;">
                                            #{{ $order->order_number }}
                                        </span>
                                        @if($order->order_type === 'dine_in')
                                            <span style="background: #e0f2fe; color: #0369a1; font-size: 0.75rem; font-weight: 700; padding: 2px 8px; border-radius: 9999px;">
                                                🍽️ Dine-In (Table #{{ $order->table_number ?? '1' }})
                                            </span>
                                        @else
                                            <span style="background: #fef3c7; color: #b45309; font-size: 0.75rem; font-weight: 700; padding: 2px 8px; border-radius: 9999px;">
                                                🥡 Takeaway Pack
                                            </span>
                                        @endif
                                    </div>
                                    <div style="font-size: 0.78rem; color: #64748b; margin-top: 0.25rem;">
                                        Placed {{ $order->created_at->format('D, d M Y \a\t H:i') }}
                                    </div>
                                </div>

                                <div style="text-align: right;">
                                    @if($order->status === 'paid')
                                        <span style="background: #dcfce7; color: #15803d; font-size: 0.78rem; font-weight: 700; padding: 4px 10px; border-radius: 9999px; display: inline-flex; align-items: center; gap: 0.35rem;">
                                            <span style="width: 7px; height: 7px; background: #22c55e; border-radius: 50%;"></span>
                                            Order Confirmed (Kitchen Received)
                                        </span>
                                    @elseif($order->status === 'preparing')
                                        <span style="background: #fef3c7; color: #b45309; font-size: 0.78rem; font-weight: 700; padding: 4px 10px; border-radius: 9999px; display: inline-flex; align-items: center; gap: 0.35rem;">
                                            <span>🍳</span> In Kitchen (Preparing)
                                        </span>
                                    @elseif($order->status === 'ready')
                                        <span style="background: #e0e7ff; color: #4338ca; font-size: 0.78rem; font-weight: 700; padding: 4px 10px; border-radius: 9999px; display: inline-flex; align-items: center; gap: 0.35rem;">
                                            <span>🔔</span> Ready for Service / Pickup
                                        </span>
                                    @elseif($order->status === 'completed')
                                        <span style="background: #f1f5f9; color: #475569; font-size: 0.78rem; font-weight: 700; padding: 4px 10px; border-radius: 9999px;">
                                            ✓ Served & Completed
                                        </span>
                                    @else
                                        <span style="background: #f1f5f9; color: #475569; font-size: 0.78rem; font-weight: 700; padding: 4px 10px; border-radius: 9999px;">
                                            {{ strtoupper($order->status) }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Ordered Dishes Items -->
                            <div style="padding: 1.25rem 1.5rem;">
                                <ul style="list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 0.65rem;">
                                    @foreach($order->items as $item)
                                        <li style="display: flex; justify-content: space-between; align-items: flex-start; font-size: 0.92rem; padding-bottom: 0.5rem; border-bottom: 1px dashed #f1f5f9;">
                                            <div>
                                                <span style="font-weight: 700; color: #0f172a;">
                                                    <span style="display: inline-block; width: 22px; height: 22px; line-height: 22px; text-align: center; background: #f1f5f9; border-radius: 4px; font-size: 0.8rem; margin-right: 0.35rem;">{{ $item->quantity }}x</span>
                                                    {{ $item->item_name }}
                                                </span>
                                                @if($item->variation_name)
                                                    <div style="font-size: 0.8rem; color: #64748b; margin-left: 1.8rem;">
                                                        Portion: {{ $item->variation_name }}
                                                    </div>
                                                @endif
                                                @if(!empty($item->addons_json))
                                                    <div style="font-size: 0.78rem; color: #64748b; margin-left: 1.8rem;">
                                                        Extras: {{ implode(', ', array_column($item->addons_json, 'name')) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <span style="font-weight: 600; color: #0f172a; font-size: 0.9rem;">
                                                {{ $item->formatted_line_total }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>

                                <!-- Card Footer Totals & CTA -->
                                <div style="margin-top: 1rem; padding-top: 0.85rem; border-top: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                                    <div>
                                        <span style="font-size: 0.8rem; color: #64748b; display: block;">Total Paid (VAT incl.)</span>
                                        <span style="font-size: 1.35rem; font-weight: 800; color: var(--primary-terracotta, #c2410c);">
                                            {{ $order->formatted_total }}
                                        </span>
                                    </div>

                                    <div style="display: flex; gap: 0.6rem; align-items: center;">
                                        <a href="{{ route('checkout.success', ['order' => $order->order_number]) }}" 
                                           class="btn btn-secondary btn-sm" 
                                           style="padding: 0.5rem 1rem; border-radius: 8px; font-weight: 600; font-size: 0.85rem;">
                                            🖨️ View Receipt
                                        </a>
                                        <a href="{{ route('menu') }}" 
                                           class="btn btn-primary btn-sm" 
                                           style="padding: 0.5rem 1rem; border-radius: 8px; font-weight: 600; font-size: 0.85rem;">
                                            Order More
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif
        @else
            <!-- Initial Welcome Guide -->
            <div style="background: #ffffff; border-radius: 18px; padding: 2.5rem 2rem; border: 1px solid rgba(0,0,0,0.06); text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div style="width: 56px; height: 56px; background: rgba(194, 65, 12, 0.08); color: var(--primary-terracotta, #c2410c); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; font-size: 1.6rem;">
                    📲
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #1e293b; margin-bottom: 0.4rem;">
                    Instant Order Lookup
                </h3>
                <p style="color: #64748b; font-size: 0.92rem; max-width: 480px; margin: 0 auto 1.5rem;">
                    Enter the mobile phone number you used during checkout to view your orders, live food status, and itemized VAT receipts.
                </p>
                <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                    <a href="{{ route('menu') }}" class="btn btn-primary btn-sm">Explore Menu & Order Now</a>
                </div>
            </div>
        @endif

    </div>
</section>

@push('scripts')
<script>
    // Remember customer's mobile number in localStorage for zero-typing lookup
    document.addEventListener('DOMContentLoaded', () => {
        const phoneInput = document.getElementById('customerPhoneSearchInput');
        const storedPhone = localStorage.getItem('siyas_customer_phone');

        // If field is empty and we have a stored phone, populate and auto-search
        if (phoneInput && !phoneInput.value && storedPhone) {
            phoneInput.value = storedPhone;
            @if(!$searched)
                document.getElementById('phoneLookupForm').submit();
            @endif
        }

        // On form submit, save phone to localStorage
        const form = document.getElementById('phoneLookupForm');
        if (form && phoneInput) {
            form.addEventListener('submit', () => {
                const val = phoneInput.value.trim();
                if (val && !val.startsWith('SK-')) {
                    localStorage.setItem('siyas_customer_phone', val);
                }
            });
        }
    });
</script>
@endpush
@endsection
