<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductHasSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_has_sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('product_size_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products');
            $table->foreign('product_size_id')
                  ->references('id')
                  ->on('product_sizes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_has_sizes');
    }
}
