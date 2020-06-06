<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpperLeftMenu1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upper_left_menu1s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name');
            $table->string('food_image');
            $table->string('price');
            $table->string('price_tag');
            $table->string('dou_price');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upper_left_menu1s');
    }
}
