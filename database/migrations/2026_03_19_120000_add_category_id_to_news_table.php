<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            if (!Schema::hasColumn('news', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->after('title');
                $table->index('category_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            if (Schema::hasColumn('news', 'category_id')) {
                $table->dropIndex(['category_id']);
                $table->dropColumn('category_id');
            }
        });
    }
};
