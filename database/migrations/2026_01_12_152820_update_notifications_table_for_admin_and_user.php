<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {

            // 1) Drop old foreign key + column
            if (Schema::hasColumn('notifications', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            // 2) Add polymorphic recipient (User or Admin)
            // creates: notifiable_type (string) + notifiable_id (unsignedBigInt) + index
            //  notifiable_id Which record should this notification belong to
            if (!Schema::hasColumn('notifications', 'notifiable_type') && !Schema::hasColumn('notifications', 'notifiable_id')) {
                $table->morphs('notifiable');
            }

            // 3) Optional improvements (safe to remove if you don't want them)
            if (!Schema::hasColumn('notifications', 'title_en')) {
                $table->string('title_en')->nullable()->after('notification_type');
            }
            if (!Schema::hasColumn('notifications', 'title_ar')) {
                $table->string('title_ar')->nullable()->after('title_en');
            }

            if (!Schema::hasColumn('notifications', 'action_url')) {
                $table->string('action_url')->nullable()->after('content_ar');
            }
            if (!Schema::hasColumn('notifications', 'data')) {
                $table->json('data')->nullable()->after('action_url');
            }

            $table->index(['is_read', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {

            // remove indexes we added (Laravel will auto-name morph index, but this one we can safely drop)
            $table->dropIndex(['is_read', 'created_at']);

            // remove optional columns if you added them
            if (Schema::hasColumn('notifications', 'data')) {
                $table->dropColumn('data');
            }
            if (Schema::hasColumn('notifications', 'action_url')) {
                $table->dropColumn('action_url');
            }
            if (Schema::hasColumn('notifications', 'title_ar')) {
                $table->dropColumn('title_ar');
            }
            if (Schema::hasColumn('notifications', 'title_en')) {
                $table->dropColumn('title_en');
            }

            // remove polymorphic
            if (Schema::hasColumn('notifications', 'notifiable_type') && Schema::hasColumn('notifications', 'notifiable_id')) {
                $table->dropMorphs('notifiable');
            }

            // restore user_id
            if (!Schema::hasColumn('notifications', 'user_id')) {
                $table->foreignId('user_id')->constrained('users');
            }
        });
    }
};
