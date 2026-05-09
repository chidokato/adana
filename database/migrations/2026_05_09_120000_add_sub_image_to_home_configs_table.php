<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubImageToHomeConfigsTable extends Migration
{
    public function up()
    {
        Schema::table('home_configs', function (Blueprint $table) {
            $table->string('sub_image')->nullable()->after('image');
        });
    }

    public function down()
    {
        Schema::table('home_configs', function (Blueprint $table) {
            $table->dropColumn('sub_image');
        });
    }
}
