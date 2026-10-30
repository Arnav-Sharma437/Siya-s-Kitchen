<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class CleanDummyOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:clean-dummy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up dummy/unpaid test orders while strictly preserving all real paid orders';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
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

        $this->info("Cleaned up {$count} dummy/unpaid orders. All real paid orders have been preserved.");

        return Command::SUCCESS;
    }
}
