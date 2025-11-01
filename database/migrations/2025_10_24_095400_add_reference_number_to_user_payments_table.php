<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laravel\Prompts\Table;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_payments', function (Blueprint $table) {
            $table->string('reference_number')->nullable()->after('status'); // or ->unique() if needed
            $table->decimal('final_amount', 10, 2)->nullable()->after('reference_number');
        });
    }

    public function down(): void
    {
        Schema::table('user_payments', function (Blueprint $table) {
            $table->dropColumn('reference_number');
        });
    }
};
