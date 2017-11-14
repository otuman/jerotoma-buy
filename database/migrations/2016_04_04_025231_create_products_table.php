<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('short_description')->nullable();;
            $table->decimal('price', 10, 2);
            $table->string('sale_price')->nullable();;
            $table->string('regular_price')->nullable();;
            //$table->string('images');
            //$table->string('categories')->nullable();;
            // $table->string('attributes')->nullable();;
            // $table->string('related_ids')->nullable();;   //draft, pending, publish private
            $table->string('status')->default('publish');   //draft, pending, publish private
            $table->boolean('featured')->default(false);
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
        Schema::drop('products');
    }
}
