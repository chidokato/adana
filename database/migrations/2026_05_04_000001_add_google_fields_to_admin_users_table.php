<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admin_users', function (Blueprint $table) {
            if (!Schema::hasColumn('admin_users', 'google_id')) {
                $table->string('google_id')->nullable()->after('password');
                $table->unique('google_id');
            }

            if (!Schema::hasColumn('admin_users', 'avatar')) {
                $table->string('avatar')->nullable()->after('google_id');
            }

            if (!Schema::hasColumn('admin_users', 'google_token')) {
                $table->text('google_token')->nullable()->after('avatar');
            }

            if (!Schema::hasColumn('admin_users', 'google_refresh_token')) {
                $table->text('google_refresh_token')->nullable()->after('google_token');
            }

            if (!Schema::hasColumn('admin_users', 'google_token_expires_at')) {
                $table->timestamp('google_token_expires_at')->nullable()->after('google_refresh_token');
            }
        });
    }

    public function down(): void
    {
        Schema::table('admin_users', function (Blueprint $table) {
            if (Schema::hasColumn('admin_users', 'google_token_expires_at')) {
                $table->dropColumn('google_token_expires_at');
            }

            if (Schema::hasColumn('admin_users', 'google_refresh_token')) {
                $table->dropColumn('google_refresh_token');
            }

            if (Schema::hasColumn('admin_users', 'google_token')) {
                $table->dropColumn('google_token');
            }

            if (Schema::hasColumn('admin_users', 'avatar')) {
                $table->dropColumn('avatar');
            }

            if (Schema::hasColumn('admin_users', 'google_id')) {
                $table->dropUnique('admin_users_google_id_unique');
                $table->dropColumn('google_id');
            }
        });
    }
};
