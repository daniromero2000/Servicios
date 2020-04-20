<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creation_user_id')->unsigned();
            $table->string('name', 30);
            $table->float('pp_percentage', 4,2);
            $table->tinyInteger('checked', 1)->default(0)->comment('0: No comprobada, 1: Comprobada');
            $table->integer('checked_user_id')->unsigned()->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('creation_user_id')->references('id')->on('users');
            $table->foreign('checked_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lists');
    }
}
