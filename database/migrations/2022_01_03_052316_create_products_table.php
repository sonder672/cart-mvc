<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('uuid', $length = 36)->primary();
            $table->string('name');
            $table->integer('price');
            $table->integer('stock');
            $table->boolean('sold_out');

            $table->string('uuid_sub_category', $length = 36);
            $table->foreign('uuid_sub_category')
                  ->references('uuid')
                  ->on('sub_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
