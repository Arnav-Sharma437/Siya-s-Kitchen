<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('order_type')->default('dine_in'); // dine_in, takeaway
            $table->string('table_number')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('special_instructions')->nullable();
            $table->unsignedInteger('subtotal_pence');
            $table->unsignedInteger('vat_pence')->default(0);
            $table->unsignedInteger('total_pence');
            $table->string('currency', 3)->default('GBP');
            $table->string('status')->default('pending'); // pending, paid, failed, cancelled, refunded
            $table->string('payment_status')->default('unpaid'); // unpaid, paid, failed, cancelled
            $table->string('payment_driver')->default('teya');
            $table->string('teya_session_id')->nullable()->index();
            $table->string('teya_payment_link_id')->nullable();
            $table->string('teya_transaction_id')->nullable()->index();
            $table->string('teya_auth_code')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('menu_item_id')->nullable()->constrained('menu_items')->nullOnDelete();
            $table->string('item_name');
            $table->string('variation_name')->nullable();
            $table->unsignedInteger('variation_price_pence')->nullable();
            $table->json('addons_json')->nullable();
            $table->string('special_instructions')->nullable();
            $table->unsignedInteger('unit_price_pence');
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedInteger('line_total_pence');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
