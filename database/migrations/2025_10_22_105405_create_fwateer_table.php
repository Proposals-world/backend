<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fwateer', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_address')->nullable();
            $table->string('trade_reg_number')->nullable();
            $table->string('sales_tax_number')->nullable();
            $table->date('invoice_date');
            $table->string('invoice_number')->unique(); // e.g. tolba1, tolba2, ...
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['cliq', 'visa', 'mastercard', 'fintesa']);

            $table->enum('payment_method', ['card', 'click']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fwateer');
    }
};
