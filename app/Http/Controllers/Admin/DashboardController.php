<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\TeyaService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the Admin Analytics & Ecommerce Overview.
     */
    public function index(TeyaService $teyaService): View
    {
        $today = Carbon::today();

        // 1. Core KPIs
        $totalRevenuePence = Order::where('payment_status', 'paid')->sum('total_pence');
        $todayRevenuePence = Order::where('payment_status', 'paid')
            ->whereDate('created_at', $today)
            ->sum('total_pence');

        $totalOrdersCount = Order::count();
        $todayOrdersCount = Order::whereDate('created_at', $today)->count();
        $paidOrdersCount = Order::where('payment_status', 'paid')->count();

        $activeKitchenCount = Order::whereIn('status', ['paid', 'preparing', 'ready'])->count();

        $avgOrderValuePence = $paidOrdersCount > 0 ? (int) round($totalRevenuePence / $paidOrdersCount) : 0;

        // 2. Order Type Distribution (Dine In vs Takeaway)
        $orderTypes = Order::select('order_type', DB::raw('count(*) as count'), DB::raw('sum(total_pence) as revenue_pence'))
            ->groupBy('order_type')
            ->get()
            ->keyBy('order_type');

        $dineInCount = $orderTypes['dine_in']->count ?? 0;
        $takeawayCount = $orderTypes['takeaway']->count ?? 0;

        // 3. Status Breakdown
        $statusCounts = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // 4. Past 7 Days Revenue & Order Trends for Chart.js
        $chartLabels = [];
        $chartRevenue = [];
        $chartOrders = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dateString = $date->toDateString();
            $label = $date->format('D, d M');

            $dayRevenue = Order::where('payment_status', 'paid')
                ->whereDate('created_at', $dateString)
                ->sum('total_pence');

            $dayOrders = Order::whereDate('created_at', $dateString)->count();

            $chartLabels[] = $label;
            $chartRevenue[] = round($dayRevenue / 100, 2);
            $chartOrders[] = $dayOrders;
        }

        // 5. Top Selling Dishes
        $topDishes = OrderItem::select('item_name', DB::raw('sum(quantity) as total_qty'), DB::raw('sum(line_total_pence) as total_revenue_pence'))
            ->groupBy('item_name')
            ->orderByDesc('total_qty')
            ->take(5)
            ->get();

        // 6. Recent Orders (Latest 10)
        $recentOrders = Order::with('items')
            ->latest()
            ->take(10)
            ->get();

        // 7. Catalog Summary
        $menuItemsCount = MenuItem::count();
        $categoriesCount = MenuCategory::count();
        $outOfStockCount = MenuItem::where('is_available', false)->count();

        // 8. Teya Gateway Health
        $teyaStatus = [
            'is_sandbox' => $teyaService->isSandbox(),
            'env' => config('services.teya.env', 'production'),
            'store_id_set' => !empty(config('services.teya.store_id')),
        ];

        return view('admin.dashboard', compact(
            'totalRevenuePence',
            'todayRevenuePence',
            'totalOrdersCount',
            'todayOrdersCount',
            'activeKitchenCount',
            'avgOrderValuePence',
            'dineInCount',
            'takeawayCount',
            'statusCounts',
            'chartLabels',
            'chartRevenue',
            'chartOrders',
            'topDishes',
            'recentOrders',
            'menuItemsCount',
            'categoriesCount',
            'outOfStockCount',
            'teyaStatus'
        ));
    }
}
