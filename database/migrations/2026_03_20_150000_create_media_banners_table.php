<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_banners', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('slider'); // slider | banner
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->integer('position')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_banners');
    }
};

