<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShipsNewsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('ships_news', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')
                    ->references('id')->on('customers')
                    ->onDelete('cascade');
            $table->string('receive_name');
            $table->integer('number_cv_pa71');
            $table->integer('page_number');
            $table->integer('news_number');
            $table->timestamp('date_submit');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('ships_news');
    }

}
