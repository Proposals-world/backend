<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ✅ Expand ENUM to include all used methods
        DB::statement("
            ALTER TABLE fwateer
            MODIFY payment_method ENUM( 'cliq', 'visa', 'mastercard', 'fintesa') NOT NULL
        ");
    }

    public function down(): void
    {
        // 🔙 Revert to previous limited ENUM
        DB::statement("
            ALTER TABLE fwateer
            MODIFY payment_method ENUM('card', 'cliq') NOT NULL
        ");
    }
};
