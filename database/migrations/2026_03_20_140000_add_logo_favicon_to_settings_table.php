<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'logo')) {
                $table->string('logo')->nullable()->after('email');
            }
            if (!Schema::hasColumn('settings', 'favicon')) {
                $table->string('favicon')->nullable()->after('logo');
            }
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (Schema::hasColumn('settings', 'favicon')) {
                $table->dropColumn('favicon');
            }
            if (Schema::hasColumn('settings', 'logo')) {
                $table->dropColumn('logo');
            }
        });
    }
};

