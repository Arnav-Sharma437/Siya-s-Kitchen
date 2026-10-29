@extends('layouts.admin')

@section('title', 'Analytics & Operations Dashboard')
@section('page_title', 'Analytics & Restaurant Dashboard')

@section('content')

<!-- KPI Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 1.25rem; margin-bottom: 2rem;">
    <!-- Total Revenue -->
    <div class="card" style="margin-bottom: 0; border-left: 4px solid var(--primary);">
        <div style="font-size: 0.78rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted); margin-bottom: 0.4rem;">Total Revenue (Paid)</div>
        <div style="font-size: 1.85rem; font-weight: 800; color: var(--primary);">£{{ number_format($totalRevenuePence / 100, 2) }}</div>
        <div style="font-size: 0.75rem; color: var(--success); margin-top: 0.4rem; font-weight: 600;">&bull; Direct to Teya Merchant Account</div>
    </div>

    <!-- Today's Revenue -->
    <div class="card" style="margin-bottom: 0; border-left: 4px solid var(--success);">
        <div style="font-size: 0.78rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted); margin-bottom: 0.4rem;">Today's Revenue</div>
        <div style="font-size: 1.85rem; font-weight: 800; color: #0f172a;">£{{ number_format($todayRevenuePence / 100, 2) }}</div>
        <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.4rem;">{{ $todayOrdersCount }} order(s) placed today</div>
    </div>

    <!-- Active Kitchen Orders -->
    <div class="card" style="margin-bottom: 0; border-left: 4px solid var(--warning);">
        <div style="font-size: 0.78rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted); margin-bottom: 0.4rem;">Active in Kitchen</div>
        <div style="font-size: 1.85rem; font-weight: 800; color: var(--warning);">{{ $activeKitchenCount }}</div>
        <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.4rem;">Orders requiring preparation</div>
    </div>

    <!-- Total Orders -->
    <div class="card" style="margin-bottom: 0; border-left: 4px solid var(--info);">
        <div style="font-size: 0.78rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted); margin-bottom: 0.4rem;">Total Orders</div>
        <div style="font-size: 1.85rem; font-weight: 800; color: #0f172a;">{{ $totalOrdersCount }}</div>
        <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.4rem;">{{ $dineInCount }} Dine-In &bull; {{ $takeawayCount }} Takeaway</div>
    </div>

    <!-- Average Order Value -->
    <div class="card" style="margin-bottom: 0; border-left: 4px solid #8b5cf6;">
        <div style="font-size: 0.78rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted); margin-bottom: 0.4rem;">Avg. Order Value</div>
        <div style="font-size: 1.85rem; font-weight: 800; color: #0f172a;">£{{ number_format($avgOrderValuePence / 100, 2) }}</div>
        <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.4rem;">Across paid transactions</div>
    </div>
</div>

<!-- Charts Section -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Revenue Trend Chart -->
    <div class="card" style="margin-bottom: 0;">
        <div class="card-header">
            <div>
                <h2 class="card-title">7-Day Revenue Trend</h2>
                <div style="font-size: 0.75rem; color: var(--text-muted);">Daily gross sales settled via Teya</div>
            </div>
            <span class="badge" style="background: var(--primary-light); color: var(--primary);">Last 7 Days</span>
        </div>
        <div style="height: 260px; position: relative;">
            <canvas id="revenueTrendChart"></canvas>
        </div>
    </div>

    <!-- Order Types / Status Distribution Chart -->
    <div class="card" style="margin-bottom: 0;">
        <div class="card-header">
            <div>
                <h2 class="card-title">Service Type Ratio</h2>
                <div style="font-size: 0.75rem; color: var(--text-muted);">Dine-in vs takeaway orders</div>
            </div>
        </div>
        <div style="height: 260px; position: relative; display: flex; align-items: center; justify-content: center;">
            <canvas id="orderTypeChart"></canvas>
        </div>
    </div>
</div>

