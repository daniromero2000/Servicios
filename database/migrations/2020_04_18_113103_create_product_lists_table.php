<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creation_user_id')->unsigned();
            $table->foreign('creation_user_id')->references('id')->on('users');
            $table->string('name', 30);
            $table->float('public_price_percentage', 4, 2);
            $table->tinyInteger('checked')->default(0)->comment('0: No comprobada, 1: Comprobada');
            $table->integer('checked_user_id')->unsigned()->nullable();
            $table->foreign('checked_user_id')->references('id')->on('users');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('zone', 30);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_lists');
    }
}
