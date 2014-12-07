<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
            $table->integer('kind_id')->unsigned();
            $table->foreign('kind_id')
                    ->references('id')->on('kinds')
                    ->onDelete('cascade');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')
                    ->references('id')->on('categories')
                    ->onDelete('cascade');
            $table->integer('unit_id')->unsigned();
            $table->foreign('unit_id')
                    ->references('id')->on('units')
                    ->onDelete('cascade');
//            $table->integer('purpose_id')->unsigned();
//            $table->foreign('purpose_id')
//                    ->references('id')->on('purposes')
//                    ->onDelete('cascade');
            $table->string('customer_name');
            $table->string('order_name');
            $table->integer('order_phone');
            $table->integer('number_cv');
            $table->integer('number_cv_pa71');
            $table->text('comment')->nullable();
            $table->timestamp('date_begin');
            $table->timestamp('date_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('orders');
    }

}
