<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_ages', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('product_age_range_id')->unsigned();
          $table->integer('product_id')->unsigned();
          $table->timestamps();
          $table->softDeletes();
          $table->foreign('product_age_range_id')
                ->references('id')
                ->on('product_age_ranges');
          $table->foreign('product_id')
                ->references('id')
                ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_ages');
    }
}
