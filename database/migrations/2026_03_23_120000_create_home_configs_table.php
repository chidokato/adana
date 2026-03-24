<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeConfigsTable extends Migration
{
    public function up()
    {
        Schema::create('home_configs', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_configs');
    }
}
