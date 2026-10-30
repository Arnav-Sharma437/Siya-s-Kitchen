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
     * Delete an individual order (dummy or test order).
     */
    public function destroy(Order $order): RedirectResponse|JsonResponse
    {
        $orderNumber = $order->order_number;
        $order->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Order #{$orderNumber} deleted successfully.",
            ]);
        }

        return redirect()->route('admin.orders.index')->with('success', "Order #{$orderNumber} was deleted successfully.");
    }

    /**
     * Delete all dummy or unpaid test orders while strictly preserving all real paid orders.
     */
    public function cleanDummy(Request $request): RedirectResponse|JsonResponse
    {
        // Real paid orders to ALWAYS KEEP:
        // - status in ['paid', 'preparing', 'ready', 'completed']
        // - OR payment_status == 'paid'
        // - OR paid_at is not null
        // - OR teya_transaction_id is not null
        //
        // Dummy/unpaid orders to DELETE:
        // - status in ['pending', 'failed', 'cancelled'] AND payment_status != 'paid' AND paid_at is null AND teya_transaction_id is null
        $dummyOrders = Order::where(function ($query) {
            $query->whereIn('status', ['pending', 'failed', 'cancelled'])
                  ->orWhere('payment_status', '!=', 'paid')
                  ->orWhereNull('paid_at');
        })
        ->whereNotIn('status', ['paid', 'preparing', 'ready', 'completed'])
        ->whereNull('teya_transaction_id')
        ->where('payment_status', '!=', 'paid')
        ->get();

        $count = $dummyOrders->count();
        foreach ($dummyOrders as $order) {
            $order->delete();
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'deleted_count' => $count,
                'message' => "Cleaned up {$count} dummy/unpaid orders. All real paid orders have been preserved.",
            ]);
        }

        return redirect()->route('admin.orders.index')->with('success', "Cleaned up {$count} dummy/unpaid order(s). All real paid orders have been preserved.");
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

        $maxId = Order::whereIn('status', ['paid', 'preparing', 'ready'])->max('id') ?? 0;

        return response()->json([
            'count' => $activeOrders->count(),
            'max_id' => $maxId,
            'orders' => $activeOrders,
            'timestamp' => now()->toIso8601String(),
        ]);
    }
}
