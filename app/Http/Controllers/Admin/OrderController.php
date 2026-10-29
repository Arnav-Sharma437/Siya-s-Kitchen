<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of orders with filtering and search.
     */
    public function index(Request $request): View
    {
        $query = Order::with('items')->latest();

        // Filter by Status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by Order Type
        if ($request->filled('order_type') && $request->order_type !== 'all') {
            $query->where('order_type', $request->order_type);
        }

        // Search Filter
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%")
                    ->orWhere('customer_phone', 'like', "%{$search}%")
                    ->orWhere('customer_email', 'like', "%{$search}%")
                    ->orWhere('table_number', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(20)->withQueryString();

        // Calculate counts for tab badges
        $counts = [
            'all' => Order::count(),
            'paid' => Order::where('status', 'paid')->count(),
            'preparing' => Order::where('status', 'preparing')->count(),
            'ready' => Order::where('status', 'ready')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'counts'));
    }

    /**
     * Display detailed information for a specific order.
     */
    public function show(Order $order): View
    {
        $order->load('items.menuItem');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the preparation/fulfillment status of an order.
     */
    public function updateStatus(Request $request, Order $order): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,preparing,ready,completed,cancelled',
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Order #{$order->order_number} status updated to " . ucfirst($order->status),
                'order' => [
                    'id' => $order->id,
                    'status' => $order->status,
                ],
            ]);
        }

        return back()->with('success', "Order #{$order->order_number} status updated to " . ucfirst($order->status) . ".");
    }

    /**
     * Thermal printer / kitchen receipt docket view.
     */
    public function printReceipt(Order $order): View
    {
        $order->load('items');
        return view('admin.orders.receipt', compact('order'));
    }

    /**
     * Live JSON feed for real-time kitchen polling.
     */
    public function liveFeed(Request $request): JsonResponse
    {
        $activeOrders = Order::with('items')
            ->whereIn('status', ['paid', 'preparing', 'ready'])
            ->latest()
            ->take(30)
            ->get();

        return response()->json([
            'count' => $activeOrders->count(),
            'orders' => $activeOrders,
            'timestamp' => now()->toIso8601String(),
        ]);
    }
}
