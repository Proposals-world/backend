<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ✅ Replace the ENUM values to ['card', 'cliq']
        DB::statement("ALTER TABLE fwateer MODIFY payment_method ENUM('card', 'cliq') NOT NULL");
    }

    public function down(): void
    {
        // 🔙 Rollback to original values if needed
        DB::statement("ALTER TABLE fwateer MODIFY payment_method ENUM('card', 'click') NOT NULL");
    }
};