<!-- Middle Section: Top Dishes & Quick System Status -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Top Selling Dishes -->
    <div class="card" style="margin-bottom: 0;">
        <div class="card-header">
            <h2 class="card-title">Top Selling Dishes</h2>
            <a href="{{ route('admin.menu-items.index') }}" class="btn btn-secondary btn-sm">Manage Menu &rarr;</a>
        </div>
        @if($topDishes->isEmpty())
            <div style="padding: 2rem 0; text-align: center; color: var(--text-muted); font-size: 0.88rem;">
                No order item analytics recorded yet.
            </div>
        @else
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                @foreach($topDishes as $index => $dish)
                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.65rem 0.75rem; background: #f8fafc; border-radius: var(--radius-sm); border: 1px solid var(--border-color);">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <span style="width: 26px; height: 26px; border-radius: 50%; background: {{ $index === 0 ? 'var(--primary)' : '#e2e8f0' }}; color: {{ $index === 0 ? '#fff' : '#475569' }}; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.78rem;">
                                {{ $index + 1 }}
                            </span>
                            <span style="font-weight: 600; font-size: 0.9rem;">{{ $dish->item_name }}</span>
                        </div>
                        <div style="text-align: right;">
                            <div style="font-weight: 700; font-size: 0.88rem; color: var(--primary);">£{{ number_format($dish->total_revenue_pence / 100, 2) }}</div>
                            <div style="font-size: 0.72rem; color: var(--text-muted);">{{ $dish->total_qty }} ordered</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Quick Operations & Catalog Health -->
    <div class="card" style="margin-bottom: 0;">
        <div class="card-header">
            <h2 class="card-title">Operations & Catalog Health</h2>
            <a href="{{ route('admin.settings') }}" class="btn btn-secondary btn-sm">Settings &bull; Teya</a>
        </div>
        
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <!-- Teya Gateway Box -->
            <div style="padding: 1rem; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <div style="font-weight: 700; font-size: 0.88rem; color: #166534; display: flex; align-items: center; gap: 0.4rem;">
                        <span style="width: 8px; height: 8px; background: #22c55e; border-radius: 50%; display: inline-block;"></span>
                        Teya Production Gateway
                    </div>
                    <div style="font-size: 0.75rem; color: #15803d; margin-top: 0.2rem;">Live settlements active directly to Siya's Kitchen</div>
                </div>
                <span class="badge" style="background: #22c55e; color: #fff;">ACTIVE</span>
            </div>

            <!-- Menu Summary Stats -->
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 0.75rem;">
                <div style="padding: 0.75rem; background: #f8fafc; border: 1px solid var(--border-color); border-radius: var(--radius-sm); text-align: center;">
                    <div style="font-size: 1.25rem; font-weight: 800; color: #0f172a;">{{ $menuItemsCount }}</div>
                    <div style="font-size: 0.72rem; color: var(--text-muted); font-weight: 600;">Total Dishes</div>
                </div>

                <div style="padding: 0.75rem; background: #f8fafc; border: 1px solid var(--border-color); border-radius: var(--radius-sm); text-align: center;">
                    <div style="font-size: 1.25rem; font-weight: 800; color: #0f172a;">{{ $categoriesCount }}</div>
                    <div style="font-size: 0.72rem; color: var(--text-muted); font-weight: 600;">Categories</div>
                </div>

                <div style="padding: 0.75rem; background: {{ $outOfStockCount > 0 ? '#fef2f2' : '#f8fafc' }}; border: 1px solid {{ $outOfStockCount > 0 ? '#fecaca' : 'var(--border-color)' }}; border-radius: var(--radius-sm); text-align: center;">
                    <div style="font-size: 1.25rem; font-weight: 800; color: {{ $outOfStockCount > 0 ? 'var(--danger)' : '#0f172a' }};">{{ $outOfStockCount }}</div>
                    <div style="font-size: 0.72rem; color: var(--text-muted); font-weight: 600;">Out of Stock</div>
                </div>
            </div>

            <div style="display: flex; gap: 0.75rem; margin-top: 0.5rem;">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary" style="flex: 1; text-align: center;">
                    <span>Open Live Kitchen Screen &rarr;</span>
                </a>
                <a href="{{ route('admin.menu-items.create') }}" class="btn btn-secondary" style="flex: 1; text-align: center;">
                    <span>+ Add New Dish</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders Table -->
