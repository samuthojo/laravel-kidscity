<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditProductsTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('code')->first()->nullable();
            $table->string('barcode')->after('code')->nullable();
            $table->string('name')->after('barcode')->change();
            $table->text('description')->after('name')->change();
            $table->integer('stock')->default(0);
            $table->string('weight')->nullable();
            $table->string('dimensions')->nullable();
            $table->bigInteger('sale_price')->after('price')->nullable();
            $table->string('video_url')->nullable();
            $table->integer('gender')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
