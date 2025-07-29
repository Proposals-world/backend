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
        Schema::create('user_feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained('user_matches')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->boolean('is_profile_accurate')->default(0)->nullable();

            // ENUM instead of text
            $table->enum('feedback_text_en', [
                'Contacted Successfully',
                'Guardian Was Cooperative',
                'Guardian Was Not Cooperative',
                'Inappropriate Behavior',
                'No Response from Guardian',
                'Engagement Happened',
                'Marriage Happened',
                'Still in Communication',
                'Not Serious',
                // 'Provided guardian number is not for a real guardian',
            ])->nullable();
            $table->enum('feedback_text_ar', [
                'تم التواصل بنجاح',
                'الولية كانت متعاونة',
                'الولية لم تكن متعاونة',
                'سلوك غير لائق',
                'لا يوجد استجابة من الولية',
                'حدثت خطوبة',
                'تم الزواج',
                'ما زلنا على تواصل',
                'غير جاد',
                'الرقم المقدم للولية ليس حقيقي',
            ])->nullable();


            $table->string('outcome')->nullable(); // leave outcome as string if needed

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_feedback');
    }
};
