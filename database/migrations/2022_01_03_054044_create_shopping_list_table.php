<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_list', function (Blueprint $table) {
            $table->string('uuid', $length = 36)->primary();
            $table->integer('price');
            $table->smallInteger('stock');
            $table->smallInteger('quantity');

            $table->string('uuid_product', $length = 36);
            $table->foreign('uuid_product')
                  ->references('uuid')
                  ->on('products');

            $table->string('uuid_invoice', $length = 36);
            $table->foreign('uuid_invoice')
                  ->references('uuid')
                  ->on('invoices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_list');
    }
}
