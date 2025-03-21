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
        Schema::create('user_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reporter_id')->constrained('users');
            $table->foreignId('reported_id')->constrained('users');

            // Enum for reasons
            $table->enum('reason_en', ['harassment', 'spam', 'abuse', 'offensive', 'other'])->default('other');
            $table->enum('reason_ar', ['تحرش', 'رسائل مزعجة', 'إساءة', 'محتوى مسيء', 'أخرى'])->default('أخرى');
            // Column for other reason (if 'other' is selected)
            $table->text('other_reason_en')->nullable(); // other reason in English
            $table->text('other_reason_ar')->nullable(); // other reason in Arabic
            // Enum for status
            $table->enum('status', ['pending', 'reviewed', 'resolved', 'rejected'])->default('pending');
            // $table->enum('status', ['معلق', 'تم المراجعة', 'مقيد', 'مرفوض'])->default('معلق');

            $table->integer('report_count')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_reports');
    }
};
