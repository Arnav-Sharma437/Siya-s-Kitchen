@extends('layouts.admin')

@section('title', 'Live Orders & Kitchen Display')
@section('page_title', 'Live Kitchen & Customer Orders')

@section('content')

<!-- Controls & Filters Bar -->
<div class="card" style="padding: 1.25rem; margin-bottom: 1.5rem;">
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
        <!-- Status Tabs -->
        <div style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
            <a href="{{ route('admin.orders.index', array_merge(request()->except('status', 'page'), ['status' => 'all'])) }}" 
               class="btn btn-sm {{ !request('status') || request('status') === 'all' ? 'btn-primary' : 'btn-secondary' }}">
                All ({{ $counts['all'] }})
            </a>

            <a href="{{ route('admin.orders.index', array_merge(request()->except('status', 'page'), ['status' => 'paid'])) }}" 
               class="btn btn-sm {{ request('status') === 'paid' ? 'btn-primary' : 'btn-secondary' }}"
               style="{{ $counts['paid'] > 0 ? 'border: 2px solid #22c55e;' : '' }}">
                <span class="live-dot" style="margin-right: 0.25rem;"></span>
                New & Paid ({{ $counts['paid'] }})
            </a>

            <a href="{{ route('admin.orders.index', array_merge(request()->except('status', 'page'), ['status' => 'preparing'])) }}" 
               class="btn btn-sm {{ request('status') === 'preparing' ? 'btn-primary' : 'btn-secondary' }}">
                In Kitchen ({{ $counts['preparing'] }})
            </a>

            <a href="{{ route('admin.orders.index', array_merge(request()->except('status', 'page'), ['status' => 'ready'])) }}" 
               class="btn btn-sm {{ request('status') === 'ready' ? 'btn-primary' : 'btn-secondary' }}">
                Ready ({{ $counts['ready'] }})
            </a>

            <a href="{{ route('admin.orders.index', array_merge(request()->except('status', 'page'), ['status' => 'completed'])) }}" 
               class="btn btn-sm {{ request('status') === 'completed' ? 'btn-primary' : 'btn-secondary' }}">
                Completed ({{ $counts['completed'] }})
            </a>
        </div>

        <!-- Live Refresh Controls -->
        <div style="display: flex; align-items: center; gap: 0.75rem;">
            <button type="button" class="btn btn-secondary btn-sm" id="autoRefreshBtn" onclick="toggleAutoRefresh()">
                <span id="refreshIcon">🔄</span>
                <span id="refreshText">Auto-Refresh: ON (15s)</span>
            </button>
            <a href="{{ request()->fullUrl() }}" class="btn btn-secondary btn-sm" title="Refresh Now">
                Refresh Now
            </a>
        </div>
    </div>

    <!-- Search & Type Filter -->
    <form action="{{ route('admin.orders.index') }}" method="GET" style="display: flex; gap: 0.75rem; margin-top: 1.25rem; flex-wrap: wrap;">
        @if(request('status'))
            <input type="hidden" name="status" value="{{ request('status') }}">
        @endif

        <div style="flex: 1; min-width: 220px;">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Search Order Ref, Table #, Customer Name, Phone..." 
                   style="width: 100%; padding: 0.55rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.88rem;">
        </div>

        <div>
            <select name="order_type" style="padding: 0.55rem 0.85rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm); font-size: 0.88rem; background: #fff;">
                <option value="all">All Service Types</option>
                <option value="dine_in" {{ request('order_type') === 'dine_in' ? 'selected' : '' }}>Dine-In (Table Orders)</option>
                <option value="takeaway" {{ request('order_type') === 'takeaway' ? 'selected' : '' }}>Takeaway Orders</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-sm">Filter Orders</button>
        @if(request('search') || request('order_type'))
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">Clear Filters</a>
        @endif
    </form>
</div>

