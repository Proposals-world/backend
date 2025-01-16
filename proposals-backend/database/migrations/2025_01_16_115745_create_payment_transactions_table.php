<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('subscription_id')->nullable()->constrained('subscriptions', 'subscription_id')->onDelete('set null');
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3); // ISO currency code
            $table->string('payment_method'); // 'credit_card', 'paypal', etc.
            $table->string('transaction_status'); // 'pending', 'completed', 'failed'
            $table->timestamp('transaction_date')->useCurrent();
            $table->text('payment_gateway_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
}
