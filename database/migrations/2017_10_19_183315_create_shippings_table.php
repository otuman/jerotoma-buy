<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('order_id')->unsigned()->nullable();
            $table->boolean('isDefault')->nullable($value = false);
            $table->string('firstName');
            $table->string('lastName');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('phone');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('country_code');
            $table->string('special_note')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('order_id')
                  ->references('id')->on('orders')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shippings');
    }
}
