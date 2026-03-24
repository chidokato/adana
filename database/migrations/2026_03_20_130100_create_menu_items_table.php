<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('label');
            $table->string('url')->nullable();
            $table->string('target')->nullable(); // _self, _blank
            $table->integer('position')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->index('menu_id');
            $table->index('parent_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};