<!-- Orders Grid -->
@if($orders->isEmpty())
    <div class="card" style="padding: 4rem 2rem; text-align: center;">
        <div style="font-size: 3rem; margin-bottom: 0.5rem;">🍽️</div>
        <h2 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.35rem;">No Orders Matching Selected Filters</h2>
        <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 1.5rem;">When customers place an order on the menu, it will immediately display on this screen.</p>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">Reset All Filters</a>
    </div>
@else
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 1.5rem;">
        @foreach($orders as $order)
            <div class="card" style="margin-bottom: 0; display: flex; flex-direction: column; justify-content: space-between; border-top: 5px solid {{ $order->status === 'paid' ? '#10b981' : ($order->status === 'preparing' ? '#f59e0b' : ($order->status === 'ready' ? '#6366f1' : '#94a3b8')) }};">
                
                <!-- Order Card Header -->
                <div>
                    <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 0.5rem; margin-bottom: 0.75rem;">
                        <div>
                            @if($order->order_type === 'dine_in')
                                <div style="font-size: 1.25rem; font-weight: 800; color: #0284c7;">
                                    TABLE #{{ $order->table_number ?? '1' }}
                                </div>
                                <div style="font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase;">Dine-In Service</div>
                            @else
                                <div style="font-size: 1.25rem; font-weight: 800; color: var(--primary);">
                                    TAKEAWAY
                                </div>
                                <div style="font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase;">Counter Pickup</div>
                            @endif
                        </div>

                        <div style="text-align: right;">
                            <span class="badge badge-{{ $order->status }}">
                                {{ strtoupper($order->status) }}
                            </span>
                            <div style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.2rem;">
                                {{ $order->created_at->format('H:i') }} ({{ $order->created_at->diffForHumans(null, true) }})
                            </div>
                        </div>
                    </div>

                    <!-- Customer Info -->
                    <div style="padding: 0.65rem 0.75rem; background: #f8fafc; border-radius: var(--radius-sm); border: 1px solid var(--border-color); margin-bottom: 1rem; font-size: 0.82rem;">
                        <div style="display: flex; justify-content: space-between;">
                            <span style="font-weight: 700;">{{ $order->customer_name ?: 'Guest Customer' }}</span>
                            <span style="font-weight: 700; color: var(--primary);">{{ $order->formatted_total }}</span>
                        </div>
                        @if($order->customer_phone)
                            <div style="color: var(--text-muted); margin-top: 0.15rem;">📞 {{ $order->customer_phone }}</div>
                        @endif
                        <div style="font-size: 0.72rem; color: #16a34a; font-weight: 600; margin-top: 0.25rem;">
                            ✓ Payment Paid via Teya &bull; Ref: {{ $order->order_number }}
                        </div>
                    </div>

                    <!-- Items List -->
                    <div style="margin-bottom: 1rem;">
                        <div style="font-size: 0.72rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted); margin-bottom: 0.4rem;">
                            Dishes to Prepare ({{ $order->items->sum('quantity') }}):
                        </div>
                        <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.5rem;">
                            @foreach($order->items as $item)
                                <li style="padding-bottom: 0.45rem; border-bottom: 1px dashed var(--border-color); font-size: 0.88rem;">
                                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                        <span style="font-weight: 700; color: #0f172a;">
                                            <span style="display: inline-block; width: 22px; height: 22px; text-align: center; line-height: 22px; background: #e2e8f0; border-radius: 4px; font-size: 0.8rem; margin-right: 0.35rem;">{{ $item->quantity }}</span>
                                            {{ $item->item_name }}
                                        </span>
                                        <span style="font-weight: 600; color: var(--text-muted); font-size: 0.8rem;">
                                            {{ $item->formatted_line_total }}
                                        </span>
                                    </div>

                                    @if($item->variation_name)
                                        <div style="font-size: 0.75rem; color: #64748b; margin-left: 1.75rem;">
                                            &bull; Variation: {{ $item->variation_name }}
                                        </div>
                                    @endif

                                    @if(!empty($item->addons_json))
                                        <div style="font-size: 0.75rem; color: #64748b; margin-left: 1.75rem;">
                                            &bull; Addons: 
                                            @foreach($item->addons_json as $addon)
                                                {{ $addon['name'] }}{{ !$loop->last ? ', ' : '' }}
                                            @endforeach
                                        </div>
                                    @endif

                                    @if($item->special_instructions)
                                        <div style="font-size: 0.75rem; background: #fef3c7; color: #92400e; padding: 0.2rem 0.4rem; border-radius: 4px; margin-top: 0.25rem; margin-left: 1.75rem;">
                                            ⚠️ Note: {{ $item->special_instructions }}
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    @if($order->special_instructions)
                        <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: var(--radius-sm); padding: 0.5rem 0.75rem; font-size: 0.78rem; color: #b45309; margin-bottom: 1rem;">
                            <strong>Customer Instructions:</strong> {{ $order->special_instructions }}
                        </div>
                    @endif
                </div>

                <!-- Order Action Buttons -->
                <div style="border-top: 1px solid var(--border-color); padding-top: 0.85rem; margin-top: 0.5rem; display: flex; flex-direction: column; gap: 0.5rem;">
                    
                    <!-- Status Progression Flow -->
                    @if($order->status === 'paid' || $order->status === 'pending')
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="preparing">
                            <button type="submit" class="btn btn-warning" style="width: 100%; font-weight: 700;">
                                🍳 Start Preparing in Kitchen
                            </button>
                        </form>
                    @elseif($order->status === 'preparing')
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="ready">
                            <button type="submit" class="btn btn-primary" style="width: 100%; font-weight: 700; background: #6366f1;">
                                🔔 Mark Dishes Ready for Service
                            </button>
                        </form>
                    @elseif($order->status === 'ready')
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="btn btn-success" style="width: 100%; font-weight: 700;">
                                ✓ Mark Order Completed & Served
                            </button>
                        </form>
                    @endif

                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-secondary btn-sm" style="flex: 1;">
                            Full Details
                        </a>
                        <a href="{{ route('admin.orders.receipt', $order) }}" target="_blank" class="btn btn-secondary btn-sm" style="flex: 1;">
                            🖨️ Print Docket
                        </a>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div style="margin-top: 2rem;">
        {{ $orders->links() }}
    </div>
