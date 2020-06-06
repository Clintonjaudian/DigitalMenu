<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUppersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uppers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product');
            $table->string('food_image');
            $table->string('original_price');
            $table->string('dou_price');
            $table->string('trio_price');
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
        Schema::dropIfExists('dashboard2_uppers');
    }
}
