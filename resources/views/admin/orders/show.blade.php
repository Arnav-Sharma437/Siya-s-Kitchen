@extends('layouts.admin')

@section('title', 'Order ' . $order->order_number . ' - Siya\'s Kitchen')
@section('page_title', 'Order Details & Management')

@section('content')

<div style="margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
    <div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">&larr; Back to Live Orders</a>
    </div>

    <div style="display: flex; gap: 0.5rem;">
        <a href="{{ route('admin.orders.receipt', $order) }}" target="_blank" class="btn btn-primary btn-sm">
            🖨️ Print Kitchen Docket / Receipt
        </a>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
    <!-- Left Column: Order Items & Breakdown -->
    <div>
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="card-title">Order Items ({{ $order->items->sum('quantity') }})</h2>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">Ref: {{ $order->order_number }} &bull; Placed {{ $order->created_at->format('d M Y, H:i') }}</div>
                </div>

                <span class="badge badge-{{ $order->status }}" style="font-size: 0.85rem; padding: 0.35rem 0.85rem;">
                    {{ strtoupper($order->status) }}
                </span>
            </div>

            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                <thead>
                    <tr style="border-bottom: 2px solid var(--border-color); color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase;">
                        <th style="padding: 0.75rem 0;">Item Description</th>
                        <th style="padding: 0.75rem 0; text-align: center;">Price</th>
                        <th style="padding: 0.75rem 0; text-align: center;">Qty</th>
                        <th style="padding: 0.75rem 0; text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td style="padding: 1rem 0;">
                                <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">{{ $item->item_name }}</div>
                                
                                @if($item->variation_name)
                                    <div style="font-size: 0.78rem; color: #64748b; margin-top: 0.2rem;">
                                        &bull; Variation: <strong>{{ $item->variation_name }}</strong>
                                    </div>
                                @endif

                                @if(!empty($item->addons_json))
                                    <div style="font-size: 0.78rem; color: #64748b; margin-top: 0.2rem;">
                                        &bull; Addons: 
                                        @foreach($item->addons_json as $addon)
                                            <span style="background: #f1f5f9; padding: 0.1rem 0.4rem; border-radius: 4px; font-weight: 600;">{{ $addon['name'] }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                @if($item->special_instructions)
                                    <div style="font-size: 0.78rem; background: #fef3c7; color: #92400e; padding: 0.3rem 0.6rem; border-radius: 4px; margin-top: 0.4rem; display: inline-block;">
                                        ⚠️ Kitchen Instructions: {{ $item->special_instructions }}
                                    </div>
                                @endif
                            </td>
                            <td style="padding: 1rem 0; text-align: center; color: var(--text-muted);">
                                {{ $item->formatted_unit_price }}
                            </td>
                            <td style="padding: 1rem 0; text-align: center; font-weight: 700;">
                                {{ $item->quantity }}
                            </td>
                            <td style="padding: 1rem 0; text-align: right; font-weight: 700; color: #0f172a;">
                                {{ $item->formatted_line_total }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Financial Totals -->
            <div style="margin-top: 1.5rem; padding-top: 1.25rem; border-top: 2px solid var(--border-color); display: flex; justify-content: flex-end;">
                <div style="width: 260px; display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.9rem;">
                    <div style="display: flex; justify-content: space-between; color: var(--text-muted);">
                        <span>Subtotal:</span>
                        <span>{{ $order->formatted_subtotal }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; color: var(--text-muted);">
                        <span>UK VAT (Included):</span>
                        <span>£{{ number_format($order->vat_pence / 100, 2) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 1.2rem; font-weight: 800; color: var(--primary); border-top: 1px solid var(--border-color); padding-top: 0.5rem;">
                        <span>Total Paid:</span>
                        <span>{{ $order->formatted_total }}</span>
                    </div>
                </div>
            </div>
        </div>

        @if($order->special_instructions)
            <div class="card" style="background: #fffbeb; border-color: #fde68a;">
                <h3 style="font-size: 0.95rem; font-weight: 700; color: #92400e; margin-bottom: 0.4rem;">Customer Delivery / Cooking Notes</h3>
                <p style="font-size: 0.88rem; color: #78350f;">{{ $order->special_instructions }}</p>
            </div>
        @endif
    </div>

    <!-- Right Column: Status Control, Customer & Teya Info -->
    <div>
        <!-- Update Status Card -->
        <div class="card">
            <h2 class="card-title" style="margin-bottom: 1rem;">Kitchen Status Control</h2>
            
            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                @csrf
                @method('PATCH')

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; font-size: 0.8rem; font-weight: 700; color: var(--text-muted); margin-bottom: 0.4rem;">
                        Current State:
                    </label>
                    <select name="status" style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.95rem; font-weight: 600; background: #fff;">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid (Received)</option>
                        <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>In Kitchen (Preparing)</option>
                        <option value="ready" {{ $order->status === 'ready' ? 'selected' : '' }}>Ready for Table / Service</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed & Served</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled / Void</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    Update Order Status
                </button>
            </form>
        </div>

        <!-- Service & Customer Card -->
        <div class="card">
            <h2 class="card-title" style="margin-bottom: 1rem;">Service & Guest Details</h2>
            
            <div style="display: flex; flex-direction: column; gap: 0.85rem; font-size: 0.88rem;">
                <div>
                    <span style="display: block; font-size: 0.72rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted);">Service Type:</span>
                    @if($order->order_type === 'dine_in')
                        <strong style="color: #0284c7; font-size: 1.1rem;">DINE-IN (TABLE #{{ $order->table_number ?? '1' }})</strong>
                    @else
                        <strong style="color: var(--primary); font-size: 1.1rem;">TAKEAWAY / PICKUP</strong>
                    @endif
                </div>

                <div>
                    <span style="display: block; font-size: 0.72rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted);">Customer Name:</span>
                    <strong>{{ $order->customer_name ?: 'Guest Customer' }}</strong>
                </div>

                @if($order->customer_phone)
                    <div>
                        <span style="display: block; font-size: 0.72rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted);">Phone Number:</span>
                        <a href="tel:{{ $order->customer_phone }}" style="color: var(--primary); font-weight: 600; text-decoration: none;">
                            📞 {{ $order->customer_phone }}
                        </a>
                    </div>
                @endif

                @if($order->customer_email)
                    <div>
                        <span style="display: block; font-size: 0.72rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted);">Email:</span>
                        <a href="mailto:{{ $order->customer_email }}" style="color: var(--text-dark); text-decoration: none;">
                            ✉️ {{ $order->customer_email }}
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Teya Payment Details -->
        <div class="card">
            <h2 class="card-title" style="margin-bottom: 1rem;">Teya Hosted Checkout</h2>
            
            <div style="display: flex; flex-direction: column; gap: 0.75rem; font-size: 0.82rem;">
                <div>
                    <span style="color: var(--text-muted);">Payment Status:</span>
                    <strong style="color: {{ $order->payment_status === 'paid' ? 'var(--success)' : 'inherit' }}; text-transform: uppercase;">
                        {{ $order->payment_status }}
                    </strong>
                </div>

                @if($order->teya_transaction_id)
                    <div>
                        <span style="color: var(--text-muted);">Teya Transaction ID:</span>
                        <code style="display: block; background: #f1f5f9; padding: 0.2rem 0.4rem; border-radius: 4px; font-size: 0.75rem; margin-top: 0.2rem;">
                            {{ $order->teya_transaction_id }}
                        </code>
                    </div>
                @endif

                @if($order->teya_session_id)
                    <div>
                        <span style="color: var(--text-muted);">Checkout Session ID:</span>
                        <code style="display: block; background: #f1f5f9; padding: 0.2rem 0.4rem; border-radius: 4px; font-size: 0.75rem; margin-top: 0.2rem; word-break: break-all;">
                            {{ $order->teya_session_id }}
                        </code>
                    </div>
                @endif

                @if($order->paid_at)
                    <div>
                        <span style="color: var(--text-muted);">Settlement Timestamp:</span>
                        <div>{{ $order->paid_at->format('d M Y, H:i:s') }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