@endif

@push('scripts')
<script>
    let autoRefreshActive = true;
    let refreshSeconds = 15;
    let refreshTimer = null;
    let lastOrderCount = {{ $counts['paid'] }};

    function startTimer() {
        if (refreshTimer) clearInterval(refreshTimer);
        refreshTimer = setInterval(() => {
            if (!autoRefreshActive) return;
            refreshSeconds--;
            const text = document.getElementById('refreshText');
            if (text) text.innerText = `Auto-Refresh: ON (${refreshSeconds}s)`;

            if (refreshSeconds <= 0) {
                // Poll live feed to check if new orders arrived
                fetch("{{ route('admin.orders.live-feed') }}")
                    .then(res => res.json())
                    .then(data => {
                        if (data.count > lastOrderCount) {
                            playOrderBell();
                        }
                        window.location.reload();
                    })
                    .catch(() => {
                        window.location.reload();
                    });
            }
        }, 1000);
    }

    function toggleAutoRefresh() {
        autoRefreshActive = !autoRefreshActive;
        const btn = document.getElementById('autoRefreshBtn');
        const text = document.getElementById('refreshText');

        if (autoRefreshActive) {
            btn.classList.add('btn-primary');
            btn.classList.remove('btn-secondary');
            refreshSeconds = 15;
            text.innerText = `Auto-Refresh: ON (15s)`;
            startTimer();
        } else {
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-secondary');
            text.innerText = 'Auto-Refresh: OFF';
            if (refreshTimer) clearInterval(refreshTimer);
        }
    }

    // Play chime if there are pending/new orders on page load
    if ({{ $counts['paid'] }} > 0) {
        setTimeout(() => {
            playOrderBell();
        }, 800);
    }

    startTimer();
</script>
@endpush

@endsection