<div class="card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Recent Customer Orders</h2>
            <div style="font-size: 0.75rem; color: var(--text-muted);">Real-time stream of incoming Dine-in and Takeaway orders</div>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">View All Orders &rarr;</a>
    </div>

    @if($recentOrders->isEmpty())
        <div style="padding: 3rem 0; text-align: center; color: var(--text-muted);">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">🛎️</div>
            <div style="font-weight: 600;">No orders received yet</div>
            <div style="font-size: 0.8rem;">Orders placed on the website will instantly appear here.</div>
        </div>
    @else
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.88rem;">
                <thead>
                    <tr style="border-bottom: 2px solid var(--border-color); color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">
                        <th style="padding: 0.75rem 1rem;">Order Ref</th>
                        <th style="padding: 0.75rem 1rem;">Type / Table</th>
                        <th style="padding: 0.75rem 1rem;">Customer</th>
                        <th style="padding: 0.75rem 1rem;">Items Summary</th>
                        <th style="padding: 0.75rem 1rem;">Total</th>
                        <th style="padding: 0.75rem 1rem;">Payment</th>
                        <th style="padding: 0.75rem 1rem;">Status</th>
                        <th style="padding: 0.75rem 1rem; text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                        <tr style="border-bottom: 1px solid var(--border-color); transition: background 0.15s;">
                            <td style="padding: 0.85rem 1rem;">
                                <a href="{{ route('admin.orders.show', $order) }}" style="font-weight: 700; color: var(--primary); text-decoration: none;">
                                    {{ $order->order_number }}
                                </a>
                                <div style="font-size: 0.72rem; color: var(--text-muted);">{{ $order->created_at->diffForHumans() }}</div>
                            </td>
                            <td style="padding: 0.85rem 1rem;">
                                @if($order->order_type === 'dine_in')
                                    <span class="badge" style="background: #e0f2fe; color: #0369a1; font-weight: 800;">
                                        TABLE #{{ $order->table_number ?? '1' }}
                                    </span>
                                @else
                                    <span class="badge" style="background: #f1f5f9; color: #475569;">
                                        TAKEAWAY
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 0.85rem 1rem;">
                                <div style="font-weight: 600;">{{ $order->customer_name ?: 'Walk-in Guest' }}</div>
                                @if($order->customer_phone)
                                    <div style="font-size: 0.72rem; color: var(--text-muted);">{{ $order->customer_phone }}</div>
                                @endif
                            </td>
                            <td style="padding: 0.85rem 1rem;">
                                <div style="max-width: 240px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: var(--text-dark);">
                                    @foreach($order->items as $item)
                                        {{ $item->quantity }}x {{ $item->item_name }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </div>
                                <div style="font-size: 0.72rem; color: var(--text-muted);">{{ $order->items->count() }} item(s)</div>
                            </td>
                            <td style="padding: 0.85rem 1rem; font-weight: 700; color: #0f172a;">
                                {{ $order->formatted_total }}
                            </td>
                            <td style="padding: 0.85rem 1rem;">
                                @if($order->payment_status === 'paid')
                                    <span class="badge badge-paid">PAID &bull; TEYA</span>
                                @elseif($order->payment_status === 'failed')
                                    <span class="badge badge-failed">FAILED</span>
                                @else
                                    <span class="badge" style="background: #fef3c7; color: #92400e;">PENDING</span>
                                @endif
                            </td>
                            <td style="padding: 0.85rem 1rem;">
                                <span class="badge badge-{{ $order->status }}">
                                    {{ strtoupper($order->status) }}
                                </span>
                            </td>
                            <td style="padding: 0.85rem 1rem; text-align: right;">
                                <div style="display: inline-flex; gap: 0.35rem;">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-secondary btn-sm" title="View Order">
                                        View
                                    </a>
                                    <a href="{{ route('admin.orders.receipt', $order) }}" target="_blank" class="btn btn-secondary btn-sm" title="Print Docket">
                                        🖨️
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@push('scripts')
<script>
    // 1. Render 7-Day Revenue Trend Chart
    const ctxTrend = document.getElementById('revenueTrendChart').getContext('2d');
    new Chart(ctxTrend, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Gross Sales (£)',
                data: {!! json_encode($chartRevenue) !!},
                borderColor: '#c44d2d',
                backgroundColor: 'rgba(196, 77, 45, 0.08)',
                borderWidth: 2.5,
                fill: true,
                tension: 0.35,
                pointBackgroundColor: '#c44d2d',
                pointRadius: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Revenue: £' + context.parsed.y.toFixed(2);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '£' + value;
                        }
                    },
                    grid: { color: '#f1f5f9' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    // 2. Render Order Types Doughnut Chart
    const ctxType = document.getElementById('orderTypeChart').getContext('2d');
    new Chart(ctxType, {
        type: 'doughnut',
        data: {
            labels: ['Dine-In', 'Takeaway'],
            datasets: [{
                data: [{{ $dineInCount }}, {{ $takeawayCount }}],
                backgroundColor: ['#0284c7', '#c44d2d'],
                borderWidth: 2,
                borderColor: '#ffffff',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { boxWidth: 12, font: { size: 11 } }
                }
            },
            cutout: '70%',
        }
    });
</script>
@endpush

@endsection
